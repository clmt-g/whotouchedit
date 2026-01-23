FROM dunglas/frankenphp:php8.3-bookworm

# Installer Node.js et les dépendances système
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && install-php-extensions pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copier composer.json et composer.lock
COPY composer.json composer.lock ./

# Installer les dépendances PHP
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

# Copier package.json et package-lock.json
COPY package.json package-lock.json ./

# Installer les dépendances Node
RUN npm ci

# Copier le reste des fichiers
COPY . .

# Générer l'autoloader optimisé
RUN composer dump-autoload --optimize --no-dev

# Compiler les assets
RUN npm run build

# Préparer les permissions Laravel
RUN mkdir -p storage/framework/{sessions,views,cache,testing} storage/logs bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Commande de démarrage
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT

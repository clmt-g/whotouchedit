FROM dunglas/frankenphp:php8.3-bookworm

# Installer toutes les dépendances système nécessaires
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    && install-php-extensions pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copier composer.json et composer.lock en premier (pour le cache Docker)
COPY composer.json composer.lock ./

# Installer les dépendances PHP
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

# Copier le reste des fichiers
COPY . .

# Générer l'autoloader optimisé
RUN composer dump-autoload --optimize --no-dev

# Installer et compiler les assets Node
RUN npm ci && npm run build

# Préparer les permissions Laravel
RUN mkdir -p storage/framework/{sessions,views,cache,testing} storage/logs bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Commande de démarrage
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT

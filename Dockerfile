FROM php:8.4-cli

# Installation des dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm \
    default-mysql-client

# Installation des extensions PHP
RUN docker-php-ext-install pdo_mysql mysqli mbstring exif pcntl bcmath gd

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /app

# Copier les fichiers de l'application
COPY . .

# Installation des dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Installation des dépendances NPM et build
RUN npm install && npm run build

# Optimisation Laravel
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Exposer le port
EXPOSE $PORT

# Commande de démarrage
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT

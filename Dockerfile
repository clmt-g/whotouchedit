FROM dunglas/frankenphp:php8.3-bookworm

# Installer l'extension PDO MySQL
RUN install-php-extensions pdo_mysql

WORKDIR /app

# Copier les fichiers
COPY . .

# Installer dépendances PHP et Node
RUN composer install --no-dev --optimize-autoloader
RUN npm ci && npm run build

# Préparer les permissions
RUN mkdir -p storage/framework/{sessions,views,cache,testing} storage/logs bootstrap/cache \
    && chmod -R a+rw storage bootstrap/cache

# Commande de démarrage
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT


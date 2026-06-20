FROM dunglas/frankenphp

RUN apt-get update && apt-get install -y git curl unzip

RUN install-php-extensions pdo_mysql zip intl opcache

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction

EXPOSE 8080

CMD php artisan migrate --force && frankenphp php-server --root=/app/public --listen=:${PORT:-8080}

FROM php:8.3-cli

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . .
RUN mkdir -p bootstrap/cache storage/app/public storage/framework/cache storage/framework/sessions storage/framework/views storage/logs \
    && chmod -R 775 bootstrap/cache storage || true
RUN composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader

COPY start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

EXPOSE 10000

CMD ["/usr/local/bin/start.sh"]

FROM php:8-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql

# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


ARG PUID=33
ARG PGID=33
# RUN groupmod -g $PGID www-data \
#     && usermod -u $PUID www-data

RUN chown -R www-data:www-data /var/www
RUN chmod 755 /var/www

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN chmod +x /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1

RUN composer install

# RUN composer install \
#     && php artisan key:generate \
#     && sail artisan cache:clear \
#     && sail artisan route:clear \
#     && sail artisan view:clear \
#     && sail artisan config:cache \
#     && sail artisan config:clear \
#     && sail artisan migrate \
#     && sail artisan vendor:publish --all \
#     && sail artisan storage:link \
#     && composer dump-autoload

# COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# CMD ["curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer"]

FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache(optional)
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY ./docker/entrypoint.sh /entrypoint.sh

RUN usermod --uid 1000 www-data && groupmod --gid 1001 www-data

COPY ./src /var/www
COPY --chown=www-data:www-data ./src /var/www

USER www-data

EXPOSE 9000

CMD ["/entrypoint.sh"]

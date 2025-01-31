FROM php:8.3-cli

RUN chown -R www-data:www-data /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    curl \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    libbrotli-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install mbstring exif pcntl bcmath sockets pdo pdo_mysql

# Update pecl channels
RUN pecl update-channels

# Install Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Install swoole extension
RUN pecl install swoole && docker-php-ext-enable swoole

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY run.sh /tmp
COPY setup.sh /tmp

COPY php.ini /usr/local/etc/php/conf.d/40-custom.ini

CMD ["/tmp/setup.sh"]

ENTRYPOINT ["/tmp/run.sh"]

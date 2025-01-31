FROM php:8.3-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    curl \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    supervisor

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install mbstring exif pcntl bcmath pdo pdo_mysql

# Install Redis extension
RUN pecl update-channels && pecl install redis && docker-php-ext-enable redis

RUN chmod -R 777 /var/log/supervisor
RUN chmod -R 777 /var/run

COPY php.ini /usr/local/etc/php/conf.d/40-custom.ini

COPY supervisord.conf /etc/supervisor/conf.d/laravel-worker.conf

CMD ["/usr/bin/supervisord"]

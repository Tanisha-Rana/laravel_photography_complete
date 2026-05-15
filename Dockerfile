FROM php:8.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    curl

# PHP Extensions
RUN docker-php-ext-install pdo_mysql mysqli zip

# Enable apache rewrite
RUN a2enmod rewrite

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy files
COPY . .

# Install composer packages
RUN composer install --no-dev --optimize-autoloader

# Apache public folder setup
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Laravel permissions
RUN chmod -R 777 storage
RUN chmod -R 777 bootstrap/cache

# Clear cache
RUN php artisan config:clear || true
RUN php artisan cache:clear || true
RUN php artisan route:clear || true
RUN php artisan view:clear || true

EXPOSE 80

CMD ["apache2-foreground"]
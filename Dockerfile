FROM php:8.2-fpm

# Instala dependencias del sistema necesarias
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install \
    pdo \
    pdo_mysql \
    zip \
    mbstring \
    gd \
    exif \
    pcntl \
    bcmath \
    opcache 

# ✅ Instalar redis con PECL
RUN pecl install redis && docker-php-ext-enable redis

# Instala Composer (última versión oficial)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define directorio de trabajo
WORKDIR /var/www

EXPOSE 9000

# Comando por defecto
CMD ["php-fpm"]

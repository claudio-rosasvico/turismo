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

# Instala Composer (última versión oficial)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crea y define el directorio de trabajo
WORKDIR /var/www

# Copiá el resto del código del proyecto cuando sea necesario
# COPY . .

# Expone el puerto 9000 por defecto para php-fpm
EXPOSE 9000

# Comando por defecto (puede variar según tu docker-compose)
CMD ["php-fpm"]

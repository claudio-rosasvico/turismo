# Usa una imagen base de PHP 8.2 con FPM y Alpine Linux (ligera)
FROM php:8.2-fpm-alpine

# Configura un mirror de Alpine más estable para evitar errores de descarga
# UN sed -i 's/dl-cdn.alpinelinux.org/mirrors.ustc.edu.cn/g' /etc/apk/repositories

# 1. Instala solo las dependencias del sistema operativo y herramientas básicas
RUN apk add --no-cache \
    curl \
    git \
    npm \
    nodejs \
    autoconf \
    build-base \
    pkgconf \
    libjpeg-turbo \
    libjpeg-turbo-dev \
    libpng \
    libpng-dev \
    libwebp \
    libwebp-dev \
    freetype \
    freetype-dev \
    libxpm \
    libxpm-dev \
    zlib \
    zlib-dev \
    mariadb-dev \
    libzip-dev \
    php82-zip \
    php82-iconv \
    php82-dom \
    php82-mbstring \
    php82-pdo \
    php82-xml \
    php82-json \
    php82-tokenizer \
    php82-session \
    php82-mysqli \
    php82-opcache \
    php82-pecl-redis \
    php82-intl \
    && rm -rf /var/cache/apk/*

# 2. Configura la extensión GD por separado
RUN docker-php-ext-configure gd --with-jpeg --with-webp --with-freetype

# 3. Instala las extensiones PHP por separado
RUN docker-php-ext-install pdo_mysql gd exif

# 4. Limpia los paquetes de desarrollo después de la instalación (este paso se ejecutará si los anteriores tuvieron éxito)
RUN apk del autoconf build-base pkgconf libjpeg-turbo-dev libpng-dev libwebp-dev freetype-dev libxpm-dev zlib-dev

# ... (El resto de tu Dockerfile se mantiene igual) ...

# Instala Composer (el gestor de dependencias de PHP)
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

# Establece el directorio de trabajo dentro del contenedor
WORKDIR /var/www/html

# Copia el código de tu aplicación Laravel al contenedor
COPY . /var/www/html

# Ajusta los permisos para Laravel (storage y bootstrap/cache)
RUN chown -R www-data:www-data /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Instala las dependencias de Composer
RUN composer install --no-interaction --ignore-platform-reqs

# Si necesitas compilar assets de frontend (Vite, Mix) DENTRO del contenedor PHP:
# RUN npm install && npm run build

# Expone el puerto 9000 para PHP-FPM
EXPOSE 9000

# El comando por defecto para iniciar PHP-FPM
CMD ["php-fpm"]
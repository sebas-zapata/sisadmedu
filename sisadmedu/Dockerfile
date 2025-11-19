# 1. Imagen base con PHP 8.2 y Apache
FROM php:8.2-apache

# 2. Habilitar mod_rewrite para Laravel
RUN a2enmod rewrite

# 3. Instalar herramientas necesarias y extensiones PHP
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 4. Instalar Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# 5. Configurar directorio de trabajo
WORKDIR /var/www/html

# 6. Copiar el proyecto Laravel al contenedor
COPY . .

# 7. Instalar dependencias de Laravel
RUN composer install --no-scripts --no-autoloader \
    && composer dump-autoload

# COPIAR ASSETS DESPUÉS DE COMPOSER
COPY public/ /var/www/html/public/

# 8. Dar permisos correctos a storage y cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 9. Configurar DocumentRoot de Apache
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!'$APACHE_DOCUMENT_ROOT'!g' /etc/apache2/sites-available/*.conf

# 10. Exponer puerto 80
EXPOSE 80

# 11. Comando para levantar Apache en primer plano
CMD ["apache2-foreground"]

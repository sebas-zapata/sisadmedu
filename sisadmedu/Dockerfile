# 1. Imagen base con PHP 8.2 y Apache
FROM php:8.2-apache

# 2. Habilitar mod_rewrite (necesario para Laravel)
RUN a2enmod rewrite

# 3. Instalar dependencias del sistema y extensiones necesarias de PHP
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

# 4. Instalar Composer dentro del contenedor
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# 5. Directorio de trabajo de Apache
WORKDIR /var/www/html

# 6. Copiar TODO el proyecto dentro del contenedor (incluye public/, assets, favicon, etc.)
COPY . .

# 7. Instalar dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# 8. Permisos correctos para Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 9. Establecer /public como DocumentRoot
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# 10. Cambiar configuración de Apache para servir el DocumentRoot correcto
RUN sed -ri -e "s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/sites-available/*.conf

# 11. Cambiar permisos del directorio en apache2.conf para permitir acceso a assets
RUN sed -ri -e "s!<Directory /var/www/html>!<Directory ${APACHE_DOCUMENT_ROOT}>!g" /etc/apache2/apache2.conf

# 12. Exponer puerto 80
EXPOSE 80

# 13. Levantar Apache
CMD ["apache2-foreground"]

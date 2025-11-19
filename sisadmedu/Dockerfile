# 1. Imagen base con PHP 8.2 y Apache
FROM php:8.2-apache

# 2. Habilitar mod_rewrite
RUN a2enmod rewrite

# 3. Instalar extensiones necesarias
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# 4. Instalar Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# 5. Copiar proyecto al contenedor
COPY . /var/www/html

# 6. Colocar DocumentRoot correctamente
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html/!${APACHE_DOCUMENT_ROOT}/!g' \
    /etc/apache2/sites-available/000-default.conf

# 7. Permitir que .htaccess funcione
RUN sed -ri -e 's/AllowOverride None/AllowOverride All/g' \
    /etc/apache2/apache2.conf

# 8. Instalar dependencias Laravel
WORKDIR /var/www/html
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# 9. Permisos storage y cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 10. Permisos correctos para /public (evita el Forbidden)
RUN chown -R www-data:www-data /var/www/html/public \
    && chmod -R 755 /var/www/html/public

# 11. Exponer puerto
EXPOSE 80

CMD ["apache2-foreground"]

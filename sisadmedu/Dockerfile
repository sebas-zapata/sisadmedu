# 1. Imagen base con PHP 8.2 y Apache
FROM php:8.2-apache

# 2. Habilitar mod_rewrite para permitir URLs limpias de Laravel
RUN a2enmod rewrite

# 3. Definir ServerName para evitar advertencias internas de Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# 4. Instalar dependencias del sistema y extensiones PHP necesarias para Laravel
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

# 5. Copiar Composer desde su imagen oficial
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# 6. Copiar todo el proyecto Laravel al contenedor
COPY . /var/www/html

# 7. Sobrescribir el VirtualHost por defecto para usar /public como DocumentRoot
#    Esto asegura que Apache apunte al directorio correcto y que se carguen los assets.
RUN printf "<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

# 8. Definir el directorio de trabajo
WORKDIR /var/www/html

# 9. Instalar dependencias de Laravel sin scripts interactivos
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# 10. Establecer permisos adecuados para Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 755 /var/www/html/public
RUN chown -R www-data:www-data /var/www/html/public

# 11. Exponer el puerto 80 para el servidor web
EXPOSE 80

# 12. Ejecutar Apache en primer plano
CMD ["apache2-foreground"]

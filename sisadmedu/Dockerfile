# Imagen base con PHP 8.2 y extensiones necesarias
FROM php:8.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Instalar Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Definir directorio de trabajo
WORKDIR /var/www

# Copiar el contenido del proyecto
COPY . .

# Instalar dependencias de PHP
RUN composer install --no-scripts --no-autoloader
RUN composer dump-autoload

# Asignar permisos a la carpeta storage
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Exponer puerto
EXPOSE 9000

# Comando de inicio
CMD ["php-fpm"]

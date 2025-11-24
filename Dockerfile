# =============================================================
#  Imagen base: PHP 8.2 con Apache
# =============================================================
# Usamos la imagen oficial, estable y preparada para Apache.
FROM php:8.2-apache

# =============================================================
# Activar mod_rewrite (URLs limpias en Laravel)
# =============================================================
RUN a2enmod rewrite

# =============================================================
# Instalar dependencias del sistema + extensiones PHP necesarias
# =============================================================
# Solo se instalan las librerías necesarias para Laravel y GD.
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring pcntl bcmath zip gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# =============================================================
# Copiar Composer desde su imagen oficial
# =============================================================
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# =============================================================
# Copiar proyecto Laravel al contenedor
#    NOTA: el proyecto debe estar en ./sisadmedu localmente
# =============================================================
COPY ./sisadmedu /var/www/html

# =============================================================
# Configurar Apache para que DocumentRoot sea /public
# =============================================================
RUN printf "<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

# =============================================================
# Establecer directorio de trabajo
# =============================================================
WORKDIR /var/www/html

# =============================================================
# Instalar dependencias con Composer
#    Incluye la dependencia solicitada:
#    - laravolt/avatar 6.3
# =============================================================
RUN composer require laravolt/avatar:6.3 --no-interaction

# Instalar dependencias del proyecto optimizadas para producción
RUN composer install \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader

# =============================================================
# Permisos correctos para Laravel:
#     storage y bootstrap/cache deben ser de www-data
# =============================================================
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 755 public
RUN chown -R www-data:www-data public

# =============================================================
# Exponer puerto 80 para Apache
# =============================================================
EXPOSE 80

# =============================================================
# Iniciar Apache en primer plano
# =============================================================
CMD ["apache2-foreground"]

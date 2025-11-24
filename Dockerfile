# =============================================================
# Imagen base: PHP 8.2 con Apache
# =============================================================
FROM php:8.2-apache

# =============================================================
# Activar mod_rewrite (URLs limpias en Laravel)
# =============================================================
RUN a2enmod rewrite

# =============================================================
# Instalar dependencias del sistema + extensiones PHP necesarias
# =============================================================
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
# Copiar el contenido del proyecto dentro del contenedor
# NOTA: se copia el contenido interno de sisadmedu/
# =============================================================
COPY sisadmedu/ /var/www/html/

# =============================================================
# Ajustar DocumentRoot de Apache para apuntar a /public
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
# Permisos correctos para Laravel
# =============================================================
RUN chown -R www-data:www-data storage bootstrap/cache

# =============================================================
# Exponer puerto 80
# =============================================================
EXPOSE 80

# =============================================================
# Iniciar Apache
# =============================================================
CMD ["apache2-foreground"]

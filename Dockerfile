# Utiliza la imagen oficial de PHP 7.4 con Apache
FROM php:7.4-apache

# Instala las extensiones PHP necesarias para WordPress
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Habilita el módulo mod_rewrite de Apache
RUN a2enmod rewrite

# Actualiza paquetes y instala dependencias necesarias
RUN apt update && \
    apt -y upgrade && \
    apt -y install nano git libzip-dev

# Instala la extensión zip para PHP
RUN docker-php-ext-install zip

# Establece el directorio de trabajo en el directorio raíz de WordPress
WORKDIR /var/www/html

# Copia los archivos de WordPress al contenedor
COPY . /var/www/html

# Copia el archivo de configuración de Apache para el sitio
COPY vhost.conf /etc/apache2/sites-available/000-default.conf

# Expone el puerto 8009
EXPOSE 8009

# Inicia Apache en primer plano
CMD apachectl -DFOREGROUND

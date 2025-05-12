FROM php:8.2-apache-bullseye

# Instalation dus paquets nécessaires
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Instalar PECL y la extension MongoDB
RUN apt-get update && apt-get install -y libssl-dev pkg-config
RUN pecl install mongodb
RUN docker-php-ext-enable mongodb

# Activer le mod_rewrite d'Apache
RUN a2enmod rewrite
RUN a2enmod ssl

# Crear carpeta para el certificado
RUN mkdir /etc/apache2/ssl

# Generar certificado autofirmado
RUN openssl req -x509 -nodes -days 3650 \
  -newkey rsa:2048 \
  -subj "/C=US/ST=Dev/L=Localhost/O=SelfSigned/CN=localhost" \
  -keyout /etc/apache2/ssl/apache.key \
  -out /etc/apache2/ssl/apache.crt

# Copiar configuración SSL del VirtualHost
COPY default-ssl.conf /etc/apache2/sites-available/default-ssl.conf

# Habilitar sitio SSL
RUN a2ensite default-ssl

# Copier tous le fichiers
COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html


EXPOSE 80

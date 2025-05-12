FROM php:8.2-apache-bullseye

# Instalation dus paquets nécessaires
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Instalar PECL y la extension MongoDB
RUN apt-get update && apt-get install -y libssl-dev pkg-config
RUN pecl install mongodb
RUN docker-php-ext-enable mongodb

# Activer le mod_rewrite d'Apache
RUN a2enmod rewrite

# Copier tous le fichiers
COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

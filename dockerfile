FROM php:apache

# Git et les dépendances PHP
RUN apt-get update \
    && apt-get install -y git \
    && docker-php-ext-install pdo pdo_mysql


COPY . /var/www/html


WORKDIR /var/www/html/PHP

# dépendances PHP avec Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-interaction --no-plugins --no-scripts


EXPOSE 80

# Démarrer le serveur Apache
CMD ["apache2-foreground"]

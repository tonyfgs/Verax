# Utilisez une image PHP avec Apache
FROM php:apache

# Installez Git et les dépendances PHP
RUN apt-get update \
    && apt-get install -y git \
    && docker-php-ext-install pdo pdo_mysql

# Copiez les fichiers de votre projet dans le conteneur
COPY . /var/www/html

# Définir le répertoire de travail dans le conteneur
WORKDIR /var/www/html/PHP

# Installez les dépendances PHP avec Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-interaction --no-plugins --no-scripts

# Exposez le port 80 (port par défaut pour les serveurs web)
EXPOSE 80

# Démarrer le serveur Apache
CMD ["apache2-foreground"]




# Ancienne version : 

# # Utilisez une image PHP avec Apache
# FROM php:apache

# # Installez Git
# RUN apt-get update && apt-get install -y git

# # Copiez les fichiers de votre projet dans le conteneur
# COPY . /var/www/html

# # Exposez le port 80 (port par défaut pour les serveurs web)
# EXPOSE 80

# # Démarrer le serveur Apache
# CMD ["apache2-foreground"]

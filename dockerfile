# Utilisez une image PHP avec Apache
FROM php:apache

# Installez Git
RUN apt-get update && apt-get install -y git

# Copiez les fichiers de votre projet dans le conteneur
COPY . /var/www/html

# Exposez le port 80 (port par défaut pour les serveurs web)
EXPOSE 80

# Démarrer le serveur Apache
CMD ["apache2-foreground"]

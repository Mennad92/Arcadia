# Utiliser l'image officielle PHP avec Apache
FROM php:8.1-apache

# Installer les dépendances nécessaires
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# Copier les fichiers de l'application dans le répertoire web du conteneur
COPY . /var/www/html/

# Installer les dépendances npm (si nécessaire)
RUN apt-get install -y nodejs npm \
    && cd /var/www/html/ \
    && npm install

# Assurez-vous que les fichiers et répertoires ont les bonnes permissions
RUN chown -R www-data:www-data /var/www/html/ \
    && chmod -R 755 /var/www/html/

# Exposer le port 80 pour le serveur web
EXPOSE 80

# Lancer Apache en mode foreground
CMD ["apache2-foreground"]
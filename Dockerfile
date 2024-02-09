# Utilisez l'image PHP officielle avec Apache
FROM php:7.4-apache

# Installe l'extension mysqli pour PHP, nécessaire pour MySQL
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli && docker-php-ext-install pdo_mysql

# Copie les fichiers du projet dans l'image
COPY . /var/www/html/

# Expose le port 8080
EXPOSE 8080

# Change le port par défaut d'Apache à 8080
RUN sed -i 's/80/8080/' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Change `localhost` par `db` dans le fichier de configuration de PHP
RUN sed -i 's/localhost/db/' /var/www/html/modele/bd.inc.php

# Lance Apache en arrière-plan
CMD ["apache2-foreground"]

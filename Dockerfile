# Utiliser une image de base PHP
FROM php:8.1-apache

# Installer les extensions nécessaires
RUN docker-php-ext-install pdo pdo_mysql

# Copier le contenu du projet dans le dossier de travail de l'image
COPY . /var/www/html/

# Configurer le répertoire de travail
WORKDIR /var/www/html

# Exposer le port 80
EXPOSE 80

# Commande par défaut
CMD ["apache2-foreground"]

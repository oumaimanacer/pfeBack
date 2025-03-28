# Utilisation d'une image PHP avec Apache
FROM php:8.1-apache

# Installation des extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql

# Copie des fichiers du projet
COPY . /var/www/html/

# Définition du répertoire de travail
WORKDIR /var/www/html

# Permissions pour le stockage et le cache
RUN chmod -R 777 storage bootstrap/cache

# Exposer le port 80
EXPOSE 80

# Commande pour démarrer Apache
CMD ["apache2-foreground"]

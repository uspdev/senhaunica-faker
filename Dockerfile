FROM php:8.5-apache

RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip

# cleanup
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# laravel
COPY . .
RUN chown -R www-data: /var/www
RUN a2enmod rewrite
RUN sed -i 's|/var/www/html|/var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Altera a porta do Apache de 80 para 3141 para usar com outros sistemas no docker-compose.yml
RUN sed -i 's/Listen 80/Listen 3141/g' /etc/apache2/ports.conf && \
    sed -i 's/<VirtualHost \*:80>/<VirtualHost \*:3141>/g' /etc/apache2/sites-available/000-default.conf

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

EXPOSE 3141

USER www-data
RUN composer install --no-interaction --no-dev



# fonte:
# [1] https://www.digitalocean.com/community/tutorials/how-to-install-and-set-up-laravel-with-docker-compose-on-ubuntu-22-04
# [2] https://github.com/docker-library

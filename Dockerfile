FROM uspdev/uspdev-php-apache:8.5


RUN sed -i 's|/var/www/html|/var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Altera a porta do Apache de 80 para 3141 para usar com outros sistemas no docker-compose.yml
RUN sed -i 's/Listen 80/Listen 3141/g' /etc/apache2/ports.conf && \
    sed -i 's/<VirtualHost \*:80>/<VirtualHost \*:3141>/g' /etc/apache2/sites-available/000-default.conf
EXPOSE 3141

USER www-data
COPY --chown=www-data . .

RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction

RUN cp .env.example .env

CMD ["apache2-foreground"]

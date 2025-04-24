FROM php:8.2-apache
COPY index.php /var/www/html/index.php
COPY style.css /var/www/html/style.css
COPY flag.txt /var/www/html/flag.txt
RUN a2enmod rewrite
RUN chmod 755 /var/www/html/flag.txt
EXPOSE 80
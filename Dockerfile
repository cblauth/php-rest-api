FROM php:8.0.3-apache-buster
COPY src/ /var/www/html/
EXPOSE 80
# Use the official PHP image as a base image
FROM php:8.0-apache

# Copy the current directory contents into the container at /var/www/html/
COPY . /var/www/html/

# Install PostgreSQL extension
RUN docker-php-ext-install pgsql

# Expose port 80 for the web server
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]

# Use an official PHP runtime as a parent image
FROM php:8.0-apache

# Install PostgreSQL extension for PHP
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pgsql

# Copy the PHP application into the container
COPY . /var/www/html/

# Set environment variables for PostgreSQL
ENV DB_HOST=34.174.37.121
ENV DB_PORT=5432
ENV DB_NAME=basicdetails
ENV DB_USER=postgres
ENV DB_PASSWORD=12qwaszx

# Expose port 80 for the web server
EXPOSE 8080

# Command to run the Apache server
CMD ["apache2-foreground"]

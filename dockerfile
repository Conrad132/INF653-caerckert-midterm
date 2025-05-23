# Use an official PHP runtime as a parent image
FROM php:8.2-apache

# Install required system packages and dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*
    
RUN docker-php-ext-install pdo_pgsql

# Set the working directory in the container
WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html

# Adding Postgres support:
RUN docker-php-ext-install pdo_pgsql

# Copy custom Apache configuration
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Enable Apache modules
RUN a2enmod rewrite

# Expose port 80 to allow incoming connections to the container
EXPOSE 80


# Use the official PHP image with Apache
FROM php:8.2-apache

# Set working directory inside the container
WORKDIR /var/www/html

# Copy all project files to the working directory
COPY . .

# Install necessary PHP extensions (optional, based on your needs)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Set proper permissions for the working directory
RUN chown -R www-data:www-data /var/www/html

# Expose the default HTTP port
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]

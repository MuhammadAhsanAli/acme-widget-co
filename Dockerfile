# Use the official PHP 8.3 CLI image
FROM php:8.3-cli

# Set the working directory in the container
WORKDIR /app

# Install dependencies and Composer
RUN apt-get update && \
    apt-get install -y \
         curl \
         git \
         zip \
         unzip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Copy application files
COPY . .

# Install PHP dependencies 
RUN composer install

# Command to run when starting the container
CMD ["php", "./vendor/bin/phpunit"]


FROM php:latest

# Copy the entire project directory into the Docker image
COPY . /usr/src/myapp

# Set the working directory
WORKDIR /usr/src/myapp

# Expose port 80 for web server
EXPOSE 80

# Install postgres support
RUN apt update && apt -y install libpq-dev
RUN docker-php-ext-install pgsql
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_pgsql

# Start the PHP built-in web server
CMD ["php", "-S", "0.0.0.0:80"]

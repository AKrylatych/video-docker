FROM php:8.1.18-zts

# Copy the entire project directory into the Docker image
COPY . /usr/src/myapp

# Set the working directory
WORKDIR /usr/src/myapp

# Expose port 80 for web server
EXPOSE 80

# Start the PHP built-in web server
CMD ["php", "-S", "0.0.0.0:80"]

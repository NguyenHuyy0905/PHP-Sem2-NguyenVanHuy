# Frontend and Backend Dockerfile

# Stage 1: Build frontend
FROM node:20 as frontend

WORKDIR /app/client

# Copy package.json and package-lock.json
COPY client/package*.json ./

# Install dependencies
RUN npm install

# Copy all files from current directory to /app/client in container
COPY client/ .

# Build production code
RUN npm run build


# Stage 2: Build backend
FROM php:8.0-fpm as backend

WORKDIR /app/server

# Install necessary PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Copy composer.json and composer.lock
COPY server/composer*.json ./

# Install composer dependencies
RUN composer install --no-dev --no-scripts --no-autoloader

# Copy all files from current directory to /app/server in container
COPY server/ .

# Generate optimized autoload file
RUN composer dump-autoload --optimize

# Set environment variables
ENV APP_ENV=production

# Expose port 8000
EXPOSE 8000

# Command when container runs
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]


# Stage 3: Combine frontend and backend
FROM nginx:alpine

# Copy frontend build from frontend stage to /usr/share/nginx/html in nginx container
COPY --from=frontend /app/client/build /usr/share/nginx/html

# Expose port 80
EXPOSE 80

# Command when container runs
CMD ["nginx", "-g", "daemon off;"]

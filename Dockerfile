FROM php:8.3-fpm-alpine

# Установка зависимостей
RUN apk add --no-cache \
    nginx \
    supervisor \
    git \
    curl \
    libpng-dev \
    oniguruma-dev \
    libxml2-dev \
    zip \
    unzip \
    icu-dev \
    libzip-dev \
    bash

# Установка PHP расширений
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd intl zip

# Настройка PHP для отладки
RUN echo "display_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-debug.ini \
    && echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-debug.ini \
    && echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/docker-php-ext-debug.ini \
    && echo "log_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-debug.ini

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Настройка рабочей директории
WORKDIR /var/www/html

# Копирование кода приложения
COPY . /var/www/html/

# Установка зависимостей
RUN composer install --optimize-autoloader --no-dev

# Настройка прав доступа
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Настройка Nginx
COPY docker/nginx.conf /etc/nginx/http.d/default.conf

# Настройка Supervisor
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Создание директории для логов
RUN mkdir -p /var/log/supervisor

# Создание скрипта запуска
RUN echo '#!/bin/bash\n\
echo "Starting application with PORT=${PORT:-8000}"\n\
sed -i "s/listen 0.0.0.0:8000/listen 0.0.0.0:${PORT:-8000}/g" /etc/nginx/http.d/default.conf\n\
echo "Nginx configuration:"\n\
cat /etc/nginx/http.d/default.conf\n\
echo "PHP modules:"\n\
php -m\n\
echo "Starting supervisord..."\n\
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf\n\
' > /start.sh && chmod +x /start.sh

# Экспозиция порта
EXPOSE ${PORT:-8000}

# Запуск скрипта
CMD ["/start.sh"] 
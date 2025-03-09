FROM php:8.3-fpm

# Установка системных зависимостей
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libicu-dev

# Очистка кэша apt
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Настройка PHP
RUN echo "upload_max_filesize=40M" > /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size=40M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "memory_limit=512M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "max_execution_time=600" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "max_input_time=600" >> /usr/local/etc/php/conf.d/uploads.ini

# Установка расширений PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Установка рабочей директории
WORKDIR /var/www

# Копирование кода приложения
COPY . /var/www

# Установка зависимостей через Composer
RUN composer install --no-interaction --optimize-autoloader

# Установка прав на директории
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Экспозиция порта 9000 для PHP-FPM
EXPOSE 9000

# Запуск PHP-FPM
CMD ["php-fpm"] 
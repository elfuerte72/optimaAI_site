#!/bin/bash
set -e

# Если .env файл не существует, создаем его
if [ ! -f .env ]; then
    echo "Creating .env file..."
    cp .env.example .env
fi

# Генерация ключа приложения, если он не установлен
php artisan key:generate --no-interaction --force

# Миграция базы данных
php artisan migrate --force

# Очистка кэша
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Оптимизация для продакшена
php artisan optimize

# Проверка переменной PORT
if [ -z "${PORT}" ]; then
    export PORT=8000
    echo "PORT not set, defaulting to 8000"
else
    echo "Using PORT: ${PORT}"
fi

exec "$@" 
#!/bin/bash

# Копирование .env.railway в .env при запуске
cp .env.railway .env

# Генерация ключа приложения, если он не установлен
php artisan key:generate --force

# Миграция базы данных
php artisan migrate --force

# Очистка кэша
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Оптимизация для продакшена
php artisan optimize

# Запуск сервера
php artisan serve --host=0.0.0.0 --port=${PORT:-8000} 
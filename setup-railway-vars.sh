#!/bin/bash

# Убедитесь, что Railway CLI установлен
if ! command -v railway &> /dev/null; then
    echo "Railway CLI не установлен. Установка..."
    npm i -g @railway/cli
    railway login
fi

# Установка переменных окружения
echo "Установка переменных окружения в Railway..."
railway variables set \
    APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stack \
    SESSION_DRIVER=database \
    CACHE_DRIVER=database \
    QUEUE_CONNECTION=database \
    MAIL_MAILER=log

echo "Переменные окружения успешно установлены!" 
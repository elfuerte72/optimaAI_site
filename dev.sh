#!/bin/bash

# Освобождаем порты, если они заняты
echo "Освобождаю порты..."
lsof -ti:8001 | xargs kill -9 2>/dev/null || true
lsof -ti:5173 | xargs kill -9 2>/dev/null || true

# Небольшая пауза для освобождения портов
sleep 1

# Запуск Laravel на порту 8001
echo "Запускаю Laravel на порту 8001..."
php artisan serve --port=8001 & 

# Запуск Vite через npm
echo "Запускаю Vite..."
npm run dev &

# Ожидаем запуска сервисов
sleep 2

# Вывод информации
echo "✅ Все сервисы запущены!"
echo "📱 Сайт доступен по адресу: http://127.0.0.1:8001"
echo "⚠️ Для остановки нажмите Ctrl+C"

# Ожидание сигналов для обработки корректного завершения
trap "echo '🛑 Останавливаю все процессы...'; kill 0" SIGINT SIGTERM

# Ожидание завершения процессов
wait 
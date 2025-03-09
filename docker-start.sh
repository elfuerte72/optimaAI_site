#!/bin/bash

# Проверка наличия .env.docker и создание его, если необходимо
if [ ! -f .env.docker ]; then
    echo "Creating .env.docker file..."
    cat > .env.docker << EOL
APP_NAME=OptimAI
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8001

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file

PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=root

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="\${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="\${APP_NAME}"
EOL
fi

# Запуск контейнеров
docker compose up -d

# Создание файла .env внутри контейнера
docker compose exec app bash -c "cp .env.example .env"

# Обновление настроек базы данных и Redis в файле .env
docker compose exec app bash -c "sed -i 's/DB_CONNECTION=sqlite/DB_CONNECTION=mysql/' .env && \
    sed -i 's/# DB_HOST=127.0.0.1/DB_HOST=mysql/' .env && \
    sed -i 's/# DB_PORT=3306/DB_PORT=3306/' .env && \
    sed -i 's/# DB_DATABASE=laravel/DB_DATABASE=laravel/' .env && \
    sed -i 's/# DB_USERNAME=root/DB_USERNAME=laravel/' .env && \
    sed -i 's/# DB_PASSWORD=/DB_PASSWORD=root/' .env && \
    sed -i 's/REDIS_HOST=127.0.0.1/REDIS_HOST=redis/' .env"

# Генерация ключа приложения
docker compose exec app php artisan key:generate --force

# Установка зависимостей Composer
docker compose exec app composer install

# Миграция базы данных
docker compose exec app php artisan migrate --force

# Очистка кэша
docker compose exec app php artisan cache:clear
docker compose exec app php artisan config:clear
docker compose exec app php artisan route:clear
docker compose exec app php artisan view:clear

echo "Docker environment is up and running!"
echo "Your application is available at: http://localhost:8001" 
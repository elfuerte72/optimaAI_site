# Использование Docker с OptimAI

Этот документ содержит инструкции по запуску проекта OptimAI с использованием Docker.

## Требования

- Docker
- Docker Compose

## Быстрый старт

1. Клонируйте репозиторий:
   ```bash
   git clone <repository-url>
   cd optimaai
   ```

2. Запустите скрипт для настройки и запуска Docker-окружения:
   ```bash
   ./docker-start.sh
   ```

3. Откройте приложение в браузере:
   ```
   http://localhost:8001
   ```

## Ручная настройка

Если вы предпочитаете настраивать окружение вручную, выполните следующие шаги:

1. Создайте файл .env.docker с настройками для Docker:
   ```bash
   cat > .env.docker << EOL
   APP_NAME=OptimAI
   APP_ENV=local
   APP_KEY=
   APP_DEBUG=true
   APP_URL=http://localhost:8001
   
   DB_CONNECTION=mysql
   DB_HOST=mysql
   DB_PORT=3306
   DB_DATABASE=laravel
   DB_USERNAME=laravel
   DB_PASSWORD=root
   
   REDIS_HOST=redis
   REDIS_PASSWORD=null
   REDIS_PORT=6379
   EOL
   ```

2. Запустите контейнеры:
   ```bash
   docker compose up -d
   ```

3. Копируйте файл .env.docker в контейнер:
   ```bash
   docker compose cp .env.docker optimaai-app:/var/www/.env
   ```

4. Генерация ключа приложения:
   ```bash
   docker compose exec app php artisan key:generate --force
   ```

5. Установите зависимости Composer:
   ```bash
   docker compose exec app composer install
   ```

6. Выполните миграции базы данных:
   ```bash
   docker compose exec app php artisan migrate --force
   ```

7. Очистите кэш:
   ```bash
   docker compose exec app php artisan cache:clear
   docker compose exec app php artisan config:clear
   docker compose exec app php artisan route:clear
   docker compose exec app php artisan view:clear
   ```

## Полезные команды

### Запуск контейнеров
```bash
docker compose up -d
```

### Остановка контейнеров
```bash
docker compose down
```

### Просмотр логов
```bash
docker compose logs -f
```

### Выполнение команд в контейнере PHP
```bash
docker compose exec app <command>
```

Примеры:
```bash
# Запуск миграций
docker compose exec app php artisan migrate

# Создание контроллера
docker compose exec app php artisan make:controller UserController

# Доступ к Tinker
docker compose exec app php artisan tinker
```

### Доступ к базе данных MySQL
```bash
docker compose exec mysql mysql -u laravel -p
```

## Структура Docker

- **app**: PHP-контейнер с Laravel, запускающий встроенный сервер PHP
- **mysql**: База данных MySQL
- **redis**: Кэш Redis

## Настройка

Основные настройки Docker находятся в следующих файлах:

- `docker-compose.yml`: Конфигурация контейнеров
- `Dockerfile`: Инструкции для сборки PHP-контейнера
- `.env.docker`: Настройки окружения для Docker

## Устранение неполадок

### Проблемы с правами доступа

Если у вас возникают проблемы с правами доступа к файлам, выполните:

```bash
docker compose exec app chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
```

### Проблемы с подключением к базе данных

Убедитесь, что настройки в файле .env внутри контейнера соответствуют настройкам в docker-compose.yml:

```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=root
```

### Ошибка 500 (Internal Server Error)

Если вы видите ошибку 500, проверьте логи Laravel:

```bash
docker compose exec app cat storage/logs/laravel.log
```

Часто причиной ошибки 500 является отсутствие ключа приложения или проблемы с подключением к базе данных. 
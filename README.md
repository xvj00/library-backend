# Library Backend

## Описание
RESTful backend для сервиса "Библиотека" с поддержкой ролей: Администратор, Библиотекарь, Клиент.

## Технологии
- PHP 8.x
- Laravel 10.x
- PostgreSQL
- Laravel Sanctum (JWT-like аутентификация)
- Email-уведомления (SMTP)
- Docker (опционально)

## Установка и запуск

```bash
git clone https://github.com/yourname/library-backend.git
cd library-backend
composer install
cp .env.example .env
# Укажи свои параметры БД и SMTP в .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

## Документация API

- Авторизация: `/api/login`, `/api/register`
- Пользователи: `/api/admin/users`
- Книги: `/api/books`
- Авторы: `/api/authors`
- Жанры: `/api/genres`
- Бронирования: `/api/reservations`
- Сброс пароля: `/api/forgot-password`, `/api/reset-password`



### Авторизация

```http
POST /api/login
{
  "email": "test@example.com",
  "password": "password"
}
```

### Бронирование книги

```http
POST /api/reservations
{
  "book_id": 1
}
```




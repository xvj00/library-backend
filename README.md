<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Сброс пароля через email

### 1. Запрос на сброс пароля

POST `/api/forgot-password`
```json
{
  "email": "user@example.com"
}
```
Ответ: `{ "message": "Ссылка для сброса пароля отправлена на email" }`

### 2. Сброс пароля по токену

POST `/api/reset-password`
```json
{
  "email": "user@example.com",
  "token": "токен_из_письма",
  "password": "newpassword",
  "password_confirmation": "newpassword"
}
```
Ответ: `{ "message": "Пароль успешно сброшен" }`

## Основные эндпоинты API и примеры запросов

### Аутентификация
- POST `/api/register`
  ```json
  { "name": "User", "email": "user@example.com", "password": "password" }
  ```
- POST `/api/login`
  ```json
  { "email": "user@example.com", "password": "password" }
  ```
- POST `/api/logout` (заголовок Authorization: Bearer TOKEN)
- POST `/api/forgot-password`
  ```json
  { "email": "user@example.com" }
  ```
- POST `/api/reset-password`
  ```json
  { "email": "user@example.com", "token": "TOKEN_ИЗ_ПИСЬМА", "password": "newpassword", "password_confirmation": "newpassword" }
  ```

### Пользователи (админ)
- GET `/api/admin/users` (заголовок Authorization: Bearer TOKEN)
- POST `/api/admin/users`
  ```json
  { "name": "User", "email": "user@example.com", "password": "password" }
  ```
- PUT `/api/admin/users/{id}`
  ```json
  { "password": "newpassword", "role": "librarian" }
  ```
- DELETE `/api/admin/users/{id}`
- POST `/api/admin/users/{id}/restore`
- DELETE `/api/admin/users/{id}/force`

### Бронирования (клиент)
- POST `/api/reservations`
  ```json
  { "book_id": 1 }
  ```
- GET `/api/reservations`
- POST `/api/reservations/{book}/cancel`

### Управление бронированиями (библиотекарь)
- GET `/api/librarian/reservations`
- POST `/api/librarian/reservations/{book}/confirm`
- POST `/api/librarian/reservations/{book}/cancel`
- POST `/api/librarian/reservations/{book}/given`
- POST `/api/librarian/reservations/{book}/returned`

### Книги
- GET `/api/books` — список книг
- GET `/api/books/{id}` — информация о книге
- (для библиотекаря/админа) POST `/api/books` — добавить книгу
- (для библиотекаря/админа) PUT/PATCH `/api/books/{id}` — обновить книгу
- (для библиотекаря/админа) DELETE `/api/books/{id}` — удалить книгу

### Авторы
- GET `/api/authors` — список авторов
- GET `/api/authors/{id}` — информация об авторе
- (для библиотекаря/админа) POST `/api/authors` — добавить автора
- (для библиотекаря/админа) PUT/PATCH `/api/authors/{id}` — обновить автора
- (для библиотекаря/админа) DELETE `/api/authors/{id}` — удалить автора

### Жанры
- GET `/api/genres` — список жанров
- GET `/api/genres/{id}` — информация о жанре
- (для библиотекаря/админа) POST `/api/genres` — добавить жанр
- (для библиотекаря/админа) PUT/PATCH `/api/genres/{id}` — обновить жанр
- (для библиотекаря/админа) DELETE `/api/genres/{id}` — удалить жанр

### Издания
- GET `/api/editions` — список изданий
- GET `/api/editions/{id}` — информация об издании
- (для библиотекаря/админа) POST `/api/editions` — добавить издание
- (для библиотекаря/админа) PUT/PATCH `/api/editions/{id}` — обновить издание
- (для библиотекаря/админа) DELETE `/api/editions/{id}` — удалить издание

### Пользователи (только для администратора)
- GET `/api/users` — список пользователей
- GET `/api/users/{id}` — информация о пользователе
- POST `/api/users` — создать пользователя
- PUT/PATCH `/api/users/{id}` — обновить пользователя
- DELETE `/api/users/{id}` — удалить пользователя

### Бронирования (для клиента)
- GET `/api/reservations` — список своих бронирований
- POST `/api/reservations` — создать бронирование
- DELETE `/api/reservations/{id}` — отменить бронирование

### Управление бронированиями (для библиотекаря)
- GET `/api/librarian/reservations` — список всех бронирований
- PATCH `/api/librarian/reservations/{id}/confirm` — подтвердить бронирование
- PATCH `/api/librarian/reservations/{id}/given` — выдать книгу
- PATCH `/api/librarian/reservations/{id}/returned` — принять книгу обратно
- DELETE `/api/librarian/reservations/{id}` — отменить бронирование

### Профиль
- GET `/api/profile` — информация о текущем пользователе (требует токен)

## Документация по API

Все эндпоинты имеют префикс `/api`.

### Аутентификация

| Метод  | Эндпоинт           | Описание                                     |
| :----- | :----------------- | :------------------------------------------- |
| `POST` | `/register`        | Регистрация нового пользователя.             |
| `POST` | `/login`           | Вход в систему для получения API токена.     |
| `POST` | `/logout`          | Выход из системы (требуется аутентификация). |
| `POST` | `/forgot-password` | Запрос ссылки для сброса пароля.             |
| `POST` | `/reset-password`  | Сброс пароля с использованием токена из письма. |

**Пример: Регистрация в Postman**
- **Метод:** `POST`
- **URL:** `http://127.0.0.1:8000/api/register`
- **Headers (Заголовки):**
  - `Accept`: `application/json`
  - `Content-Type`: `application/json`
- **Body (Тело запроса)** (вкладка `raw`, тип `JSON`):
```json
{
    "name": "Тестовый Пользователь",
    "email": "test@example.com",
    "password": "password",
    "password_confirmation": "password"
}
```

**Пример: Вход в систему в Postman**
- **Метод:** `POST`
- **URL:** `http://127.0.0.1:8000/api/login`
- **Headers (Заголовки):**
  - `Accept`: `application/json`
- **Body (Тело запроса)** (вкладка `raw`, тип `JSON`):
```json
{
    "email": "test@example.com",
    "password": "password"
}
```
> В ответе вы получите `token`. Скопируйте его и используйте в последующих запросах в заголовке `Authorization` со значением `Bearer <ВАШ_ТОКЕН>`.

### Профиль пользователя (требуется аутентификация)

| Метод    | Эндпоинт                | Описание                                           |
| :------- | :---------------------- | :------------------------------------------------- |
| `GET`    | `/user`                 | Получить данные текущего пользователя.             |
| `PATCH`  | `/profile/update`       | Обновить профиль пользователя (имя, email).        |
| `PATCH`  | `/profile/password`     | Обновить пароль пользователя.                      |
| `DELETE` | `/profile/delete`       | Удалить аккаунт пользователя.                      |
| `GET`    | `/profile/reservations` | Получить список бронирований пользователя.         |
| `POST`   | `/profile/reservations/{book}/cancel` | Отменить бронирование.              |
| `POST`   | `/reservations`         | Создать новое бронирование книги.                  |

### Книги и отзывы

| Метод  | Эндпоинт                 | Описание                                               |
| :----- | :----------------------- | :----------------------------------------------------- |
| `GET`  | `/books`                 | Получить список всех книг.                             |
| `GET`  | `/books/{id}`            | Получить детальную информацию о книге.                 |
| `GET`  | `/books/{book}/reviews`  | Получить все отзывы для конкретной книги.              |
| `POST` | `/books/{book}/reviews`  | Добавить новый отзыв для книги (требуется аутентификация). |
| `GET`  | `/reviews/{review}`      | Получить конкретный отзыв.                             |
| `PATCH`| `/reviews/{review}`      | Обновить свой отзыв (требуется аутентификация).        |
| `DELETE`| `/reviews/{review}`     | Удалить свой отзыв (требуется аутентификация).         |

**Пример: Добавление отзыва в Postman**
- **Метод:** `POST`
- **URL:** `http://127.0.0.1:8000/api/books/1/reviews` (замените `1` на ID нужной книги)
- **Headers (Заголовки):**
  - `Accept`: `application/json`
  - `Authorization`: `Bearer <ВАШ_ТОКЕН>` (токен, полученный при логине)
- **Body (Тело запроса)** (вкладка `raw`, тип `JSON`):
```json
{
    "rating": 5,
    "comment": "Эта книга была потрясающей!"
}
```

### Роль Библиотекаря (требуется аутентификация и роль `librarian`)

Все эндпоинты имеют префикс `/api/librarian`.

| Метод       | Эндпоинт                  | Описание                                  |
| :---------- | :------------------------ | :---------------------------------------- |
| `GET`       | `/reservations`           | Получить список всех бронирований.        |
| `POST`      | `/reservations/{book}/confirm` | Подтвердить бронирование книги.      |
| `POST`      | `/reservations/{book}/cancel`  | Отменить бронирование книги.          |
| `POST`      | `/reservations/{book}/given`   | Отметить книгу как выданную.          |
| `POST`      | `/reservations/{book}/returned`| Отметить книгу как возвращенную.      |
| `apiResource` | `/genres`               | Полное управление (CRUD) для жанров.      |
| `apiResource` | `/authors`              | Полное управление (CRUD) для авторов.     |
| `apiResource` | `/books`                | Полное управление (CRUD) для книг.        |
| `apiResource` | `/editions`             | Полное управление (CRUD) для изданий.     |

### Роль Администратора (требуется аутентификация и роль `admin`)

Все эндпоинты имеют префикс `/api/admin`.

| Метод       | Эндпоинт               | Описание                                          |
| :---------- | :--------------------- | :------------------------------------------------ |
| `apiResource` | `/users`               | Полное управление (CRUD) для пользователей.       |
| `POST`      | `/users/{id}/restore`  | Восстановить "мягко" удаленного пользователя.     |
| `DELETE`    | `/users/{id}/force`    | Окончательно удалить пользователя.                |

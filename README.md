# Laravel Blog

A simple blog with admin dashboard built with **Laravel**, featuring post management, categories, contact form, and RSS feeds.

## Features

- **Public pages**: Home (latest posts with pagination), post viewing, about, contact
- **Admin dashboard**: User management (CRUD), post management (CRUD), profile manager
- **Content**: Categories, posts with rich text, RSS feed
- **Contact**: Email contact form

## Tech Stack

- Laravel (PHP)
- MySQL/MariaDB
- Bootstrap (frontend)
- Composer dependencies

## Installation

```bash
git clone https://github.com/albertguedes/laravel-blog.git
cd laravel-blog
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

## License

MIT License - see [LICENSE](LICENSE.md)

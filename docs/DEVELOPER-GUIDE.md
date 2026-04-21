# Developer Guide

This guide is for developers who want to set up, modify, or extend the Laravel Blog application.

## Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Directory Structure](#directory-structure)
- [Database Schema](#database-schema)
- [Models](#models)
- [Routes](#routes)
- [Commands](#commands)
- [Testing](#testing)
- [Style Checking](#style-checking)
- [Frontend Development](#frontend-development)

---

## Requirements

- **PHP**: 8.2 or higher
- **Composer**: Latest stable version
- **Database**: SQLite (development) or MySQL/MariaDB (production)
- **Node.js**: 16+ (for frontend asset compilation)
- **Ollama**: For AI chatbot features (optional)

---

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/albertguedes/laravel-blog.git
cd laravel-blog
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Configure Environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure Database

**For SQLite (development):**
```bash
touch database/database.sqlite
```

**For MySQL (production):**
```bash
# Create database
mysql -u root -p
CREATE DATABASE laravel_blog;
EXIT;

# Update .env with MySQL credentials
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_blog
DB_USERNAME=your_user
DB_PASSWORD=your_password
```

### 5. Run Migrations

```bash
php artisan migrate
```

### 6. Seed Database (Optional)

```bash
php artisan db:seed
```

### 7. Start Development Server

```bash
php artisan serve
```

---

## Configuration

### Environment Variables (.env)

| Variable | Description | Default |
|----------|-------------|---------|
| `APP_NAME` | Blog name | Laravel Blog |
| `APP_ENV` | Environment | local |
| `APP_DEBUG` | Debug mode | true |
| `APP_URL` | Blog URL | http://localhost:8000 |
| `DB_CONNECTION` | Database driver | sqlite |
| `DB_DATABASE` | Database path/file | database/database.sqlite |
| `OLLAMA_MODEL` | LLM model for chatbot | llama2 |
| `OLLAMA_URL` | Ollama server URL | http://127.0.0.1:11434 |

### Blog Configuration (config/blog.php)

```php
return [
    'name' => env('APP_NAME', 'Laravel'),
    'description' => 'A simple blog made with Laravel',
    'creator' => 'Albert R. C. Guedes',
];
```

---

## Directory Structure

```
├── app/
│   ├── Console/
│   │   └── Commands/           # Artisan commands
│   ├── Helpers/
│   │   └── helpers.php         # Global helper functions
│   ├── Http/
│   │   ├── Controllers/        # Application controllers
│   │   │   └── Auth/           # Authentication controllers
│   │   ├── Middleware/         # Custom middleware
│   │   └── Requests/           # Form requests
│   ├── Mail/                   # Email classes
│   ├── Models/                 # Eloquent models
│   ├── Observers/              # Model observers
│   ├── Policies/               # Authorization policies
│   ├── Providers/              # Service providers
│   ├── Services/               # Business logic services
│   └── View/Components/        # Blade components
├── config/                     # Configuration files
├── database/
│   ├── factories/             # Model factories
│   ├── migrations/            # Database migrations
│   └── seeders/               # Database seeders
├── docs/                      # Documentation
├── resources/
│   └── views/                 # Blade templates
│       └── components/         # Blade components
├── routes/
│   ├── web.php                # Main routes
│   └── web/*.php              # Route subfiles
└── tests/
    ├── Feature/               # Feature tests
    └── Unit/                  # Unit tests
```

---

## Database Schema

### Users Table
| Column | Type | Description |
|--------|------|-------------|
| id | integer | Primary key |
| email | string | User email (unique) |
| password | string | Hashed password |
| is_active | boolean | Account active status |
| email_verified_at | timestamp | Email verification time |
| created_at | timestamp | Creation time |
| updated_at | timestamp | Last update time |

### Profiles Table
| Column | Type | Description |
|--------|------|-------------|
| id | integer | Primary key |
| user_id | integer | Foreign key to users |
| name | string | Display name |
| username | string | Username (unique) |
| about | text | User bio |
| created_at | timestamp | Creation time |
| updated_at | timestamp | Last update time |

### Posts Table
| Column | Type | Description |
|--------|------|-------------|
| id | integer | Primary key |
| author_id | integer | Foreign key to users |
| category_id | integer | Foreign key to categories |
| title | string | Post title |
| slug | string | URL slug (unique) |
| description | text | Post excerpt |
| content | text | Full post content |
| published | boolean | Publication status |
| created_at | timestamp | Creation time |
| updated_at | timestamp | Last update time |

### Categories Table
| Column | Type | Description |
|--------|------|-------------|
| id | integer | Primary key |
| parent_id | integer | Foreign key to parent category |
| title | string | Category title |
| slug | string | URL slug |
| description | text | Category description |
| is_active | boolean | Active status |
| created_at | timestamp | Creation time |
| updated_at | timestamp | Last update time |

### Tags Table
| Column | Type | Description |
|--------|------|-------------|
| id | integer | Primary key |
| title | string | Tag title |
| slug | string | URL slug |
| description | text | Tag description |
| is_active | boolean | Active status |
| created_at | timestamp | Creation time |
| updated_at | timestamp | Last update time |

### Post_Tag Table (Pivot)
| Column | Type | Description |
|--------|------|-------------|
| post_id | integer | Foreign key to posts |
| tag_id | integer | Foreign key to tags |
| created_at | timestamp | Association time |

### Post_Chunks Table (for RAG)
| Column | Type | Description |
|--------|------|-------------|
| id | integer | Primary key |
| post_id | integer | Foreign key to posts |
| content | text | Text chunk content |
| embedding | json | Vector embedding |
| created_at | timestamp | Creation time |
| updated_at | timestamp | Last update time |

### Verification_Tokens Table
| Column | Type | Description |
|--------|------|-------------|
| id | integer | Primary key |
| email | string | User email (links to users) |
| token | string | Unique verification token |
| expires_at | timestamp | Token expiration time |
| created_at | timestamp | Creation time |
| updated_at | timestamp | Last update time |

### Roles Table
| Column | Type | Description |
|--------|------|-------------|
| id | integer | Primary key |
| title | string | Role title (unique) |
| description | text | Role description |
| created_at | timestamp | Creation time |
| updated_at | timestamp | Last update time |

### Role_User Table (Pivot)
| Column | Type | Description |
|--------|------|-------------|
| user_id | integer | Foreign key to users |
| role_id | integer | Foreign key to roles |
| created_at | timestamp | Association time |

---

## Models

### User
```php
User::query()->with('profile')->find($id);
User::query()->with('posts')->find($id);
User::query()->with('roles')->find($id);
```

### Post
```php
Post::query()->where('published', true)->get();
Post::query()->with(['author', 'category', 'tags'])->get();
Post::query()->whereHas('tags', fn($q) => $q->where('slug', $tag))->get();
```

### Category
```php
Category::query()->where('is_active', true)->with('children')->get();
Category::query()->withCount('posts')->having('posts_count', '>', 0)->get();
```

### Tag
```php
Tag::query()->where('is_active', true)->withCount('posts')->get();
```

### Profile
```php
Profile::query()->where('user_id', $userId)->first();
```

---

## Routes

Routes are split across multiple files in `routes/web/`:

| File | Routes |
|------|--------|
| `routes/web.php` | Main route loader |
| `routes/web/auth.php` | Authentication routes |
| `routes/web/authors.php` | Author pages |
| `routes/web/categories.php` | Category pages |
| `routes/web/profile.php` | User profile pages |
| `routes/web/tags.php` | Tag pages |
| `routes/web/pages.php` | Static pages |
| `routes/breadcrumbs.php` | Breadcrumb definitions |

### Key Routes

| URL | Name | Description |
|-----|------|-------------|
| `/` | home | Home page |
| `/authors` | authors | Authors list |
| `/author/{author}` | author | Author profile |
| `/categories` | categories | Categories list |
| `/category/{category}` | category | Category posts |
| `/tags` | tags | Tags list |
| `/tag/{tag}` | tag | Tag posts |
| `/chat` | chat | Chatbot page |
| `/profile` | profile | User profile |
| `/auth/login` | login | Login page |
| `/auth/register` | register | Registration |
| `/contact` | contact | Contact form |
| `/search` | search | Search page |
| `/rss.xml` | rss | RSS feed |
| `/sitemap.xml` | sitemap | Sitemap |

---

## Commands

### Database Commands

```bash
php artisan migrate                 # Run pending migrations
php artisan migrate:fresh           # Drop all tables and re-migrate
php artisan migrate:rollback        # Rollback last migration batch
php artisan db:seed                 # Seed database
php artisan db:wipe                # Drop all tables
```

### Development Commands

```bash
php artisan serve                   # Start development server
php artisan tinker                # Open interactive shell
php artisan about                 # Show application info
php artisan route:list           # List all routes
php artisan route:list --path=api # List routes starting with api
```

### Cache Commands

```bash
php artisan cache:clear           # Clear application cache
php artisan config:clear         # Clear config cache
php artisan view:clear           # Clear compiled views
php artisan route:clear          # Clear route cache
```

---

## Testing

### Run All Tests

```bash
./vendor/bin/pest
```

### Run Specific Test Suites

```bash
./vendor/bin/pest --testsuite=Unit      # Unit tests only
./vendor/bin/pest --testsuite=Feature # Feature tests only
```

### Run Specific Test File

```bash
./vendor/bin/pest tests/Feature/RoutesTest.php
```

### Run Tests Matching Pattern

```bash
./vendor/bin/pest --filter=RoutesTest
```

### Test Database

Tests use SQLite in-memory database configured in `phpunit.xml`:

```xml
<env name="DB_CONNECTION" value="sqlite"/>
<env name="DB_DATABASE" value=":memory:"/>
```

### Writing Tests

Tests are written using Pest. See existing tests in `tests/` for examples.

```php
describe('Routes', function () {
    it('home page is accessible', function () {
        $response = $this->get('/');
        $response->assertStatus(200);
    });
});
```

---

## Style Checking

### Run Linter (Dry Run)

```bash
./vendor/bin/pint --test
```

### Apply Style Fixes

```bash
./vendor/bin/pint
```

### Style Configuration

The project uses Laravel preset with StyleCI configuration in `.styleci.yml`.

---

## Frontend Development

### Asset Compilation

```bash
npm run dev          # Development build (with watcher)
npm run prod         # Production build
npm run watch        # Watch mode for development
```

### Frontend Stack

- **Laravel Mix**: Asset bundler
- **Bootstrap**: CSS framework
- **Tailwind CSS**: Utility CSS
- **Alpine.js**: JavaScript framework
- **Font Awesome**: Icons

### CSS

Main stylesheet: `public/assets/css/style.css`

### JavaScript

- `public/assets/js/pages/` - Page-specific scripts
- `public/assets/js/helpers/` - Utility scripts
- `public/assets/js/script.js` - Main script

---

## Ollama Setup (Optional)

The chatbot uses Ollama for AI features.

### Install Ollama

```bash
# Linux/macOS
curl -fsSL https://ollama.com/install.sh | sh
```

### Start Ollama Server

```bash
ollama serve
```

### Pull Model

```bash
ollama pull llama2
# or
ollama pull nomic-embed-text  # For embeddings
```

### Verify Configuration

```bash
php artisan tinker
>>> config('ollama-laravel.url')
=> "http://127.0.0.1:11434"
```

---

## Troubleshooting

### Common Issues

**Migration fails:**
```bash
php artisan migrate:fresh --seed
```

**View not found:**
```bash
php artisan view:clear
```

**Config not loading:**
```bash
php artisan config:clear
php artisan cache:clear
```

**Tests failing:**
```bash
php artisan test --env=testing
```

**Ollama connection error:**
- Ensure Ollama is running: `ollama serve`
- Check URL in `.env`: `OLLAMA_URL=http://127.0.0.1:11434`
- Test connection: `curl http://127.0.0.1:11434/api/tags`

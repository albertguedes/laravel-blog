# Architecture Guide

This document describes the system architecture of the Laravel Blog application.

## Table of Contents

- [Architecture Overview](#architecture-overview)
- [Request Lifecycle](#request-lifecycle)
- [Service Layer](#service-layer)
- [Model Relationships](#model-relationships)
- [Middleware Stack](#middleware-stack)
- [Route Organization](#route-organization)
- [View Components](#view-components)
- [Database Design](#database-design)

---

## Architecture Overview

The Laravel Blog follows a layered architecture:

```
┌─────────────────────────────────────────────────────────┐
│                    Routes (web.php)                     │
├─────────────────────────────────────────────────────────┤
│                  Controllers                             │
│    IndexController, AuthorsController, ChatController   │
├─────────────────────────────────────────────────────────┤
│                 Service Layer                            │
│   ChatService, RAGService, BlogQueryService, etc.      │
├─────────────────────────────────────────────────────────┤
│                  Models (Eloquent)                       │
│       User, Post, Category, Tag, Profile, etc.           │
├─────────────────────────────────────────────────────────┤
│                   Database                               │
│              SQLite / MySQL                             │
└─────────────────────────────────────────────────────────┘
```

### Key Design Principles

1. **Service Layer**: Business logic in services, not controllers
2. **Repository Pattern**: Models accessed via Eloquent queries
3. **Component-Based Views**: Reusable Blade components
4. **Route Organization**: Routes split by domain
5. **Middleware Stack**: Authentication and security handled at middleware level

---

## Request Lifecycle

### Web Request Flow

```
1. HTTP Request
       │
       ▼
2. Middleware Stack
   - EncryptCookies
   - AddQueuedCookiesToResponse
   - StartSession
   - ShareErrorsFromSession
   - VerifyCsrfToken
   - SubstituteBindings
       │
       ▼
3. Route Matching
       │
       ▼
4. Controller Method
       │
       ▼
5. Service Layer (if needed)
       │
       ▼
6. Model/Database
       │
       ▼
7. View Rendering
       │
       ▼
8. Middleware (response)
       │
       ▼
9. HTTP Response
```

### Chat Request Flow

```
1. POST /chat (AJAX)
       │
       ▼
2. Middleware (session, CSRF, auth optional)
       │
       ▼
3. ChatController@ask
       │
       ▼
4. ChatService
       │
       ├── QuestionRouterService → determines SQL or RAG
       │
       ├── SqlAgentService (if SQL)
       │     └── BlogQueryService → Database
       │
       └── RAGService (if RAG)
             ├── EmbeddingService
             ├── VectorSearchService
             └── Ollama (LLM)
       │
       ▼
5. JSON Response
```

---

## Service Layer

### Services Overview

| Service | File | Responsibility |
|---------|------|---------------|
| `ChatService` | `app/Services/ChatService.php` | Main chatbot orchestration |
| `QuestionRouterService` | `app/Services/QuestionRouterService.php` | Routes questions to SQL or RAG |
| `QuestionClassifierService` | `app/Services/QuestionClassifierService.php` | Classifies question type for routing |
| `SqlAgentService` | `app/Services/SqlAgentService.php` | Handles SQL-based questions |
| `RAGService` | `app/Services/RAGService.php` | Handles RAG-based questions |
| `BlogQueryService` | `app/Services/BlogQueryService.php` | Reusable database queries |
| `EmbeddingService` | `app/Services/EmbeddingService.php` | Generates text embeddings |
| `VectorSearchService` | `app/Services/VectorSearchService.php` | Searches by vector similarity |
| `BlogContextService` | `app/Services/BlogContextService.php` | Provides blog metadata |
| `StatsService` | `app/Services/StatsService.php` | Blog statistics (deprecated) |
| `VerifyEmailService` | `app/Services/Auth/VerifyEmailService.php` | Email verification handling |
| `PasswordForgotService` | `app/Services/Auth/PasswordForgotService.php` | Password reset handling |

### Service Dependencies

```
ChatService
    ├── QuestionRouterService (no dependencies)
    ├── SqlAgentService
    │       └── BlogQueryService
    │               └── Models (User, Post, Category, Tag)
    └── RAGService
            ├── BlogContextService
            ├── EmbeddingService
            │       └── Ollama API
            └── VectorSearchService
                    └── PostChunk model
```

---

## Model Relationships

### Entity Relationship Diagram (Text)

```
┌─────────────┐       ┌─────────────┐       ┌─────────────┐
│    User     │───────│    Post     │───────│  Category   │
│             │  1:N  │             │  N:1  │             │
│ - id        │───────│ - id        │───────│ - id        │
│ - email     │       │ - title     │       │ - title     │
│ - is_active │       │ - content    │       │ - parent_id │
└─────┬───────┘       │ - published  │       └──────┬──────┘
      │              │ - author_id  │              │ 1:N
      │ 1:1          │ - category_id│              │
      │              └──────┬───────┘              │
      │                     │ N:M                 │
┌─────┴───────┐              │              ┌─────┴───────┐
│  Profile    │              │              │    Tag       │
│             │              │              │              │
│ - id        │              │              │ - id         │
│ - user_id    │              │              │ - title      │
│ - name      │              │              │ - slug       │
│ - username   │              └──────────────│              │
│ - about     │                     N:M       └──────────────┘
└─────────────┘              ┌─────────────┐
                            │  Post_Tag    │
                            │  (pivot)     │
                            │ - post_id    │
                            │ - tag_id     │
                            └─────────────┘
```

### Models (8 total)

| Model | File | Purpose |
|-------|------|---------|
| `User` | User.php | User accounts with authentication |
| `Profile` | Profile.php | Extended user information |
| `Post` | Post.php | Blog post content |
| `Category` | Category.php | Hierarchical categories |
| `Tag` | Tag.php | Post tags |
| `Role` | Role.php | User roles |
| `PostChunk` | PostChunk.php | Chunked posts for RAG embeddings |
| `VerificationToken` | VerificationToken.php | Email verification tokens |

### Relationship Summary

| Model | Relationships |
|-------|--------------|
| `User` | hasOne Profile, hasMany Posts, belongsToMany Roles, hasOne VerificationToken, resolveRouteBinding by profile.username |
| `Profile` | belongsTo User |
| `Post` | belongsTo User (author), belongsTo Category, belongsToMany Tags |
| `Category` | belongsTo Parent (self-referencing), hasMany Children, hasMany Posts |
| `Tag` | belongsToMany Posts |
| `Role` | belongsToMany Users |
| `PostChunk` | belongsTo Post (for RAG) |
| `VerificationToken` | belongsTo User (via email), expires_at for token validity |
| `PostTag` | Pivot model for Post-Tag many-to-many |
| `RoleUser` | Pivot model for Role-User many-to-many |

---

## Middleware Stack

### Web Middleware (in order)

```php
EncryptCookies::class,
AddQueuedCookiesToResponse::class,
StartSession::class,
ShareErrorsFromSession::class,
VerifyCsrfToken::class,
SubstituteBindings::class,
```

### Custom Middleware

| Middleware | File | Purpose |
|-----------|------|---------|
| `Authenticate` | `app/Http/Middleware/Authenticate.php` | Redirects to login if not authenticated |
| `CheckAdmin` | `app/Http/Middleware/CheckAdmin.php` | Checks for admin role |
| `RedirectIfAuthenticated` | `app/Http/Middleware/RedirectIfAuthenticated.php` | Redirects authenticated users |
| `TrustProxies` | `app/Http/Middleware/TrustProxies.php` | Trust proxy headers |
| `EnsureEmailIsVerified` | `app/Http/Middleware/EnsureEmailIsVerified.php` | Redirects unverified users to verification page |

### Middleware Aliases

```php
'alias' => [
    'auth' => Authenticate::class,
    'auth.basic' => AuthenticateWithBasicAuth::class,
    'cache.headers' => SetCacheHeaders::class,
    'can' => Authorize::class,
    'guest' => RedirectIfAuthenticated::class,
    'password.confirm' => RequirePassword::class,
    'signed' => ValidateSignature::class,
    'throttle' => ThrottleRequests::class,
    'verified' => EnsureEmailIsVerified::class,
    'admin' => CheckAdmin::class,
],
```

---

## Route Organization

### Route Files

| File | Routes |
|------|--------|
| `routes/web.php` | Main loader, includes all subfiles |
| `routes/web/auth.php` | Login, register, password reset, email verification |
| `routes/web/authors.php` | Authors index and show |
| `routes/web/categories.php` | Categories index and show |
| `routes/web/profile.php` | User profile management |
| `routes/web/tags.php` | Tags index and show |
| `routes/web/pages.php` | Static pages (home, about, contact, etc.) |
| `routes/breadcrumbs.php` | Breadcrumb definitions |

### Route Loading Order

Routes are loaded in this order to prevent conflicts:

1. `routes/web/auth.php` - Auth routes first
2. `routes/web/authors.php` - Author routes
3. `routes/web/categories.php` - Category routes
4. `routes/web/profile.php` - Profile routes
5. `routes/web/tags.php` - Tag routes
6. `routes/web/pages.php` - **Last** (catches remaining URLs)

**Important**: `pages.php` is loaded last because it contains the catch-all post route (`/{post}`) which would match everything if loaded first.

### Complete Route Tables

#### routes/web/auth.php (21 routes)

| Method | URI | Name | Controller@Method |
|--------|-----|------|-------------------|
| GET | auth/login | login | LoginController@create |
| POST | auth/login | login.store | LoginController@store |
| GET | auth/register | register | RegisterController@create |
| POST | auth/register | register.store | RegisterController@store |
| GET | auth/password/forgot | password | PasswordForgotController@index |
| POST | auth/password/forgot | password.store | PasswordForgotController@store |
| GET | auth/password/reset/{token} | password.reset | PasswordForgotController@edit |
| POST | auth/password/reset | password.reset.update | PasswordForgotController@update |
| POST | auth/logout | logout | LoginController@destroy |
| GET | auth/verify-email/resend | verify-email.resend | VerifyEmailController@edit |
| POST | auth/verify-email/resend | verify-email.resend.update | VerifyEmailController@update |
| GET | auth/verify-email/{token} | verify-email | VerifyEmailController@index |

#### routes/web/profile.php (15 routes)

| Method | URI | Name | Controller@Method |
|--------|-----|------|-------------------|
| GET | /profile | profile | ProfileController@index |
| GET | /profile/edit | profile.edit | ProfileController@edit |
| PUT | /profile | profile.update | ProfileController@update |
| GET | /profile/delete | profile.delete | ProfileController@delete |
| DELETE | /profile | profile.destroy | ProfileController@destroy |
| GET | /profile/password | profile.password | ProfileController@password |
| PUT | /profile/password | profile.password.update | ProfileController@passwordUpdate |
| GET | /profile/posts | profile.posts | PostsController@index |
| GET | /profile/post/create | profile.post.create | PostsController@create |
| POST | /profile/post | profile.post.store | PostsController@store |
| GET | /profile/post/{post} | profile.post | PostsController@show |
| GET | /profile/post/{post}/edit | profile.post.edit | PostsController@edit |
| PUT | /profile/post/{post} | profile.post.update | PostsController@update |
| GET | /profile/post/{post}/delete | profile.post.delete | PostsController@delete |
| DELETE | /profile/post/{post} | profile.post.destroy | PostsController@destroy |

#### routes/web/pages.php (12 routes)

| Method | URI | Name | Controller@Method |
|--------|-----|------|-------------------|
| GET | / | home | IndexController@index |
| GET | /about | about | IndexController@about |
| GET | /contact | contact | ContactController@index |
| POST | /contact | contact.send | ContactController@send |
| GET | /archive | archive | ArchiveController |
| GET | /chat | chat | ChatController@index |
| POST | /chat | chat.ask | ChatController@ask |
| POST | /chat/clear | chat.clear | ChatController@clearHistory |
| GET | /search | search | SearchController |
| GET | /rss.xml | rss | FeedController |
| GET | /sitemap.xml | sitemap | SitemapController |
| GET | /{post} | post | IndexController@post |

#### routes/web/tags.php (2 routes)

| Method | URI | Name | Controller@Method |
|--------|-----|------|-------------------|
| GET | /tags | tags | TagsController@index |
| GET | /tags/{tag} | tag | TagsController@show |

#### routes/web/categories.php (2 routes)

| Method | URI | Name | Controller@Method |
|--------|-----|------|-------------------|
| GET | /categories | categories | CategoriesController@index |
| GET | /category/{category} | category | CategoriesController@show |

#### routes/web/authors.php (2 routes)

| Method | URI | Name | Controller@Method |
|--------|-----|------|-------------------|
| GET | /authors | authors | AuthorsController@index |
| GET | /author/{author} | author | AuthorsController@show |

### Controllers

#### Main Controllers (app/Http/Controllers/)

| Controller | File | Purpose |
|------------|------|---------|
| `IndexController` | IndexController.php | Home page, about, single post display |
| `ArchiveController` | ArchiveController.php | Archive page listing |
| `ChatController` | ChatController.php | AI chatbot interface (index, ask, clearHistory) |
| `ContactController` | ContactController.php | Contact form (index, send) |
| `SearchController` | SearchController.php | Search functionality |
| `TagsController` | TagsController.php | Tag listing and display |
| `CategoriesController` | CategoriesController.php | Category listing and display |
| `AuthorsController` | AuthorsController.php | Author listing and display |
| `SitemapController` | SitemapController.php | XML sitemap generation |
| `FeedController` | FeedController.php | RSS feed generation |

#### Auth Controllers (app/Http/Controllers/Auth/)

| Controller | File | Purpose |
|------------|------|---------|
| `LoginController` | LoginController.php | Login (create, store), logout (destroy) |
| `RegisterController` | RegisterController.php | Registration (create, store) |
| `VerifyEmailController` | VerifyEmailController.php | Email verification (index, edit, update) |
| `PasswordForgotController` | PasswordForgotController.php | Password reset (index, store, edit, update) |

#### Profile Controllers (app/Http/Controllers/Profile/)

| Controller | File | Purpose |
|------------|------|---------|
| `ProfileController` | ProfileController.php | Profile management (index, edit, update, delete, destroy, password, passwordUpdate) |
| `PostsController` | PostsController.php | Post management (index, create, store, show, edit, update, delete, destroy) |

---

## View Components

### Component Structure

```
app/View/Components/
├── Archive/                   # Archive-specific components
│   ├── Archive.php
│   └── ArchiveTitle.php
├── Authors/                   # Author-specific components
│   ├── AuthorCard.php
│   └── Link.php
├── Common/                    # Shared across multiple views
│   ├── BootstrapPagination.php
│   ├── CategoryForm.php
│   ├── CategoryMenu.php
│   ├── CategoryPosts.php
│   ├── ContactForm.php
│   ├── FlashMessages.php
│   ├── JsonLdSchema.php
│   ├── PageTitle.php
│   ├── PasswordForm.php
│   ├── PostForm.php
│   ├── PostsList.php
│   ├── ProfileEditForm.php
│   ├── SendButton.php
│   ├── ShowPost.php
│   ├── SideMenu.php
│   ├── TagCloud.php
│   ├── TagPosts.php
│   ├── TagsForm.php
│   ├── Tree.php
│   └── UserProfile.php
├── Layouts/                  # Exclusive to specific layouts
│   ├── Auth.php
│   ├── Error.php              # Error page layout (404, 500, 503)
│   ├── Main.php
│   ├── Main/Footer.php
│   ├── Mail.php
│   └── Profile.php
│   └── Profile/Navbar.php
├── Posts/                     # Post-specific components
│   └── PostDetails.php
└── Profile/Posts/             # Profile post management
    ├── PostForm.php
    ├── PostTabs.php
    └── PostsList.php

resources/views/components/
├── archive/                   # Blade templates for Archive components
│   ├── archive.blade.php
│   └── archive-title.blade.php
├── authors/                   # Blade templates for Authors components
│   ├── author-card.blade.php
│   └── link.blade.php
├── common/                    # Blade templates for Common components
│   ├── bootstrap-pagination.blade.php
│   ├── category-form.blade.php
│   ├── category-menu.blade.php
│   ├── category-posts.blade.php
│   ├── contact-form.blade.php
│   ├── flash-messages.blade.php
│   ├── json-ld-schema.blade.php
│   ├── page-title.blade.php
│   ├── password-form.blade.php
│   ├── post-form.blade.php
│   ├── posts-list.blade.php
│   ├── profile-edit-form.blade.php
│   ├── send-button.blade.php
│   ├── show-post.blade.php
│   ├── side-menu.blade.php
│   ├── tag-cloud.blade.php
│   ├── tag-posts.blade.php
│   ├── tags-form.blade.php
│   ├── tree.blade.php
│   └── user-profile.blade.php
├── layouts/                   # Blade templates for Layout components
│   ├── auth.blade.php
│   ├── error.blade.php
│   ├── main.blade.php
│   ├── mail.blade.php
│   └── profile.blade.php
├── posts/                    # Blade templates for Posts components
│   └── post-details.blade.php
└── profile/posts/            # Blade templates for Profile Posts
    ├── post-form.blade.php
    ├── post-tabs.blade.php
    └── posts-list.blade.php
```

### Component Naming

Laravel converts kebab-case component names to PascalCase based on directory structure:
- `common/tree` → `Common\Tree` → `<x-common.tree />`
- `layouts/main` → `Layouts\Main` → `<x-layouts.main />`
- `authors/link` → `Authors\Link` → `<x-authors.link />`
- `posts/post-details` → `Posts\PostDetails` → `<x-posts.post-details />`

### Usage

```blade
<x-common.tree :categories="$categories" />

<x-layouts.main title="Page Title">
    <p>Content</p>
</x-layouts.main>

<x-authors.link :author-id="$post->author->id" />

<x-posts.post-details :post="$post" />
```

---

## Database Design

### Primary Tables

| Table | Purpose |
|-------|---------|
| `users` | User accounts with authentication (includes `is_admin` flag) |
| `profiles` | Extended user information (username, name, about) |
| `posts` | Blog post content |
| `categories` | Hierarchical categories |
| `tags` | Post tags |
| `post_tag` | Many-to-many post-tag relationships |
| `roles` | User roles |
| `role_user` | Many-to-many user-role relationships |
| `password_resets` | Password reset tokens |
| `failed_jobs` | Failed queue jobs |
| `post_chunks` | Chunked posts for RAG embeddings |

### Key Design Decisions

1. **Hierarchical Categories**: Self-referencing `parent_id` for tree structure
2. **Profile Separation**: User profile data in separate table for flexibility
3. **Post Chunks**: Content chunked for efficient vector search
4. **Soft Deletes**: Not used (hard deletes for simplicity)
5. **Admin Flag**: `is_admin` column on users for simple admin access control

---

## Configuration Files

| File | Purpose |
|------|---------|
| `config/app.php` | Application settings |
| `config/blog.php` | Blog-specific settings |
| `config/database.php` | Database connections |
| `config/ollama-laravel.php` | Ollama AI configuration |
| `config/breadcrumbs.php` | Breadcrumb definitions |
| `config/auth.php` | Authentication settings |
| `config/mail.php` | Email configuration |

---

## Error Handling

### Exception Rendering (bootstrap/app.php)

```php
->withExceptions(function (Exceptions $exceptions) {
    $exceptions->render(function (NotFoundHttpException $e) {
        return response()->view('errors.404', [], 404);
    });

    $exceptions->render(function (QueryException $e) {
        return response()->view('errors.503', [], 503);
    });
});
```

### Error Pages

| Page | File |
|------|------|
| 404 | `resources/views/errors/404.blade.php` |
| 500 | `resources/views/errors/500.blade.php` |
| 503 | `resources/views/errors/503.blade.php` |

---

## Related Documentation

- [Chatbot](CHATBOT.md) - Chatbot architecture details
- [Developer Guide](DEVELOPER-GUIDE.md) - General development info
- [Deployment](DEPLOYMENT.md) - Production deployment

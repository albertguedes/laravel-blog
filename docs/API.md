# Admin API Documentation

RESTful API for administrative management of blog resources.

## Base URL

```
/api/admin
```

## Authentication

All endpoints require:
- Valid Sanctum token (`Authorization: Bearer {token}`)
- Admin privileges (`is_admin` = true on User model)

## Response Format

All responses follow a standardized JSON structure:

```json
{
    "data": { ... },
    "message": "Optional success message",
    "meta": { ... }
}
```

### Success Response (Single Resource)
```json
{
    "data": {
        "id": 1,
        "title": "Resource Title",
        ...
    },
    "message": "Resource retrieved successfully."
}
```

### Success Response (Paginated)
```json
{
    "data": [ ... ],
    "meta": {
        "current_page": 1,
        "per_page": 15,
        "total": 100,
        "last_page": 7
    },
    "message": null
}
```

### Error Response
```json
{
    "message": "Error description",
    "errors": { ... }
}
```

## Status Codes

| Code | Description |
|------|-------------|
| 200 | Success |
| 201 | Created |
| 400 | Bad Request |
| 404 | Not Found |
| 422 | Validation Error |
| 500 | Server Error |

## Resources

### Users

#### List Users
```
GET /api/admin/users
```
Paginated list of users with profile and roles.

**Response:** `200 OK` (paginated)

#### Create User
```
POST /api/admin/users
```
**Request Body:**
```json
{
    "email": "user@example.com",
    "password": "password123",
    "name": "John Doe",
    "username": "johndoe",
    "about": "User bio (optional)",
    "is_active": true,
    "is_admin": false
}
```
**Response:** `201 Created`

#### Get User
```
GET /api/admin/users/{id}
```
**Response:** `200 OK`

#### Update User
```
PUT /api/admin/users/{id}
```
**Request Body:** Same as Create, all fields optional.
```json
{
    "email": "new@example.com",
    "password": "newpassword123",
    "name": "Updated Name",
    "username": "newname",
    "about": "Updated bio",
    "is_active": true,
    "is_admin": true
}
```
**Response:** `200 OK`

#### Delete User
```
DELETE /api/admin/users/{id}
```
Soft deletes the user.
**Response:** `200 OK`

---

### Roles

#### List Roles
```
GET /api/admin/roles
```
Paginated list of roles.

**Response:** `200 OK` (paginated)

#### Create Role
```
POST /api/admin/roles
```
**Request Body:**
```json
{
    "title": "Editor",
    "description": "Can edit content (optional)",
    "is_active": true
}
```
**Response:** `201 Created`

#### Get Role
```
GET /api/admin/roles/{id}
```
**Response:** `200 OK`

#### Update Role
```
PUT /api/admin/roles/{id}
```
**Request Body:** Same as Create, all fields optional.
**Response:** `200 OK`

#### Delete Role
```
DELETE /api/admin/roles/{id}
```
Soft deletes the role.
**Response:** `200 OK`

---

### Tags

#### List Tags
```
GET /api/admin/tags
```
Paginated list of tags ordered by title.

**Response:** `200 OK` (paginated)

#### Create Tag
```
POST /api/admin/tags
```
**Request Body:**
```json
{
    "title": "Laravel",
    "slug": "laravel (optional, auto-generated if empty)",
    "description": "Tag description (optional)",
    "is_active": true
}
```
**Response:** `201 Created`

#### Get Tag
```
GET /api/admin/tags/{id}
```
**Response:** `200 OK`

#### Update Tag
```
PUT /api/admin/tags/{id}
```
**Request Body:** Same as Create, all fields optional.
**Response:** `200 OK`

#### Delete Tag
```
DELETE /api/admin/tags/{id}
```
Soft deletes the tag.
**Response:** `200 OK`

---

### Categories

#### List Categories
```
GET /api/admin/categories
```
Paginated list of categories ordered by title.

**Response:** `200 OK` (paginated)

#### Create Category
```
POST /api/admin/categories
```
**Request Body:**
```json
{
    "parent_id": null,
    "title": "Programming",
    "slug": "programming (optional, auto-generated if empty)",
    "description": "Category description (optional)",
    "is_active": true
}
```
**Response:** `201 Created`

#### Get Category
```
GET /api/admin/categories/{id}
```
**Response:** `200 OK`

#### Update Category
```
PUT /api/admin/categories/{id}
```
**Request Body:** Same as Create, all fields optional.
**Response:** `200 OK`

#### Delete Category
```
DELETE /api/admin/categories/{id}
```
Soft deletes the category.
**Response:** `200 OK`

---

### Posts

#### List Posts
```
GET /api/admin/posts
```
Paginated list of posts with author, category, and tags.

**Response:** `200 OK` (paginated)

#### Create Post
```
POST /api/admin/posts
```
**Request Body:**
```json
{
    "author_id": 1,
    "category_id": 1,
    "title": "My First Post",
    "slug": "my-first-post (optional, auto-generated if empty)",
    "description": "Post summary",
    "content": "Full post content",
    "published": true,
    "tags": [1, 2, 3]
}
```
**Response:** `201 Created`

#### Get Post
```
GET /api/admin/posts/{id}
```
**Response:** `200 OK`

#### Update Post
```
PUT /api/admin/posts/{id}
```
**Request Body:** Same as Create, all fields optional.
**Response:** `200 OK`

#### Delete Post
```
DELETE /api/admin/posts/{id}
```
Soft deletes the post and detaches tags.
**Response:** `200 OK`

---

## Validation Rules

### Users

| Field | Store | Update |
|-------|-------|--------|
| email | required, email, unique | sometimes, email, unique:users |
| password | required, min:8 | sometimes, nullable, min:8 |
| name | required, min:4 | sometimes, min:4 |
| username | required, min:4, unique:profiles | sometimes, min:4, unique:profiles |
| about | nullable, max:1000 | nullable, max:1000 |
| is_active | boolean | boolean |
| is_admin | boolean | boolean |

### Roles

| Field | Store | Update |
|-------|-------|--------|
| title | required, min:3, max:50, unique | sometimes, min:3, max:50, unique:roles |
| description | nullable, max:500 | nullable, max:500 |
| is_active | boolean | boolean |

### Tags

| Field | Store | Update |
|-------|-------|--------|
| title | required, min:2, max:100, unique | sometimes, min:2, max:100, unique:tags |
| slug | nullable, min:2, max:100, unique:tags | sometimes, nullable, min:2, max:100, unique:tags |
| description | nullable, max:500 | nullable, max:500 |
| is_active | boolean | boolean |

### Categories

| Field | Store | Update |
|-------|-------|--------|
| parent_id | nullable, exists:categories | nullable, exists:categories |
| title | required, min:2, max:100, unique | sometimes, min:2, max:100, unique:categories |
| slug | nullable, min:2, max:100, unique:categories | sometimes, nullable, min:2, max:100, unique:categories |
| description | nullable, max:500 | nullable, max:500 |
| is_active | boolean | boolean |

### Posts

| Field | Store | Update |
|-------|-------|--------|
| author_id | required, exists:users | sometimes, exists:users |
| category_id | nullable, exists:categories | nullable, exists:categories |
| title | required, min:4, max:255, unique | sometimes, min:4, max:255, unique:posts |
| slug | nullable, min:4, max:255, unique:posts | sometimes, nullable, min:4, max:255, unique:posts |
| description | required, min:4 | sometimes, min:4 |
| content | required, min:4 | sometimes, min:4 |
| published | boolean | boolean |
| tags | array of existing tag IDs | array of existing tag IDs |

## Soft Deletes

All resources support soft deletes. Deleted resources:
- Are not returned in standard queries
- Can be restored by implementing custom restore endpoints if needed
- Associated relationships are preserved

## Middleware

- `auth:sanctum` - Validates Sanctum authentication
- `admin` - Checks `is_admin` boolean on authenticated user

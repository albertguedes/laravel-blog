# User Guide

This guide is for end-users who want to browse and interact with the blog.

## Table of Contents

- [Browsing Posts](#browsing-posts)
- [Categories](#categories)
- [Tags](#tags)
- [Authors](#authors)
- [Search](#search)
- [RSS Feed](#rss-feed)
- [Contact Form](#contact-form)
- [User Account](#user-account)
- [Chatbot](#chatbot)

---

## Browsing Posts

### Home Page

The home page (`/`) displays the latest published posts with pagination. Each post shows:
- Title
- Description (excerpt)
- Author name
- Category
- Publication date
- Tags

### Reading a Post

Click on any post title to read the full article. The post page shows:
- Full content
- Author information
- Category
- Tags
- Related posts (from the same author or category)

---

## Categories

### View All Categories

Visit `/categories` to see all active categories with post counts.

### Browse by Category

Click on any category to see all posts in that category. Categories can be hierarchical (parent/child categories).

### Category Features

- Only active categories with published posts are shown in menus
- Categories inherit visibility from parent categories
- Inactive categories are hidden but their posts remain accessible

---

## Tags

### View All Tags

Visit `/tags` to see all active tags with post counts.

### Browse by Tag

Click on any tag to see all posts with that tag.

---

## Authors

### View All Authors

Visit `/authors` to see all authors who have published posts.

### Author Profile

Click on an author to see their profile page with:
- Author name and bio
- List of their published posts

---

## Search

### Search Page

Visit `/search` to use the blog search feature.

### How Search Works

- Search looks for matching posts by title and description
- Enter keywords and press Enter or click Search
- Results show matching posts sorted by relevance

---

## RSS Feed

### Subscribe to RSS

The blog provides an RSS feed at `/rss.xml`.

### Feed Contents

The RSS feed includes:
- Latest 20 published posts
- Post title, description, and link
- Publication date
- Author name

### How to Use

1. Copy the RSS feed URL
2. Paste it into any RSS reader (Feedly, Inoreader, etc.)
3. Receive updates automatically when new posts are published

---

## Contact Form

### Send a Message

Visit `/contact` to send a message to the blog administrator.

### Required Information

- Name
- Email
- Subject
- Message

### How It Works

1. Fill out the contact form
2. Click Send
3. The message is sent to the admin email address configured in `.env`
4. You'll see a success message after sending

---

## User Account

### Registration

Visit `/auth/register` to create a new account.

### Login

Visit `/auth/login` to log into your account.

### Password Reset

If you forget your password, visit `/auth/password/forgot` to receive a reset link via email.

### Profile Management

Logged-in users can:
- Edit their profile (name, username, about)
- Change their password
- Delete their account

### Verified Email Required

After registration, you must verify your email before accessing profile features.

---

## Chatbot

The blog features an AI-powered chatbot at `/chat` that can answer questions about the blog.

### How to Use

1. Visit the `/chat` page
2. Type your question in the chat input
3. Press Enter or click Send
4. The chatbot will respond with relevant information

### Supported Questions

The chatbot understands Portuguese questions about:

**Posts:**
- "quantos posts existem?"
- "últimos 10 posts"
- "posts recentes"
- "posts do autor João"
- "posts da categoria PHP"

**Authors:**
- "quem são os autores?"
- "autores dos posts"
- "lista de autores"

**Categories:**
- "posts da categoria Laravel"
- "categorias com mais posts"

**Tags:**
- "posts com tag testing"

**Statistics:**
- "quantos posts publicados?"
- "autor com mais posts"

For a complete list, see [CHATBOT.md](CHATBOT.md).

### How the Chatbot Works

The chatbot uses two approaches:

1. **SQL Queries** - For factual questions (counts, lists, statistics)
2. **RAG (Retrieval-Augmented Generation)** - For content-based questions about blog topics

Questions are automatically routed to the appropriate method.

---

## Navigation

### Main Navigation

The top navigation menu includes:
- Home
- Categories
- Tags
- Authors
- About
- Contact
- Chat

### Breadcrumbs

Breadcrumbs appear on post and category pages to help you navigate back.

### Footer

The footer contains:
- Blog name and copyright
- RSS feed link
- Social links (if configured)

---

## Accessibility

The blog is designed with accessibility in mind:
- Semantic HTML structure
- Keyboard navigation support
- Screen reader compatible
- Proper heading hierarchy

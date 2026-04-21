# Deployment Guide

This guide covers deploying the Laravel Blog to production servers.

## Table of Contents

- [Requirements](#requirements)
- [Server Setup](#server-setup)
- [Application Deployment](#application-deployment)
- [Database Setup](#database-setup)
- [Ollama Setup](#ollama-setup)
- [Web Server Configuration](#web-server-configuration)
- [Environment Configuration](#environment-configuration)
- [Post-Deployment](#post-deployment)
- [Security](#security)
- [Maintenance](#maintenance)

---

## Requirements

### Server Requirements

- **OS**: Ubuntu 22.04 LTS / Debian 12 / CentOS 8
- **PHP**: 8.2 or higher
- **Web Server**: Nginx 1.18+ or Apache 2.4+
- **Database**: MySQL 8.0+ or MariaDB 10.5+
- **Composer**: Latest stable version
- **Node.js**: 16+ (for asset compilation)
- **RAM**: Minimum 2GB (4GB recommended)
- **Disk**: Minimum 10GB

### Optional for Chatbot

- **Ollama**: For AI chatbot features
- **GPU**: NVIDIA GPU with CUDA (for faster inference)

---

## Server Setup

### 1. Update System

```bash
sudo apt update && sudo apt upgrade -y
```

### 2. Install Required Packages

```bash
# Ubuntu/Debian
sudo apt install -y \
    nginx \
    php8.2-fpm \
    php8.2-cli \
    php8.2-mysql \
    php8.2-xml \
    php8.2-mbstring \
    php8.2-curl \
    php8.2-zip \
    php8.2-gd \
    php8.2-bcmath \
    php8.2-intl \
    php8.2-sqlite3 \
    unzip \
    git \
    curl

# For MySQL
sudo apt install -y mysql-server
```

### 3. Install Composer

```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

### 4. Install Node.js

```bash
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt install -y nodejs
```

---

## Application Deployment

### Option 1: Clone Repository

```bash
# Create directory
sudo mkdir -p /var/www/laravel-blog
sudo chown -R $USER:$USER /var/www/laravel-blog

# Clone repository
cd /var/www/laravel-blog
git clone https://github.com/albertguedes/laravel-blog.git .

# Install dependencies
composer install --no-dev --optimize-autoloader
npm install
npm run prod
```

### Option 2: Transfer via FTP/SFTP

1. Zip the application on local machine
2. Upload to server
3. Extract in `/var/www/laravel-blog`

### Set Permissions

```bash
sudo chown -R www-data:www-data /var/www/laravel-blog
sudo chmod -R 755 /var/www/laravel-blog
sudo chmod -R 775 /var/www/laravel-blog/storage
sudo chmod -R 775 /var/www/laravel-blog/bootstrap/cache
```

---

## Database Setup

### Create MySQL Database

```bash
sudo mysql
```

```sql
CREATE DATABASE laravel_blog CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'blog_user'@'localhost' IDENTIFIED BY 'your_secure_password';
GRANT ALL PRIVILEGES ON laravel_blog.* TO 'blog_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

---

## Ollama Setup (Optional)

### Install Ollama

```bash
curl -fsSL https://ollama.com/install.sh | sh
```

### Pull Models

```bash
ollama pull llama2
ollama pull nomic-embed-text
```

### Configure Ollama Service

```bash
sudo systemctl edit ollama
```

Add:
```ini
[Service]
Environment="OLLAMA_HOST=127.0.0.1:11434"
```

```bash
sudo systemctl restart ollama
```

### Test Ollama

```bash
curl http://127.0.0.1:11434/api/tags
```

---

## Web Server Configuration

### Nginx Configuration

```bash
sudo nano /etc/nginx/sites-available/laravel-blog
```

```nginx
server {
    listen 80;
    server_name your-domain.com www.your-domain.com;
    root /var/www/laravel-blog/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

    # SSL configuration (uncomment after obtaining certificates)
    # listen 443 ssl http2;
    # ssl_certificate /etc/letsencrypt/live/your-domain.com/fullchain.pem;
    # ssl_certificate_key /etc/letsencrypt/live/your-domain.com/privkey.pem;
}

# HTTPS redirect (add separate server block)
# server {
#     listen 80;
#     server_name your-domain.com www.your-domain.com;
#     return 301 https://$host$request_uri;
# }
```

### Enable Site

```bash
sudo ln -s /etc/nginx/sites-available/laravel-blog /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

### Apache Configuration

```bash
sudo nano /etc/apache2/sites-available/laravel-blog.conf
```

```apache
<VirtualHost *:80>
    ServerName your-domain.com
    DocumentRoot /var/www/laravel-blog/public

    <Directory /var/www/laravel-blog/public>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/laravel-blog-error.log
    CustomLog ${APACHE_LOG_DIR}/laravel-blog-access.log combined
</VirtualHost>
```

```bash
sudo a2enmod rewrite
sudo a2dissite 000-default
sudo a2ensite laravel-blog
sudo systemctl restart apache2
```

---

## Environment Configuration

### Create Production .env

```bash
cd /var/www/laravel-blog
cp .env.example .env
php artisan key:generate
```

### Configure .env for Production

```env
APP_NAME="Laravel Blog"
APP_ENV=production
APP_KEY=base64:YOUR_GENERATED_KEY
APP_DEBUG=false
APP_URL=https://your-domain.com

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_blog
DB_USERNAME=blog_user
DB_PASSWORD=your_secure_password

SESSION_DRIVER=file
SESSION_LIFETIME=120

CACHE_DRIVER=file
QUEUE_CONNECTION=sync

# Ollama Configuration (if using chatbot)
OLLAMA_MODEL=llama2
OLLAMA_URL=http://127.0.0.1:11434
```

### Clear and Recache

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan optimize
```

---

## Post-Deployment

### Run Migrations

```bash
php artisan migrate --force
```

### Seed Database (if needed)

```bash
php artisan db:seed --force
```

### Create Storage Link

```bash
php artisan storage:link
```

### Set Permissions

```bash
sudo chown -R www-data:www-data /var/www/laravel-blog/storage
sudo chown -R www-data:www-data /var/www/laravel-blog/bootstrap/cache
```

### Verify Installation

```bash
php artisan about
php artisan route:list
```

---

## Security

### SSL Certificate (Let's Encrypt)

```bash
sudo apt install -y certbot python3-certbot-nginx
sudo certbot --nginx -d your-domain.com -d www.your-domain.com
```

### Firewall Setup

```bash
sudo ufw allow 'Nginx Full'
sudo ufw allow 'OpenSSH'
sudo ufw enable
```

### Additional Security Steps

1. **Disable PHP exposed version**:
```bash
sudo nano /etc/php/8.2/fpm/php.ini
# expose_php = Off
```

2. **Configure Nginx headers** (already in config above)

3. **Set proper file permissions**:
```bash
find /var/www/laravel-blog -type f -exec chmod 644 {} \;
find /var/www/laravel-blog -type d -exec chmod 755 {} \;
chmod -R 775 /var/www/laravel-blog/storage
chmod -R 775 /var/www/laravel-blog/bootstrap/cache
```

---

## Maintenance

### Update Application

```bash
cd /var/www/laravel-blog
git pull origin main
composer install --no-dev --optimize-autoloader
npm install
npm run prod
php artisan migrate --force
php artisan cache:clear
php artisan config:cache
php artisan route:cache
```

### Logs

```bash
# Application logs
tail -f /var/www/laravel-blog/storage/logs/laravel.log

# Nginx logs
tail -f /var/www/laravel-blog/storage/logs/nginx-error.log

# System logs
sudo journalctl -u nginx -f
```

### Backup

```bash
# Database backup
mysqldump -u blog_user -p laravel_blog > backup_$(date +%Y%m%d).sql

# Files backup
tar -czvf laravel_blog_backup_$(date +%Y%m%d).tar.gz /var/www/laravel-blog
```

### Queue Workers (if using queue)

```bash
# Create systemd service
sudo nano /etc/systemd/system/laravel-worker.service
```

```ini
[Unit]
Description=Laravel Queue Worker
After=network.target

[Service]
User=www-data
Group=www-data
WorkingDirectory=/var/www/laravel-blog
ExecStart=/usr/bin/php /var/www/laravel-blog/artisan queue:work --sleep=3 --tries=3
Restart=always

[Install]
WantedBy=multi-user.target
```

```bash
sudo systemctl enable laravel-worker
sudo systemctl start laravel-worker
```

---

## Troubleshooting

### White Screen of Death

1. Check PHP error logs: `tail -f /var/log/php8.2-fpm.log`
2. Set `APP_DEBUG=true` temporarily
3. Check permissions

### Database Connection Failed

1. Verify MySQL is running: `sudo systemctl status mysql`
2. Check credentials in `.env`
3. Test connection: `mysql -u blog_user -p laravel_blog`

### 500 Error

1. Check Laravel logs: `tail -f storage/logs/laravel.log`
2. Run with debug: `php artisan serve`
3. Clear cache: `php artisan cache:clear`

### Ollama Not Responding

1. Check Ollama service: `sudo systemctl status ollama`
2. Test API: `curl http://127.0.0.1:11434/api/tags`
3. Restart Ollama: `sudo systemctl restart ollama`

---

## Related Documentation

- [Developer Guide](DEVELOPER-GUIDE.md) - Development setup
- [Architecture](ARCHITECTURE.md) - System architecture
- [Chatbot](CHATBOT.md) - Chatbot configuration

# 🚀 Production Deployment Guide for Google OAuth

## 📋 Pre-Deployment Checklist

### 1. Environment Configuration (.env)

```env
# Production Environment
APP_NAME="Your App Name"
APP_ENV=production
APP_KEY=base64:YOUR_PRODUCTION_KEY
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_PORT=3306
DB_DATABASE=your_production_db
DB_USERNAME=your_db_user
DB_PASSWORD=your_secure_password

# Google OAuth Configuration
GOOGLE_CLIENT_ID=your-google-client-id
GOOGLE_CLIENT_SECRET=your-google-client-secret
GOOGLE_REDIRECT_URI=https://yourdomain.com/auth/google/callback

# SSL Configuration (Enable for production)
CURL_SSL_VERIFYPEER=true

# Mail Configuration (Configure for production)
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email@domain.com
MAIL_PASSWORD=your-email-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@yourdomain.com"
MAIL_FROM_NAME="${APP_NAME}"

# Cache and Session (Consider Redis for production)
CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis

# Redis Configuration
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

### 2. Google Cloud Console Changes

#### OAuth 2.0 Client IDs Configuration:

1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Navigate to "APIs & Services" > "Credentials"
3. Edit your OAuth 2.0 Client ID
4. Update the following:

**Authorized JavaScript origins:**

-   Remove: `http://localhost:8000`
-   Add: `https://yourdomain.com`

**Authorized redirect URIs:**

-   Remove: `http://localhost:8000/auth/google/callback`
-   Add: `https://yourdomain.com/auth/google/callback`

#### OAuth Consent Screen:

1. Ensure your app is verified for production use
2. Add privacy policy and terms of service URLs
3. Configure authorized domains
4. Add app logo and description

### 3. Server Configuration

#### SSL/HTTPS Setup:

```bash
# Ensure your server has SSL certificate installed
# Configure web server (Apache/Nginx) to redirect HTTP to HTTPS
# Example Nginx configuration:
server {
    listen 80;
    server_name yourdomain.com www.yourdomain.com;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl;
    server_name yourdomain.com www.yourdomain.com;

    ssl_certificate /path/to/certificate.crt;
    ssl_certificate_key /path/to/private.key;

    # Your Laravel configuration
}
```

### 4. Laravel Production Optimization

#### Run these commands on production server:

```bash
# Install dependencies
composer install --optimize-autoloader --no-dev

# Generate application key (if not set)
php artisan key:generate

# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Run migrations
php artisan migrate --force

# Clear and cache everything
php artisan optimize
```

### 5. Security Considerations

#### Session and Cookie Configuration:

```env
# In .env for production
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=lax
```

#### CORS Configuration (if needed):

```php
// config/cors.php
'allowed_origins' => [
    'https://yourdomain.com',
],
'allowed_origins_patterns' => [],
'allowed_headers' => ['*'],
'allowed_methods' => ['*'],
'exposed_headers' => [],
'max_age' => 0,
'supports_credentials' => true,
```

### 6. Monitoring and Logging

#### Log Configuration:

```env
# Production logging
LOG_CHANNEL=stack
LOG_LEVEL=error
LOG_SLACK_WEBHOOK_URL=your-slack-webhook
```

#### Error Tracking:

Consider integrating error tracking services like:

-   Sentry
-   Bugsnag
-   Rollbar

### 7. Performance Optimization

#### Caching Strategy:

```bash
# Enable OPcache in PHP
# Configure Redis for session and cache
# Use CDN for static assets
# Enable Gzip compression
```

#### Database Optimization:

```bash
# Run database optimizations
php artisan db:seed --class=ProductionSeeder
# Ensure proper indexing
# Configure database connection pooling
```

## 🔍 Testing Checklist

Before going live, test:

-   [ ] Google OAuth login flow works
-   [ ] Account linking functionality
-   [ ] New user registration via Google
-   [ ] Existing user login via Google
-   [ ] SSL certificate is properly configured
-   [ ] All HTTP traffic redirects to HTTPS
-   [ ] Error pages are properly configured
-   [ ] Performance is acceptable
-   [ ] Database connections are secure
-   [ ] Email notifications work

## 🚨 Common Production Issues

### Issue 1: "invalid_client" Error

**Solution:** Verify Google Cloud Console redirect URI matches exactly

### Issue 2: SSL Certificate Issues

**Solution:** Ensure valid SSL certificate and proper server configuration

### Issue 3: Session Issues

**Solution:** Configure proper session driver and ensure session storage is persistent

### Issue 4: Performance Issues

**Solution:** Enable caching, optimize database queries, use CDN

## 📞 Support

If you encounter issues:

1. Check Laravel logs: `storage/logs/laravel.log`
2. Check web server error logs
3. Verify Google Cloud Console configuration
4. Test OAuth flow in incognito mode
5. Check SSL certificate validity

---

**Remember:** Always test in a staging environment before deploying to production!

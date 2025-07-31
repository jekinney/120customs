# 🔥 120 Customs - Laravel Forge Deployment Guide

Laravel Forge is the premium choice for Laravel deployments, offering automated server management, zero-downtime deployments, and seamless integration with your Laravel application.

## 🚀 Why Choose Forge?

- **Laravel-optimized**: Built specifically for Laravel applications
- **Zero-downtime deployments**: Seamless updates without service interruption
- **Automated server management**: Handles server configuration, SSL, and maintenance
- **Multiple server providers**: DigitalOcean, AWS, Linode, Vultr, and more
- **Built-in monitoring**: Server metrics, logs, and alerts
- **Easy scaling**: Add servers and load balancers with clicks

## 💰 Pricing

- **Forge subscription**: $19/month (unlimited servers and sites)
- **Server costs**: Varies by provider (typically $12-50/month per server)
- **Total estimated cost**: $31-69/month for a production setup

## 📋 Prerequisites

1. **Laravel Forge account** - Sign up at [forge.laravel.com](https://forge.laravel.com)
2. **Server provider account** - DigitalOcean, AWS, Linode, or Vultr
3. **Domain name** - Purchased and ready to configure
4. **Git repository** - Your code pushed to GitHub, GitLab, or Bitbucket
5. **Database** - Can be on the same server or separate managed database

## 🛠️ Step-by-Step Deployment

### Step 1: Create a Server

1. **Login to Laravel Forge**
   - Go to [forge.laravel.com](https://forge.laravel.com)
   - Sign in with your account

2. **Create New Server**
   - Click "Create Server"
   - Choose your provider (DigitalOcean recommended)
   - Connect your provider account (API token required)

3. **Server Configuration**
   ```
   Server Name: 120customs-production
   Provider: DigitalOcean
   Region: Choose closest to your users (e.g., NYC1, SFO3)
   Size: $12/month (Basic) or $24/month (Professional)
   PHP Version: 8.2
   Database: MySQL 8.0 (if hosting database on same server)
   ```

4. **Additional Services** (recommended)
   - ✅ Install Redis (for caching and sessions)
   - ✅ Install Node.js (for asset compilation)
   - ✅ Enable UFW Firewall
   - ✅ Install Supervisor (for queue workers)

5. **Create Server**
   - Click "Create Server"
   - Wait 5-10 minutes for provisioning

### Step 2: Create a Site

1. **Add New Site**
   - Click "Sites" → "New Site"
   - Domain: `120customs.com` (or your domain)
   - Project Type: "General PHP / Laravel"
   - Web Directory: `/public` (Laravel default)

2. **Repository Setup**
   - Provider: GitHub (or your Git provider)
   - Repository: `jekinney/120customs`
   - Branch: `main`
   - ✅ Install Composer Dependencies
   - ✅ Install NPM Dependencies

### Step 3: Environment Configuration

1. **Edit Environment File**
   - Go to Site → "Environment"
   - Replace default content with production configuration:

```bash
APP_NAME="120 Customs"
APP_ENV=production
APP_KEY=base64:your-generated-key-here
APP_DEBUG=false
APP_TIMEZONE=UTC
APP_URL=https://120customs.com

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=120customs
DB_USERNAME=forge
DB_PASSWORD=your-database-password

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=redis

# Redis Configuration
CACHE_STORE=redis
CACHE_PREFIX=120customs_cache
SESSION_DRIVER=redis
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=.120customs.com

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

# Mail Configuration
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email@120customs.com
MAIL_PASSWORD=your-email-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@120customs.com"
MAIL_FROM_NAME="120 Customs"

# Image Upload Settings
MAX_UPLOAD_SIZE=5120
IMAGE_QUALITY=85

# Admin Settings
ADMIN_EMAIL=admin@120customs.com
ADMIN_NAME="120 Customs Admin"

VITE_APP_NAME="${APP_NAME}"
```

### Step 4: Database Setup

#### Option A: Database on Same Server
1. **Create Database**
   - Go to Server → "Database"
   - Click "Create Database"
   - Database Name: `120customs`
   - User: `forge` (default)

#### Option B: Managed Database (Recommended for Production)
1. **Create Managed Database**
   - Use DigitalOcean Managed Database
   - MySQL 8.0, Basic plan ($15/month)
   - Update environment variables with connection details

### Step 5: SSL Certificate

1. **Enable SSL**
   - Go to Site → "SSL"
   - Choose "LetsEncrypt" (free)
   - Domain: `120customs.com,www.120customs.com`
   - Click "Obtain Certificate"

2. **Force HTTPS**
   - ✅ Enable "Force HTTPS" after certificate is active

### Step 6: Deployment Script

1. **Customize Deploy Script**
   - Go to Site → "Deployment Script"
   - Replace with optimized script:

```bash
cd /home/forge/120customs.com

# Pull latest changes
git pull origin $FORGE_SITE_BRANCH

# Install/update Composer dependencies
$FORGE_COMPOSER install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Clear and rebuild cache
$FORGE_PHP artisan config:clear
$FORGE_PHP artisan config:cache

# Clear and rebuild routes
$FORGE_PHP artisan route:clear
$FORGE_PHP artisan route:cache

# Clear and rebuild views
$FORGE_PHP artisan view:clear
$FORGE_PHP artisan view:cache

# Clear application cache
$FORGE_PHP artisan cache:clear

# Run database migrations (if needed)
$FORGE_PHP artisan migrate --force

# Restart queues (if using)
$FORGE_PHP artisan queue:restart

# Create storage link if not exists
$FORGE_PHP artisan storage:link

# Build assets (if package.json exists)
if [ -f package.json ]; then
    npm ci
    npm run build
fi

# Reload PHP-FPM to ensure latest code is loaded
( flock -w 10 9 || exit 1
    echo 'Restarting FPM...'; sudo -S service $FORGE_PHP_FPM reload ) 9>/tmp/fpmlock
```

### Step 7: Queue Workers (Optional but Recommended)

1. **Create Queue Worker**
   - Go to Server → "Daemons"
   - Click "Create Daemon"
   - Command: `php8.2 /home/forge/120customs.com/artisan queue:work redis --sleep=3 --tries=3 --max-time=3600`
   - User: `forge`
   - Directory: `/home/forge/120customs.com`
   - Processes: `1`

### Step 8: Scheduled Jobs (Cron)

1. **Enable Scheduler**
   - Go to Server → "Scheduler"
   - Click "Create Scheduled Job"
   - Command: `php8.2 /home/forge/120customs.com/artisan schedule:run`
   - User: `forge`
   - Frequency: `Every Minute`

### Step 9: Initial Deployment

1. **Deploy Site**
   - Go to Site → "Deployment"
   - Click "Deploy Now"
   - Monitor deployment logs for any issues

2. **Post-Deployment Setup**
   - SSH into server or use Forge terminal
   - Run database setup:
   ```bash
   cd /home/forge/120customs.com
   php artisan migrate --force
   php artisan db:seed --force
   ```

## 🔧 Forge-Specific Optimizations

### PHP Configuration
Forge automatically optimizes PHP for Laravel, but you can fine-tune:

1. **Edit PHP Configuration**
   - Go to Server → "PHP"
   - Increase memory limit: `memory_limit = 256M`
   - Increase upload limits: `upload_max_filesize = 5M` and `post_max_size = 6M`
   - Enable OPcache optimizations

### Nginx Configuration
Default Forge Nginx config is optimized, but for image-heavy sites:

```nginx
# Add to Site → "Files" → "Edit Nginx Configuration"
location ~* \.(jpg|jpeg|png|gif|ico|css|js)$ {
    expires 1y;
    add_header Cache-Control "public, immutable";
}

client_max_body_size 5M;
```

## 📊 Monitoring and Maintenance

### Server Monitoring
- **Forge Metrics**: Built-in server monitoring
- **Uptime Monitoring**: Configure alerts for downtime
- **Log Monitoring**: Real-time log viewing and alerts

### Automated Backups
1. **Database Backups**
   - Go to Server → "Backup"
   - Enable daily backups
   - Store in cloud storage (S3, DigitalOcean Spaces)

2. **File Backups**
   - Set up automated file backups for uploaded images
   - Use cloud storage for redundancy

## 🚀 Advanced Features

### Load Balancing
For high-traffic scenarios:
1. Create multiple app servers
2. Set up Forge load balancer
3. Use shared database and Redis
4. Configure session affinity

### Multiple Environments
- **Staging**: Create separate server for testing
- **Development**: Use separate branch deployment
- **Hot-fixes**: Quick deployment workflow

## 🔍 Troubleshooting

### Common Issues

**Deployment Fails**
- Check deployment logs in Forge
- Verify Git repository access
- Check Composer dependencies

**Database Connection Issues**
- Verify credentials in environment file
- Check firewall rules
- Test connection from server

**File Upload Issues**
- Check PHP upload limits
- Verify storage directory permissions
- Test with small files first

**Performance Issues**
- Enable OPcache
- Configure Redis caching
- Optimize database queries
- Use CDN for assets

## 💡 Pro Tips

1. **Use Branch Deployments**: Deploy from `main` for production, `develop` for staging
2. **Enable Quick Deploy**: Automatic deployments on Git push
3. **Monitor Resource Usage**: Scale up server when needed
4. **Regular Backups**: Never skip database backups
5. **SSL Renewal**: Forge handles automatic renewal
6. **Security Updates**: Enable automatic security updates

## 📞 Default Admin Access

After deployment:
- URL: `https://120customs.com/admin`
- Email: `admin@120customs.com`
- Password: `admin123!`
- **⚠️ Change immediately after first login!**

## 💰 Total Cost Breakdown

**Laravel Forge**: $19/month
**DigitalOcean Droplet**: $12-24/month (Basic) or $48/month (Professional)
**Managed Database** (optional): $15/month
**Managed Redis** (optional): $15/month
**Domain**: $10-15/year
**SSL**: Free (Let's Encrypt)

**Total**: $31-46/month (basic) or $97/month (fully managed)

---

## 🎉 You're Live!

Your 120 Customs application is now deployed with Laravel Forge! You get:

- ✅ Automated deployments
- ✅ SSL certificates
- ✅ Server monitoring
- ✅ Zero-downtime updates
- ✅ Professional hosting
- ✅ Laravel-optimized environment

**Forge makes Laravel deployment effortless! 🔥**

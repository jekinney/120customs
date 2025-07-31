# 120 Customs - Digital Ocean Deployment Guide

This guide will help you deploy the 120 Customs vehicle showcase application to Digital Ocean.

## 🚀 Quick Start

### Option 1: Digital Ocean App Platform (Recommended)
1. Push your code to GitHub/GitLab
2. Create a new app in Digital Ocean App Platform
3. Connect your repository
4. Use the provided `.do/app.yaml` configuration
5. Set environment variables
6. Deploy!

### Option 2: Docker Deployment
```bash
# Windows
.\deploy.ps1

# Linux/Mac
chmod +x deploy.sh
./deploy.sh

# Build and run
docker build -t 120customs .
docker run -p 80:80 120customs
```

## 📋 Pre-Deployment Checklist

### 1. Environment Configuration
- [ ] Copy `.env.production` to `.env`
- [ ] Set `APP_KEY` (run `php artisan key:generate`)
- [ ] Configure database credentials
- [ ] Set `APP_URL` to your domain
- [ ] Configure mail settings
- [ ] Set secure Redis password

### 2. Database Setup
- [ ] Create MySQL 8.0 database
- [ ] Create database user with proper permissions
- [ ] Run migrations: `php artisan migrate --force`
- [ ] Set up database backups

### 3. File Storage
- [ ] Ensure `storage/` directories exist
- [ ] Set proper permissions (755 for directories, 644 for files)
- [ ] Create storage symlink: `php artisan storage:link`
- [ ] Configure file upload limits (5MB in php.ini)

### 4. Security
- [ ] Set `APP_DEBUG=false`
- [ ] Configure SSL certificate
- [ ] Set secure session configuration
- [ ] Enable security headers
- [ ] Configure firewall rules

## 🔧 Digital Ocean App Platform Setup

### 1. Create New App
1. Go to Digital Ocean Control Panel
2. Click "Create" → "Apps"
3. Connect your Git repository
4. Select branch: `main`

### 2. Environment Variables
Set these in the App Platform dashboard:

**Required:**
```
APP_NAME=120 Customs
APP_ENV=production
APP_DEBUG=false
APP_KEY=[generate with php artisan key:generate]
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=[provided by Digital Ocean]
DB_PORT=25060
DB_DATABASE=[your database name]
DB_USERNAME=[your database user]
DB_PASSWORD=[your database password]

CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
REDIS_HOST=[provided by Digital Ocean]
REDIS_PORT=25061
REDIS_PASSWORD=[provided by Digital Ocean]
```

**Optional:**
```
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-password
MAIL_FROM_ADDRESS=noreply@your-domain.com
```

### 3. Database Configuration
1. Create a MySQL 8.0 database in Digital Ocean
2. Note the connection details
3. Add connection details to environment variables

### 4. Redis Configuration
1. Create a Redis database in Digital Ocean
2. Note the connection details
3. Add connection details to environment variables

## 📁 File Structure
```
120customs/
├── .do/
│   └── app.yaml              # Digital Ocean App Platform config
├── docker/
│   ├── apache/
│   │   └── 000-default.conf  # Apache virtual host config
│   └── supervisor/
│       └── supervisord.conf  # Process management
├── config/
│   └── production-php.ini    # Production PHP settings
├── Dockerfile                # Docker container definition
├── docker-compose.yml        # Local Docker development
├── deploy.sh                 # Linux/Mac deployment script
├── deploy.ps1                # Windows deployment script
├── setup-database.php        # Database setup script
└── .env.production           # Production environment template
```

## 🗄️ Database Setup

After deployment, run the database setup:

```bash
# SSH into your server or use Digital Ocean console
php setup-database.php
```

This will:
- Run database migrations
- Create default admin user
- Set up storage directories
- Optimize the application

**Default Admin Credentials:**
- Email: `admin@120customs.com`
- Password: `admin123!`
- **⚠️ Change this immediately after first login!**

## 🔍 Post-Deployment Verification

### 1. Health Checks
- [ ] Website loads at your domain
- [ ] Admin panel accessible at `/admin`
- [ ] Database connection working
- [ ] File uploads working
- [ ] Images displaying correctly
- [ ] SSL certificate active

### 2. Performance Tests
- [ ] Page load times < 3 seconds
- [ ] Image optimization working
- [ ] Caching enabled
- [ ] Database queries optimized

### 3. Security Tests
- [ ] HTTPS redirect working
- [ ] Security headers present
- [ ] Admin area protected
- [ ] File upload restrictions working

## 🛠️ Maintenance

### Regular Tasks
- Monitor application logs
- Update dependencies monthly
- Database backups daily
- Security patches as needed
- Performance monitoring

### Scaling
- Increase droplet size for more traffic
- Add Redis caching for better performance
- Use CDN for static assets
- Consider load balancer for high traffic

## 🆘 Troubleshooting

### Common Issues

**Database Connection Failed**
- Check environment variables
- Verify database credentials
- Ensure database server is running

**File Upload Issues**
- Check php.ini upload limits
- Verify storage permissions
- Check disk space

**Images Not Displaying**
- Run `php artisan storage:link`
- Check file permissions
- Verify image processing libraries installed

**Performance Issues**
- Enable OPcache
- Configure Redis caching
- Optimize database queries
- Use CDN for assets

### Log Files
- Application: `storage/logs/laravel.log`
- Web server: `/var/log/apache2/error.log`
- System: `/var/log/syslog`

## 📞 Support

For deployment issues:
1. Check the logs first
2. Verify all environment variables
3. Test database connectivity
4. Check file permissions

## 🔐 Security Best Practices

1. **Change default credentials immediately**
2. **Keep dependencies updated**
3. **Use strong passwords**
4. **Enable firewall**
5. **Regular security audits**
6. **Monitor access logs**
7. **Use HTTPS everywhere**
8. **Backup regularly**

---

**🎉 Congratulations! Your 120 Customs application should now be running on Digital Ocean.**

Remember to:
- Change the default admin password
- Set up regular backups
- Monitor application performance
- Keep the application updated

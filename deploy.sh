#!/bin/bash

# 120 Customs Digital Ocean Deployment Script
# This script prepares the application for deployment

set -e

echo "🚀 Starting deployment preparation for 120 Customs..."

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${GREEN}[INFO]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Check if we're in the right directory
if [ ! -f "artisan" ]; then
    print_error "This script must be run from the Laravel project root directory"
    exit 1
fi

print_status "Checking environment..."

# Check if required files exist
REQUIRED_FILES=(".env.production" "Dockerfile" "docker-compose.yml")
for file in "${REQUIRED_FILES[@]}"; do
    if [ ! -f "$file" ]; then
        print_error "Required file $file not found"
        exit 1
    fi
done

print_status "Installing/updating dependencies..."

# Install PHP dependencies
composer install --no-dev --optimize-autoloader --no-interaction

# Install Node dependencies and build assets
if [ -f "package.json" ]; then
    print_status "Building frontend assets..."
    npm ci
    npm run build
fi

print_status "Optimizing Laravel application..."

# Copy production environment file
cp .env.production .env

# Generate application key if not exists
if ! grep -q "APP_KEY=base64:" .env; then
    print_status "Generating application key..."
    php artisan key:generate --force
fi

# Clear and cache configuration
php artisan config:clear
php artisan config:cache

# Clear and cache routes
php artisan route:clear
php artisan route:cache

# Clear and cache views
php artisan view:clear
php artisan view:cache

# Clear application cache
php artisan cache:clear

# Optimize autoloader
composer dump-autoload --optimize

print_status "Setting up storage directories..."

# Create storage directories
mkdir -p storage/app/public/vehicles/gallery
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs

# Set permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache

print_status "Creating symbolic link for storage..."
php artisan storage:link

print_status "Preparing Docker build..."

# Create .dockerignore if it doesn't exist
if [ ! -f ".dockerignore" ]; then
    cat > .dockerignore << EOF
.git
.env
.env.local
.env.example
node_modules
tests
.phpunit.result.cache
docker-compose.yml
README.md
.gitignore
storage/logs/*
!storage/logs/.gitkeep
EOF
fi

print_status "Running security checks..."

# Check for sensitive files
SENSITIVE_FILES=(".env.local" ".env.example" "database/database.sqlite")
for file in "${SENSITIVE_FILES[@]}"; do
    if [ -f "$file" ]; then
        print_warning "Consider removing $file before deployment"
    fi
done

print_status "Creating deployment archive..."

# Create deployment directory
mkdir -p deployment

# Create tar archive excluding development files
tar -czf deployment/120customs-$(date +%Y%m%d-%H%M%S).tar.gz \
    --exclude='.git' \
    --exclude='node_modules' \
    --exclude='tests' \
    --exclude='.env.local' \
    --exclude='storage/logs/*' \
    --exclude='deployment' \
    .

print_status "Deployment preparation complete!"
echo ""
print_status "Next steps:"
echo "1. Push your code to your Git repository"
echo "2. Set up your Digital Ocean App Platform project"
echo "3. Configure environment variables in Digital Ocean"
echo "4. Deploy using Digital Ocean App Platform or Docker"
echo ""
print_status "For Docker deployment:"
echo "docker build -t 120customs ."
echo "docker run -p 80:80 120customs"
echo ""
print_status "For Digital Ocean App Platform:"
echo "Use the .do/app.yaml configuration file"
echo ""
print_warning "Remember to:"
echo "- Set up SSL certificate"
echo "- Configure DNS records"
echo "- Set up database backups"
echo "- Configure monitoring"
echo "- Set up log aggregation"

# Restore local environment
if [ -f ".env.local" ]; then
    cp .env.local .env
    print_status "Restored local environment file"
fi

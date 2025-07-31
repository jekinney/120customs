# 120 Customs Digital Ocean Deployment Script (PowerShell)
# This script prepares the application for deployment on Windows

param(
    [switch]$SkipBuild,
    [switch]$SkipTests,
    [string]$Environment = "production"
)

Write-Host "🚀 Starting deployment preparation for 120 Customs..." -ForegroundColor Green

function Write-Status {
    param([string]$Message)
    Write-Host "[INFO] $Message" -ForegroundColor Green
}

function Write-Warning {
    param([string]$Message)
    Write-Host "[WARNING] $Message" -ForegroundColor Yellow
}

function Write-Error {
    param([string]$Message)
    Write-Host "[ERROR] $Message" -ForegroundColor Red
}

# Check if we're in the right directory
if (-not (Test-Path "artisan")) {
    Write-Error "This script must be run from the Laravel project root directory"
    exit 1
}

Write-Status "Checking environment..."

# Check if required files exist
$RequiredFiles = @(".env.production", "Dockerfile", "docker-compose.yml")
foreach ($file in $RequiredFiles) {
    if (-not (Test-Path $file)) {
        Write-Error "Required file $file not found"
        exit 1
    }
}

Write-Status "Installing/updating dependencies..."

# Install PHP dependencies
& composer install --no-dev --optimize-autoloader --no-interaction
if ($LASTEXITCODE -ne 0) {
    Write-Error "Composer install failed"
    exit 1
}

# Install Node dependencies and build assets
if (-not $SkipBuild -and (Test-Path "package.json")) {
    Write-Status "Building frontend assets..."
    & npm ci
    if ($LASTEXITCODE -ne 0) {
        Write-Error "npm ci failed"
        exit 1
    }
    
    & npm run build
    if ($LASTEXITCODE -ne 0) {
        Write-Error "npm build failed"
        exit 1
    }
}

Write-Status "Optimizing Laravel application..."

# Backup current .env file
if (Test-Path ".env") {
    Copy-Item ".env" ".env.backup" -Force
}

# Copy production environment file
Copy-Item ".env.production" ".env" -Force

# Generate application key if not exists
$envContent = Get-Content ".env" -Raw
if ($envContent -notmatch "APP_KEY=base64:") {
    Write-Status "Generating application key..."
    & php artisan key:generate --force
}

# Clear and cache configuration
& php artisan config:clear
& php artisan config:cache

# Clear and cache routes
& php artisan route:clear
& php artisan route:cache

# Clear and cache views
& php artisan view:clear
& php artisan view:cache

# Clear application cache
& php artisan cache:clear

# Optimize autoloader
& composer dump-autoload --optimize

Write-Status "Setting up storage directories..."

# Create storage directories
$StorageDirs = @(
    "storage/app/public/vehicles/gallery",
    "storage/framework/cache",
    "storage/framework/sessions", 
    "storage/framework/views",
    "storage/logs"
)

foreach ($dir in $StorageDirs) {
    if (-not (Test-Path $dir)) {
        New-Item -ItemType Directory -Path $dir -Force | Out-Null
    }
}

Write-Status "Creating symbolic link for storage..."
& php artisan storage:link

Write-Status "Preparing Docker build..."

# Create .dockerignore if it doesn't exist
if (-not (Test-Path ".dockerignore")) {
    $dockerignoreContent = @"
.git
.env
.env.local
.env.example
.env.backup
node_modules
tests
.phpunit.result.cache
docker-compose.yml
README.md
.gitignore
storage/logs/*
!storage/logs/.gitkeep
deployment
*.log
"@
    Set-Content -Path ".dockerignore" -Value $dockerignoreContent
}

Write-Status "Running security checks..."

# Check for sensitive files
$SensitiveFiles = @(".env.local", ".env.example", "database/database.sqlite")
foreach ($file in $SensitiveFiles) {
    if (Test-Path $file) {
        Write-Warning "Consider removing $file before deployment"
    }
}

Write-Status "Creating deployment package..."

# Create deployment directory
if (-not (Test-Path "deployment")) {
    New-Item -ItemType Directory -Path "deployment" | Out-Null
}

# Get current timestamp
$timestamp = Get-Date -Format "yyyyMMdd-HHmmss"
$archiveName = "120customs-$timestamp.zip"

# Create ZIP archive excluding development files
$excludePatterns = @(
    ".git*",
    "node_modules*",
    "tests*",
    ".env.local",
    ".env.backup", 
    "storage/logs/*.log",
    "deployment*",
    "*.log"
)

# Create temporary directory for clean files
$tempDir = "temp-deployment"
if (Test-Path $tempDir) {
    Remove-Item $tempDir -Recurse -Force
}

# Copy files excluding patterns
Write-Status "Copying files for deployment package..."
robocopy . $tempDir /E /XD .git node_modules tests deployment /XF .env.local .env.backup *.log > $null

# Create ZIP from clean directory
Add-Type -AssemblyName System.IO.Compression.FileSystem
[System.IO.Compression.ZipFile]::CreateFromDirectory("$PWD\$tempDir", "$PWD\deployment\$archiveName")

# Clean up temp directory
Remove-Item $tempDir -Recurse -Force

Write-Status "Deployment preparation complete!"
Write-Host ""
Write-Status "Package created: deployment/$archiveName"
Write-Host ""
Write-Status "Next steps:"
Write-Host "1. Push your code to your Git repository"
Write-Host "2. Set up your Digital Ocean App Platform project"
Write-Host "3. Configure environment variables in Digital Ocean"
Write-Host "4. Deploy using Digital Ocean App Platform or Docker"
Write-Host ""
Write-Status "For Docker deployment:"
Write-Host "docker build -t 120customs ."
Write-Host "docker run -p 80:80 120customs"
Write-Host ""
Write-Status "For Digital Ocean App Platform:"
Write-Host "Use the .do/app.yaml configuration file"
Write-Host ""
Write-Warning "Remember to:"
Write-Host "- Set up SSL certificate"
Write-Host "- Configure DNS records" 
Write-Host "- Set up database backups"
Write-Host "- Configure monitoring"
Write-Host "- Set up log aggregation"

# Restore local environment
if (Test-Path ".env.backup") {
    Copy-Item ".env.backup" ".env" -Force
    Remove-Item ".env.backup" -Force
    Write-Status "Restored local environment file"
}

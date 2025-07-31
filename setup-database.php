<?php

// Database Migration and Seeding Script for Production
// Run this after deployment to ensure database is properly set up

if (php_sapi_name() !== 'cli') {
    die('This script can only be run from the command line.');
}

echo "🗄️  120 Customs Database Setup\n";
echo "===============================\n\n";

// Check if we're in the right directory
if (!file_exists('artisan')) {
    echo "❌ Error: This script must be run from the Laravel project root directory\n";
    exit(1);
}

// Check database connection
echo "🔍 Checking database connection...\n";
try {
    $output = shell_exec('php artisan migrate:status 2>&1');
    if (strpos($output, 'could not find driver') !== false) {
        echo "❌ Error: Database driver not found. Please install required PHP extensions.\n";
        exit(1);
    }
    if (strpos($output, 'Connection refused') !== false) {
        echo "❌ Error: Cannot connect to database. Please check your database configuration.\n";
        exit(1);
    }
    echo "✅ Database connection successful\n\n";
} catch (Exception $e) {
    echo "❌ Error checking database: " . $e->getMessage() . "\n";
    exit(1);
}

// Run migrations
echo "🚀 Running database migrations...\n";
$output = shell_exec('php artisan migrate --force 2>&1');
echo $output . "\n";

// Check if we need to create admin user
echo "👤 Checking for admin user...\n";
$userCount = (int) shell_exec('php artisan tinker --execute="echo App\\Models\\User::count();" 2>/dev/null');

if ($userCount === 0) {
    echo "Creating default admin user...\n";
    
    // Create admin user
    $createUserScript = '
    $user = App\\Models\\User::create([
        "name" => "Admin",
        "email" => "admin@120customs.com", 
        "password" => bcrypt("admin123!"),
        "email_verified_at" => now(),
        "is_admin" => true
    ]);
    echo "Admin user created with email: " . $user->email;
    ';
    
    $output = shell_exec('php artisan tinker --execute="' . addslashes($createUserScript) . '" 2>&1');
    echo $output . "\n";
    echo "⚠️  Please change the admin password after first login!\n\n";
} else {
    echo "✅ Admin user already exists\n\n";
}

// Create sample data if needed
echo "📋 Checking for sample data...\n";
$vehicleCount = (int) shell_exec('php artisan tinker --execute="echo App\\Models\\Vehicles\\Vehicle::count();" 2>/dev/null');

if ($vehicleCount === 0) {
    echo "Would you like to create sample vehicle data? (y/n): ";
    $handle = fopen("php://stdin", "r");
    $line = fgets($handle);
    fclose($handle);
    
    if (trim($line) === 'y' || trim($line) === 'Y') {
        echo "Creating sample vehicle data...\n";
        $output = shell_exec('php artisan db:seed --class=DatabaseSeeder --force 2>&1');
        echo $output . "\n";
    }
} else {
    echo "✅ Vehicle data already exists ($vehicleCount vehicles)\n\n";
}

// Clear and cache everything
echo "🧹 Optimizing application...\n";
shell_exec('php artisan config:cache 2>&1');
shell_exec('php artisan route:cache 2>&1');
shell_exec('php artisan view:cache 2>&1');
echo "✅ Application optimized\n\n";

// Create storage link
echo "🔗 Creating storage link...\n";
$output = shell_exec('php artisan storage:link 2>&1');
if (strpos($output, 'already exists') !== false || strpos($output, 'created') !== false) {
    echo "✅ Storage link ready\n\n";
} else {
    echo "⚠️  Storage link issue: $output\n\n";
}

echo "🎉 Database setup complete!\n";
echo "===============================\n";
echo "Next steps:\n";
echo "1. Login to admin at: /admin\n";
echo "2. Change default admin password\n";
echo "3. Add your vehicle brands and types\n";
echo "4. Upload vehicle images\n";
echo "5. Configure site settings\n\n";
echo "Default admin credentials:\n";
echo "Email: admin@120customs.com\n";
echo "Password: admin123!\n";
echo "⚠️  CHANGE THIS PASSWORD IMMEDIATELY!\n";

<?php

require 'vendor/autoload.php';

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

echo "Testing Intervention Image classes..." . PHP_EOL;

try {
    $manager = new ImageManager(new Driver());
    echo "ImageManager created successfully!" . PHP_EOL;
    
    // Test if we can read a basic image
    if (file_exists('public/favicon.ico')) {
        $image = $manager->read('public/favicon.ico');
        echo "Image loaded successfully: " . $image->width() . "x" . $image->height() . PHP_EOL;
    }
    
    echo "Intervention Image is working properly!" . PHP_EOL;
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}

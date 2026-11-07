<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Property\PropertyFloorPlanImage;
use App\Models\Property\Property;

try {
    echo "Checking PropertyFloorPlanImage model...\n";
    
    // Get count of floor plan images
    $count = PropertyFloorPlanImage::count();
    echo "Total floor plan images: " . $count . "\n\n";
    
    // Get recent floor plan images
    $recentImages = PropertyFloorPlanImage::latest()->limit(5)->get();
    echo "Recent floor plan images:\n";
    foreach ($recentImages as $image) {
        echo "ID: " . $image->id . ", Property ID: " . $image->property_id . ", Image: " . $image->image . "\n";
    }
    
    echo "\n";
    
    // Check if there are any floor plan images without property_id
    $orphanedImages = PropertyFloorPlanImage::whereNull('property_id')->count();
    echo "Orphaned floor plan images (no property_id): " . $orphanedImages . "\n";
    
    // Assign orphaned floor plan images to the most recent property (admin or vendor)
    $property = Property::latest()->first();
    if ($property) {
        $affected = PropertyFloorPlanImage::whereNull('property_id')->update(['property_id' => $property->id]);
        echo "\nAssigned $affected orphaned images to property ID: {$property->id}\n";
    } else {
        echo "\nNo property found to assign orphaned images.\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

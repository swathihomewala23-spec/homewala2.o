<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$properties = \App\Models\Property\Property::with('sliderImages')->where('status', 1)->take(5)->get();
foreach($properties as $property) {
    if($property->sliderImages->first()) {
        echo "Property ID: " . $property->id . "\n";
        echo "Slider Image: " . $property->sliderImages->first()->image . "\n";
    } else {
        echo "Property ID: " . $property->id . " has no slider images.\n";
    }
}

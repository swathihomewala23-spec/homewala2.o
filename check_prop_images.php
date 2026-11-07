<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$properties = \App\Models\Property\Property::with('sliderImages')->whereIn('property_name', ['Vista', "Meera's LandMark"])->get();
foreach($properties as $property) {
    if($property->sliderImages->first()) {
        echo "Property Name: " . $property->property_name . "\n";
        echo "Slider Image: " . $property->sliderImages->first()->image . "\n";
    } else {
        echo "Property Name: " . $property->property_name . " has no slider images.\n";
    }
}

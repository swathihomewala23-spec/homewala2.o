<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$property = \App\Models\Property\Property::with('sliderImages')->where('status', 1)->first();
echo asset('storage/slider_images/' . $property->sliderImages->first()->image);

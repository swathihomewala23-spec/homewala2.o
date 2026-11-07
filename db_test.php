<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Just echo all logos in the DB
$settings = App\Models\BasicSettings\Basic::get();
foreach ($settings as $s) {
    echo "Logo is: " . $s->logo . "\n";
}

<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$vendors = App\Models\Vendor::select('id', 'name', 'first_name', 'last_name', 'photo')->get();
foreach($vendors as $v) {
    echo "ID: " . $v->id . " Name: " . $v->first_name . " " . $v->last_name . " Photo: " . $v->photo . "\n";
}

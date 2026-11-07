<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$vendors = App\Models\Vendor::select('id', 'first_name', 'last_name', 'photo')->get();
file_put_contents('vendors_output.txt', json_encode($vendors, JSON_PRETTY_PRINT));

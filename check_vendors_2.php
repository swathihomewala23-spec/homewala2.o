<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$vendor = App\Models\Vendor::where('photo', '66693a4661a9f.png')->first();
file_put_contents('vendors_output_2.txt', json_encode($vendor, JSON_PRETTY_PRINT));

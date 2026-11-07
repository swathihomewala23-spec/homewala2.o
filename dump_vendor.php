<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$vendor = App\Models\Vendor::where('id', 208)->first();
file_put_contents('dump_vendor.txt', json_encode($vendor, JSON_PRETTY_PRINT));

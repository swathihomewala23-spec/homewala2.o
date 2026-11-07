<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

DB::table('banners')->update(['file_path' => 'home_banners/banner_67c63b7e77c9f.jpg']);
echo "Updated file_path to home_banners/banner_67c63b7e77c9f.jpg\n";

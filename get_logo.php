<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$logo = App\Models\BasicSettings\Basic::first()->logo;
file_put_contents('logo_output.txt', $logo);

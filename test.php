<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$propertiesColumns = \Schema::getColumnListing('properties');
print_r($propertiesColumns);

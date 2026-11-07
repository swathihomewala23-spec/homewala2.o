<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::create(
        '/api/get-filtered-listview-properties',
        'POST',
        ['paginate'=>1, 'per_page'=>4, 'top_pick'=>'Best Deals']
    )
);
echo substr($response->getContent(), 0, 1000);

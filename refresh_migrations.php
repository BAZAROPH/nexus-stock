<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

echo "Disabling Foreign Key Constraints...\n";
Schema::disableForeignKeyConstraints();

echo "Refreshing Workers Migration...\n";
Artisan::call('migrate:refresh', ['--path' => 'database/migrations/2025_12_05_171408_create_workers_table.php']);
echo Artisan::output();

echo "Refreshing Sites Migration...\n";
Artisan::call('migrate:refresh', ['--path' => 'database/migrations/2025_12_05_171221_create_sites_table.php']);
echo Artisan::output();

echo "Enabling Foreign Key Constraints...\n";
Schema::enableForeignKeyConstraints();

echo "Done.\n";

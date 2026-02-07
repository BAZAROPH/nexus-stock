<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

echo "Disabling Foreign Key Constraints...\n";
Schema::disableForeignKeyConstraints();

echo "Refreshing WorkerTypes Migration...\n";
Artisan::call('migrate:refresh', ['--path' => 'database/migrations/2025_12_05_171403_create_worker_types_table.php']);
echo Artisan::output();

echo "Enabling Foreign Key Constraints...\n";
Schema::enableForeignKeyConstraints();

echo "Done.\n";

<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Schema;

echo "Tables:\n";
foreach (DB::select('SHOW TABLES') as $table) {
    echo current((array)$table) . "\n";
}

if (Schema::hasTable('notifications')) {
    echo "\nColumns in 'notifications' table:\n";
    print_r(Schema::getColumnListing('notifications'));
} else {
    echo "\n'notifications' table not found!\n";
}

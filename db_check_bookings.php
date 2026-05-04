<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Schema;

if (Schema::hasTable('bookings')) {
    echo "\nColumns in 'bookings' table:\n";
    print_r(Schema::getColumnListing('bookings'));
} else {
    echo "\n'bookings' table not found!\n";
}

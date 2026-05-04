<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Schema;

echo "\nFull Columns in 'bookings' table:\n";
print_r(Schema::getColumnListing('bookings'));

echo "\nFull Columns in 'clients' table:\n";
print_r(Schema::getColumnListing('clients'));

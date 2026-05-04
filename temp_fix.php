<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

$schema = DB::statement("ALTER TABLE bookings MODIFY COLUMN booking_status ENUM('pending', 'approved', 'confirm', 'completed', 'cancelled') DEFAULT 'pending'");
echo "Success";


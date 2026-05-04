<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

$table = 'bookings';
$missing = [
    'appointment_date' => 'DATE NULL AFTER slot_id',
    'venue_type' => 'VARCHAR(50) NULL AFTER appointment_date',
    'venue_address' => 'VARCHAR(255) NULL AFTER venue_type',
    'addons' => 'VARCHAR(255) NULL AFTER venue_address',
];

foreach ($missing as $col => $def) {
    if (!Schema::hasColumn($table, $col)) {
        try {
            DB::statement("ALTER TABLE $table ADD $col $def");
            echo "Added $col\n";
        } catch (Exception $e) {
            echo "Error adding $col: " . $e->getMessage() . "\n";
        }
    } else {
        echo "$col already exists\n";
    }
}
echo "Done\n";

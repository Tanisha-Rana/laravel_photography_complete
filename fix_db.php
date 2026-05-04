<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

try {
    echo "Staring DB fix...\n";
    
    // Explicitly drop foreign key first
    try {
        DB::statement('ALTER TABLE notifications DROP FOREIGN KEY notifications_client_id_foreign');
        echo "Dropped foreign key.\n";
    } catch (\Exception $e) {
        echo "Foreign key not found or error: " . $e->getMessage() . "\n";
    }

    if (Schema::hasColumn('notifications', 'client_id') && !Schema::hasColumn('notifications', 'user_id')) {
        DB::statement('ALTER TABLE notifications CHANGE client_id user_id BIGINT UNSIGNED NULL');
        echo "Renamed client_id to user_id.\n";
    }

    if (!Schema::hasColumn('notifications', 'user_role')) {
        DB::statement("ALTER TABLE notifications ADD user_role VARCHAR(255) DEFAULT 'client' AFTER id");
        echo "Added user_role.\n";
    }

    if (!Schema::hasColumn('notifications', 'title')) {
        DB::statement("ALTER TABLE notifications ADD title VARCHAR(255) NULL AFTER message");
        echo "Added title.\n";
    }

    if (!Schema::hasColumn('notifications', 'url')) {
        DB::statement("ALTER TABLE notifications ADD url VARCHAR(255) NULL AFTER title");
        echo "Added url.\n";
    }

    // Insert the migration into the migrations table manually to mark as finished
    DB::table('migrations')->insert([
        'migration' => '2026_03_29_164109_finalize_notifications_table',
        'batch' => (DB::table('migrations')->max('batch') ?? 0) + 1
    ]);
    
    echo "Done!\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

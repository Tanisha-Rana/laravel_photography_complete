<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // First change the enum to allow new values
        DB::statement("ALTER TABLE categories MODIFY COLUMN status ENUM('active', 'unactive', 'Block', 'Unblock') DEFAULT 'Block'");
        
        // Then update existing data
        DB::statement("UPDATE categories SET status = 'Unblock' WHERE status = 'active'");
        DB::statement("UPDATE categories SET status = 'Block' WHERE status = 'unactive'");
        
        // Then change to final enum
        DB::statement("ALTER TABLE categories MODIFY COLUMN status ENUM('Block', 'Unblock') DEFAULT 'Block'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // First change the enum to allow old values
        DB::statement("ALTER TABLE categories MODIFY COLUMN status ENUM('Block', 'Unblock', 'active', 'unactive') DEFAULT 'active'");
        
        // Then update data back
        DB::statement("UPDATE categories SET status = 'active' WHERE status = 'Unblock'");
        DB::statement("UPDATE categories SET status = 'unactive' WHERE status = 'Block'");
        
        // Then revert enum
        DB::statement("ALTER TABLE categories MODIFY COLUMN status ENUM('active', 'unactive') DEFAULT 'active'");
    }
};

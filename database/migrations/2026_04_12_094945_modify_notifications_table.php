<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            if (Schema::hasColumn('notifications', 'user_role')) {
                $table->dropColumn('user_role');
            }
        });
        
        if (Schema::hasColumn('notifications', 'user_id') && !Schema::hasColumn('notifications', 'client_id')) {
            DB::statement('ALTER TABLE notifications CHANGE user_id client_id BIGINT UNSIGNED NULL');
        }
        
        Schema::table('notifications', function (Blueprint $table) {
            // Add foreign key if not exists
            try {
                $table->foreign('client_id')->references('id')->on('clients');
            } catch (\Exception $e) {}
        });
    }

    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            try {
                $table->dropForeign(['client_id']);
            } catch (\Exception $e) {}
        });
        
        if (Schema::hasColumn('notifications', 'client_id') && !Schema::hasColumn('notifications', 'user_id')) {
            DB::statement('ALTER TABLE notifications CHANGE client_id user_id BIGINT UNSIGNED NULL');
        }
        
        Schema::table('notifications', function (Blueprint $table) {
            if (!Schema::hasColumn('notifications', 'user_role')) {
                $table->string('user_role')->after('id')->default('client');
            }
        });
    }
};

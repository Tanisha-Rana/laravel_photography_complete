<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Drop foreign key if it exists
            try {
                $table->dropForeign(['client_id']);
            } catch (\Exception $e) {}

            if (Schema::hasColumn('notifications', 'client_id') && !Schema::hasColumn('notifications', 'user_id')) {
                $table->renameColumn('client_id', 'user_id');
            }
            
            if (!Schema::hasColumn('notifications', 'user_role')) {
                $table->string('user_role')->after('id')->default('client');
            }
            
            if (!Schema::hasColumn('notifications', 'title')) {
                $table->string('title')->after('message')->nullable();
            }
            
            if (!Schema::hasColumn('notifications', 'url')) {
                $table->string('url')->after('title')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Reverse not strictly necessary if we had errors, but for completeness:
            if (Schema::hasColumn('notifications', 'user_id')) {
                $table->renameColumn('user_id', 'client_id');
            }
        });
    }
};

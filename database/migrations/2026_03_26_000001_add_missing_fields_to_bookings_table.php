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
        Schema::table('bookings', function (Blueprint $table) {
            if (!Schema::hasColumn('bookings', 'catalogue_id')) {
                $table->string('catalogue_id')->nullable()->after('package_id');
            }
            if (!Schema::hasColumn('bookings', 'venue_type')) {
                $table->string('venue_type', 50)->nullable()->after('appointment_date');
            }
            if (!Schema::hasColumn('bookings', 'venue_address')) {
                $table->string('venue_address', 255)->nullable()->after('venue_type');
            }
            if (!Schema::hasColumn('bookings', 'addons')) {
                $table->string('addons', 255)->nullable()->after('venue_address');
            }
            if (!Schema::hasColumn('bookings', 'coupon_code')) {
                $table->string('coupon_code', 50)->nullable()->after('total_amount');
            }
            if (!Schema::hasColumn('bookings', 'photographer_id')) {
                $table->unsignedBigInteger('photographer_id')->nullable()->after('id');
                // Don't add constraint if we're unsure it might fail
                // $table->foreign('photographer_id')->references('id')->on('photographers');
            }
            if (!Schema::hasColumn('bookings', 'extra_charges')) {
                $table->decimal('extra_charges', 10, 2)->default(0.00)->after('remaining_amount');
            }
            if (!Schema::hasColumn('bookings', 'admin_note')) {
                $table->text('admin_note')->nullable()->after('extra_charges');
            }
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['photographer_id']);
            $table->dropColumn(['catalogue_id', 'venue_type', 'venue_address', 'addons', 'coupon_code', 'photographer_id', 'extra_charges', 'admin_note']);
        });
    }
};

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
        Schema::create('advance_payments', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('appointment_id')->constrained('appointments', 'id');
            $table->decimal('amount', 10, 2);
            $table->enum('payment_mode', ['upi', 'card', 'netbanking'])->nullable();
            $table->enum('payment_status', ['success', 'failed', 'pending'])->default('pending');
            $table->timestamp('payment_date')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advance_payments');
    }
};

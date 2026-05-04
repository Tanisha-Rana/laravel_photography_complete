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
        Schema::create('client_albums', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients', 'id');
            $table->string('album_name', 100);
            $table->string('cover_image', 255);
            $table->string('album_link', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_albums');
    }
};

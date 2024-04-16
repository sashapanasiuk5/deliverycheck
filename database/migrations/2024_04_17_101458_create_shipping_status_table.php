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
        Schema::create('shipping_status', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('shipping_id');
            $table->string('status_title');
            $table->string('status_code', 10);
            $table->enum('stop_flag', ['not delivered', 'delivered'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_status');
    }
};

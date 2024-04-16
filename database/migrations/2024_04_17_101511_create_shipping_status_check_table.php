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
        Schema::create('shipping_status_check', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('shipping_id');
            $table->unsignedInteger('order_id');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->string('waybill', 30);
            $table->dateTime('date_payed_keeping')->nullable()->default(null);
            $table->datetime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_status_check');
    }
};

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
        Schema::table('svs_orders', function (Blueprint $table) {
            $table->enum('is_shipping', ['not sent', 'in the way', 'delivered', 'not delivered'])->default('not sent');
            $table->unsignedInteger('shipping_status')->nullable()->default(null);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('svs_orders', function (Blueprint $table) {
            $table->dropColumn(['is_shipping', 'shipping_status']);
        });
    }
};

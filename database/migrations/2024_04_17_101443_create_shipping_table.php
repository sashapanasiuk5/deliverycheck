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
        Schema::create('shipping', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_ua');
            $table->string('slug', 50)->default('');
            $table->unsignedInteger('position')->default(0);
            $table->unsignedTinyInteger('status')->default(0);
            $table->unsignedTinyInteger('has_city')->default(0);
            $table->unsignedTinyInteger('has_address')->default(0);
            $table->unsignedTinyInteger('has_warehouse')->default(0);
            $table->unsignedTinyInteger('has_npcity')->default(0);
            $table->unsignedTinyInteger('has_npwarehouse')->default(0);

            $table->unsignedInteger('rozetka_id')->default(0);
            $table->unsignedInteger('prom_id')->default(0);
            $table->unsignedInteger('allo_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping');
    }
};

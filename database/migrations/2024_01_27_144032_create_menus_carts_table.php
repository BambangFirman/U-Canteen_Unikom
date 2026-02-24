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
        Schema::create('menus_carts', function (Blueprint $table) {
            $table->uuid('menu_id', 36)->nullable(false);
            $table->uuid('cart_id', 36)->nullable(false);
            $table->primary(['menu_id', 'cart_id']);
            $table->foreign('menu_id')->on('menus')->references('id');
            $table->foreign('cart_id')->on('carts')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus_carts');
    }
};

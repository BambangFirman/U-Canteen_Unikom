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
        Schema::table('menus', function (Blueprint $table){
            $table->dropForeign(['shop_id']);
            $table->dropUnique(['shop_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table){
            $table->foreign(['shop_id'])->on('shops')->references('id');
            $table->unique(['shop_id']);
        });
    }
};

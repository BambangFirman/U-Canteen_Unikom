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
            $table->uuid('shop_id', 36)->nullable(false)->unique();
            $table->foreign('shop_id')->on('shops')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table){
            $table->dropColumn('shop_id');
            $table->dropForeign(['shop_id']);
        });
    }
};

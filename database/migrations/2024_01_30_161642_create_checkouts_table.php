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
        Schema::create('checkouts', function (Blueprint $table) {
            $table->uuid('id')->nullable(false)->primary();
            $table->string('invoice', 14)->nullable(false);
            $table->uuid('menu_id', 36)->nullable(false);
            $table->uuid('user_id', 36)->nullable(false);
            $table->string('billing_method', 10)->nullable(false);
            $table->time('pickup_time')->nullable(false);
            $table->timestamps();

            $table->foreign('menu_id' )->on('menus')->references('id');
            $table->foreign('user_id')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkouts');
    }
};

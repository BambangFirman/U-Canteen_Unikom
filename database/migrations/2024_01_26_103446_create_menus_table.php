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
        Schema::create('menus', function (Blueprint $table) {
            $table->uuid('id')->nullable(false)->primary();
            $table->string('menuName')->nullable(false);
            $table->uuid('category_id',36)->nullable(false);
            $table->integer('price')->nullable(false);
            $table->string('desc', 30)->nullable(false);
            $table->string('img')->nullable(false);
            $table->timestamp('created_at')->useCurrent();
            $table->foreign('category_id')->on('categories')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};

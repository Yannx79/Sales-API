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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('description')->nullable(false)->index();
            $table->enum('category', config('database.products.category'))->default(config('database.products.category')[0])->nullable(false)->index();
            $table->enum('state', [1, 3])->default(1)->nullable(false);
            $table->string('description_category')->nullable(false);
            $table->float('unit_price', 2)->unsigned()->default(0)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

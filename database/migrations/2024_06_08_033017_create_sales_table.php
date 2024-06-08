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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('items_sold')->unsigned()->default(1)->nullable(false);
            $table->float('sales_amount', 2)->unsigned()->default(0)->nullable(false);
            $table->enum('state', [1, 3])->default(1)->nullable(false);

            $table->foreignId('store_id')
            ->nullable(false)
            ->references('id')
            ->on('stores')
            ->cascadeOnUpdate()
            ->restrictOnDelete();

            $table->foreignId('time_id')
            ->nullable(false)
            ->references('id')
            ->on('times')
            ->cascadeOnUpdate()
            ->restrictOnDelete();

            $table->foreignId('product_id')
            ->nullable(false)
            ->references('id')
            ->on('products')
            ->cascadeOnUpdate()
            ->restrictOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};

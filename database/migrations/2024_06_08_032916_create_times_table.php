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
        Schema::create('times', function (Blueprint $table) {
            $table->id();
            $table->date('date')->default(now())->nullable(false);
            $table->tinyInteger('month')->unsigned()->default(1)->nullable(false);
            $table->enum('month_description', config('database.time.month_description'))->default(config('database.time.month_description')[0])->nullable(false);
            $table->string('year')->default(now()->year)->nullable(false);
            $table->tinyInteger('week')->unsigned()->default(1)->nullable(false);
            $table->enum('week_description', config('database.time.week_description'))->default(config('database.time.week_description')[0])->nullable(false);
            $table->enum('state', [1, 3])->default(1)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('times');
    }
};

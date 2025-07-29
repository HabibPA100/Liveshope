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
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->string('duration');         // যেমন: 1 Month, 3 Months, etc
            $table->integer('price');           // যেমন: 199, 499, etc
            $table->string('tag')->nullable();  // যেমন: সেরা অফার
            $table->boolean('highlight')->default(false); // true হলে হাইলাইট হবে
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_plans');
    }
};

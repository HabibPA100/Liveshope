<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('status', ['in stock', 'out of stock'])->default('in stock');

            // Images
            $table->string('product_image')->nullable();
            $table->string('slash_image')->nullable();

            // Price
            $table->decimal('offer_price', 10, 2);
            $table->decimal('real_price', 10, 2);

            // Category & Seller
            $table->json('category_path')->nullable(); // যেমন: [1, 3, 7]
            $table->unsignedBigInteger('category_id'); // leaf category
            $table->unsignedBigInteger('seller_id');

            // Optional fields
            $table->integer('views')->default(0)->nullable();
            $table->string('rating')->nullable();
            $table->string('quality')->nullable();

            // Additional fields
            $table->string('sku')->nullable()->unique();
            $table->string('brand')->nullable();
            $table->decimal('discount_percent', 5, 2)->nullable();

            $table->json('tags')->nullable();
            $table->integer('stock_quantity')->default(0);
            $table->decimal('weight', 8, 2)->nullable();
            $table->string('dimensions')->nullable();
            $table->json('colors')->nullable();
            $table->json('sizes')->nullable();

            $table->string('warranty')->nullable();
            $table->text('shipping_info')->nullable();
            $table->date('published_at')->nullable();
            $table->boolean('is_featured')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

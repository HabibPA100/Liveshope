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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('delivery_address');
            $table->text('order_note')->nullable();
            $table->string('name');
            $table->string('phone');
            $table->string('delivery_area');
            $table->integer('delivery_charge');
            $table->json('cart_items');
            $table->integer('subtotal');
            $table->integer('total');
            $table->string('status')->default('confirmed');

            $table->string('payment_status')->default('unpaid'); // ✅
            $table->string('payment_method')->nullable();        // ✅

            $table->string('unique_order_id')->unique()->nullable();    // ✅ Human-readable
            $table->string('qr_code_path')->nullable();          // ✅ QR image
            $table->string('tracking_code')->nullable();         // ✅

            $table->timestamp('canceled_at')->nullable();        // ✅
            $table->timestamp('shipped_at')->nullable();         // ✅
            $table->timestamp('delivered_at')->nullable();       // ✅

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

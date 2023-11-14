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
            $table->string('order_id')->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('tran_id')->unique();
            $table->decimal('total');
            $table->string('payment_status')->default(1)->comment('1: on cash, 2: online');
            $table->string('payment_type');
            $table->integer('order_status')->default(1)->comment('1: Pending, 2: Shipped, 3: Delivered, 4: Cancelled, 5: On Hold, 6: Returned');
            $table->boolean('shipping_status');
            // If shipping_status is true, these fields are required; otherwise, they can be empty.
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
        
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

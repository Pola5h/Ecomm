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
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('thumbnail');
    
            // Changed data type to match `categories` table
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->string('short_description')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price');
            $table->decimal('discount')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('featured')->default(false);
            $table->unsignedInteger('stock_quantity')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Add this line for soft deletes
    
            // Add foreign key constraints
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
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

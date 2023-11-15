<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('cart.shoppingcart', function (Blueprint $table) {
            $table->id();
            $table->string('identifier')->nullable();
            $table->string('instance')->nullable();
            $table->text('content')->nullable();
            $table->timestamps();
            });
    }
    
    public function down()
    {
        Schema::dropIfExists('cart.shoppingcart');
    }
    
};
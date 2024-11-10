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
        Schema::create('ordersdetails', function (Blueprint $table) {
            $table->unsignedBigInteger('idorder');
            $table->unsignedBigInteger('idproduct');
            $table->decimal('unitprice', 8, 2);
            $table->integer('quantity');
            
            $table->foreign('idorder')->references('id')->on('orders');
            $table->foreign('idproduct')->references('id')->on('products');
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('ordersdetails');
    }
};

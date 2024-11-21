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
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade'); // Liên kết đến bảng customer
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Liên kết đến bảng products
            $table->string('thumb'); 
            $table->string('name'); 
            $table->string('price'); 
            $table->integer('quantity')->default(1); 
            $table->string('total'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};

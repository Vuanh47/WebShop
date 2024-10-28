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
        Schema::create('customer', function (Blueprint $table) {
            $table->id(); // Khóa chính
            $table->string('name'); 
            $table->string('email'); 
            $table->string('password'); 
            $table->string('phone'); 
            $table->string('address'); 
            $table->string('remember_token'); 
            $table->timestamps(); // Thêm created_at và updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer');
    }
};

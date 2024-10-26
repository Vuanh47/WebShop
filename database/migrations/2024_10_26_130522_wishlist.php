<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up()
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id(); // Khóa chính
            $table->string('name'); 
            $table->string('price'); 
            $table->string('thumb'); 
            $table->integer('active'); 
            $table->timestamps(); // Thêm created_at và updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('wishlists');
    }
};
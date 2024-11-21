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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id(); // ID voucher
            $table->string('name'); // Tên voucher
            $table->decimal('value', 10, 2); // Giá trị voucher
            $table->enum('type', ['percentage', 'fixed']); // Loại voucher
            $table->date('start_date'); // Ngày bắt đầu
            $table->date('end_date'); // Ngày kết thúc
            $table->text('conditions')->nullable(); // Điều kiện sử dụng
            $table->integer('quantity')->default(0); // Số lượng voucher
            $table->timestamps(); // Thời gian tạo và cập nhật
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};

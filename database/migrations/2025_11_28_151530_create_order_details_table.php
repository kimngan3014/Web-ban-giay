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
    Schema::create('order_details', function (Blueprint $table) {
        $table->id();
        
        // 1. Cột khóa ngoại (Bắt buộc phải là unsignedBigInteger)
        $table->unsignedBigInteger('order_id');
        $table->unsignedBigInteger('product_id');
        
        // 2. Các thông tin lưu trữ tại thời điểm mua
        $table->string('product_name'); // Lưu tên đề phòng sp bị xóa
        $table->integer('quantity');
        $table->decimal('price', 12, 0); // Giá lúc mua
        $table->string('size'); // Size giày
        
        $table->timestamps();

        // 3. THIẾT LẬP KHÓA NGOẠI (QUAN TRỌNG)
        // Liên kết với bảng orders
        $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        
        // Liên kết với bảng products
        $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
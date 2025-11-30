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
        $table->string('name');
        $table->decimal('price', 12, 0)->default(0); // 12 số, 0 số lẻ (cho VNĐ)
        $table->text('description')->nullable();
        $table->string('image')->nullable();
        
        // --- ĐOẠN QUAN TRỌNG NHẤT ---
        // 1. Tạo cột category_id (cho phép null)
        $table->unsignedBigInteger('category_id')->nullable();

        // 2. Tạo liên kết khóa ngoại
        // Chú ý chữ 'categories' phải có 's' ở cuối (vì bảng kia tên là categories)
        $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        // -----------------------------

        $table->timestamps();
    });
}
};
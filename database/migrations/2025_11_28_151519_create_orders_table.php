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
        $table->id(); // Tự động tạo id kiểu unsignedBigInteger
        
        $table->unsignedBigInteger('user_id')->nullable(); // Người dùng (có thể null nếu khách vãng lai)
        
        $table->string('first_name');
        $table->string('last_name');
        $table->string('email');
        $table->string('phone');
        $table->text('address');
        $table->decimal('total_price', 12, 0);
        $table->string('status')->default('pending'); // Trạng thái
        $table->text('note')->nullable();
        
        $table->timestamps();

        // Khóa ngoại liên kết với users (nếu có bảng users)
        // Nếu bạn chưa tạo bảng users thì xóa dòng bên dưới đi
        $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
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
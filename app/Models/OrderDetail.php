<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $fillable = ['order_id', 'product_id', 'product_name', 'quantity', 'price', 'size'];

    // Để lấy ảnh sản phẩm hiển thị trong chi tiết đơn
    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
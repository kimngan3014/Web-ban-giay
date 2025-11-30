<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['user_id', 'first_name', 'last_name', 'address', 'phone', 'email', 'total_price', 'status', 'note'];

    // Quan hệ: 1 Đơn hàng có nhiều chi tiết (Sản phẩm)
    public function details() {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
}
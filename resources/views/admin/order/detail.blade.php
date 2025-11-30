@extends('layout.admin')
@section('body')
<div class="container-fluid">
    
    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Quay lại danh sách</a>

    <div class="row">
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thông tin khách hàng</h6>
                </div>
                <div class="card-body">
                    <p><strong>Họ tên:</strong> {{ $order->first_name }} {{ $order->last_name }}</p>
                    <p><strong>Email:</strong> {{ $order->email }}</p>
                    <p><strong>SĐT:</strong> {{ $order->phone }}</p>
                    <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>
                    <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                    <hr>
                    
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        <label for="status" class="font-weight-bold">Cập nhật trạng thái:</label>
                        <select name="status" class="form-control mb-3">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                            <option value="shipping" {{ $order->status == 'shipping' ? 'selected' : '' }}>Đang giao hàng</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Đã hoàn thành</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Hủy đơn</option>
                        </select>
                        <button type="submit" class="btn btn-primary btn-block">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Chi tiết sản phẩm</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th class="text-center">Size</th>
                                <th class="text-center">Số lượng</th>
                                <th class="text-right">Đơn giá</th>
                                <th class="text-right">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->details as $item)
                            <tr>
                                <td>{{ $item->product_name }}</td>
                                <td>
                                    @if($item->product && $item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" width="60" alt="Img">
                                    @else
                                        <span>No Image</span>
                                    @endif
                                </td>
                                <td class="text-center font-weight-bold text-danger">{{ $item->size }}</td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-right">{{ number_format($item->price, 0, ',', '.') }} đ</td>
                                <td class="text-right">{{ number_format($item->price * $item->quantity, 0, ',', '.') }} đ</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-right font-weight-bold">Tổng thanh toán:</td>
                                <td class="text-right text-danger font-weight-bold h5">
                                    {{ number_format($order->total_price, 0, ',', '.') }} đ
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
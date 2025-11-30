@extends('layout.admin')
@section('body')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Quản lý Đơn Hàng</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách đơn đặt hàng</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Khách hàng</th>
                            <th>Ngày đặt</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>
                                <b>{{ $order->first_name }} {{ $order->last_name }}</b><br>
                                <small>{{ $order->phone }}</small>
                            </td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-danger font-weight-bold">{{ number_format($order->total_price, 0, ',', '.') }} đ</td>
                            <td>
                                @if($order->status == 'pending')
                                    <span class="badge badge-warning">Chờ xử lý</span>
                                @elseif($order->status == 'shipping')
                                    <span class="badge badge-info">Đang giao hàng</span>
                                @elseif($order->status == 'completed')
                                    <span class="badge badge-success">Đã giao xong</span>
                                @else
                                    <span class="badge badge-danger">Đã hủy</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Xem chi tiết
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- Phân trang --}}
                <div class="d-flex justify-content-center">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layout/user')
@section('body')
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="bread"><span><a href="{{ url('/') }}">Home</a></span> / <span>Shopping Cart</span></p>
					</div>
				</div>
			</div>
		</div>


		<div class="colorlib-product">
			<div class="container">
				<div class="row row-pb-lg">
					<div class="col-md-10 offset-md-1">
						<div class="process-wrap">
							<div class="process text-center active">
								<p><span>01</span></p>
								<h3>Shopping Cart</h3>
							</div>
							<div class="process text-center">
								<p><span>02</span></p>
								<h3>Checkout</h3>
							</div>
							<div class="process text-center">
								<p><span>03</span></p>
								<h3>Order Complete</h3>
							</div>
						</div>
					</div>
				</div>
				<div class="row row-pb-lg">
					<div class="col-md-12">
						<div class="col-md-12">
    <div class="product-name d-flex">
        {{-- ... Giữ nguyên phần tiêu đề bảng ... --}}
    </div>

    {{-- KIỂM TRA GIỎ HÀNG CÓ TRỐNG KHÔNG --}}
    @if(session('cart'))
        @foreach(session('cart') as $id => $details)
            <div class="product-cart d-flex">
                <div class="one-forth">
                    <div class="product-img" style="background-image: url('{{ asset('images/' . $details['image']) }}');">
                    </div>
                    <div class="display-tc">
                        <h3>{{ $details['name'] }} (Size: {{ $details['size'] }})</h3>
                    </div>
                </div>
                <div class="one-eight text-center">
                    <div class="display-tc">
                        <span class="price">${{ $details['price'] }}</span>
                    </div>
                </div>
                <div class="one-eight text-center">
                    <div class="display-tc">
                        <input type="text" name="quantity" class="form-control input-number text-center" value="{{ $details['quantity'] }}" min="1" max="100">
                    </div>
                </div>
                <div class="one-eight text-center">
                    <div class="display-tc">
                        {{-- Tính tổng tiền từng món --}}
                        <span class="price">${{ $details['price'] * $details['quantity'] }}</span>
                    </div>
                </div>
                <div class="one-eight text-center">
                    <div class="display-tc">
                        <a href="#" class="closed"></a> </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="text-center p-5">
            <h3>Giỏ hàng đang trống!</h3>
            <a href="{{ route('home') }}" class="btn btn-primary">Mua sắm ngay</a>
        </div>
    @endif
</div>
				</div>
			</div>
		</div>
@endsection
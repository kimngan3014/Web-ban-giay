@extends('layout/user')
@section('body')
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="bread"><span><a href="index.html">Home</a></span> / <span>Checkout</span></p>
					</div>
				</div>
			</div>
		</div>


		<div class="colorlib-product">
			<div class="container">
				<div class="row row-pb-lg">
					<div class="col-sm-10 offset-md-1">
						<div class="process-wrap">
							<div class="process text-center active">
								<p><span>01</span></p>
								<h3>Shopping Cart</h3>
							</div>
							<div class="process text-center active">
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
				<div class="row">
					<div class="col-lg-8">
    {{-- Thêm thẻ Form trỏ về route xử lý --}}
    <form action="{{ route('checkout.placeOrder') }}" method="post" class="colorlib-form">
        @csrf {{-- Bắt buộc phải có token bảo mật --}}
        <h2>Chi tiết thanh toán</h2>
        <div class="row">
            {{-- Họ và Tên --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fname">Họ</label>
                    <input type="text" id="fname" name="fname" class="form-control" placeholder="Họ của bạn" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="lname">Tên</label>
                    <input type="text" id="lname" name="lname" class="form-control" placeholder="Tên của bạn" required>
                </div>
            </div>

            {{-- Địa chỉ --}}
            <div class="col-md-12">
                <div class="form-group">
                    <label for="address">Địa chỉ nhận hàng</label>
                    <input type="text" id="address" name="address" class="form-control" placeholder="Nhập địa chỉ cụ thể..." required>
                </div>
            </div>

            {{-- Số điện thoại --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">Số điện thoại</label>
                    <input type="text" id="phone" name="phone" class="form-control" placeholder="SĐT liên hệ" required>
                </div>
            </div>

            {{-- Email --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email xác nhận đơn" required>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12 text-center">
                {{-- Nút Submit form --}}
                <p><button type="submit" class="btn btn-primary">Đặt hàng ngay</button></p>
            </div>
        </div>
    </form>
</div>

					<div class="col-lg-4">
						<div class="row">
							<div class="col-md-12">
								<div class="cart-detail">
									<h2>Cart Total</h2>
									<ul>
										<li>
											<span>Subtotal</span> <span>$100.00</span>
											<ul>
												<li><span>1 x Product Name</span> <span>$99.00</span></li>
												<li><span>1 x Product Name</span> <span>$78.00</span></li>
											</ul>
										</li>
										<li><span>Shipping</span> <span>$0.00</span></li>
										<li><span>Order Total</span> <span>$180.00</span></li>
									</ul>
								</div>
						   </div>

						   <div class="w-100"></div>

						   <div class="col-md-12">
								<div class="cart-detail">
									<h2>Payment Method</h2>
									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="optradio"> Direct Bank Tranfer</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="optradio"> Check Payment</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="optradio"> Paypal</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12">
											<div class="checkbox">
											   <label><input type="checkbox" value=""> I have read and accept the terms and conditions</label>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 text-center">
								<p><a href="#" class="btn btn-primary">Place an order</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
@endsection
@extends('layout.user')

@section('body')
<div class="colorlib-product">
    <div class="container">
        <div class="row row-pb-lg">
            <div class="col-sm-10 offset-md-1">
                <div class="product-detail-wrap">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="product-entry border">
                                <div class="prod-img">
                                    <img src="{{ asset('images/' . $product->image) }}" class="img-fluid" alt="{{ $product->name }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="desc">
                                <h3>{{ $product->name }}</h3>
                                <p class="price">
                                    <span>${{ number_format($product->price, 2) }}</span>
                                </p>
                                <p>{{ $product->description }}</p> <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                                    <div class="row row-pb-sm">
    <div class="col-md-4">
        <div class="input-group">
            <label class="mr-3" style="align-self: center;">Size:</label>
            {{-- Dùng thẻ Select để tạo menu xổ xuống --}}
            <select name="size" class="form-control" required>
                <option value="38">38</option>
                <option value="39">39</option>
                <option value="40">40</option>
                <option value="41">41</option>
                <option value="42">42</option>
            </select>
        </div>
    </div>
</div>

<div class="row row-pb-sm">
    <div class="col-md-4">
        <div class="input-group mb-4">
            {{-- Nút TRỪ --}}
            <span class="input-group-btn">
                <button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
                    <i class="icon-minus2"></i> -
                </button>
            </span>
            
            {{-- Ô nhập số lượng --}}
            <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100" style="text-align: center;">
            
            {{-- Nút CỘNG --}}
            <span class="input-group-btn">
                <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                    <i class="icon-plus2"></i> +
                </button>
            </span>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> {{-- Nếu web bạn chưa có jQuery thì thêm dòng này, nếu có rồi thì bỏ qua --}}

<script>
    // Đảm bảo ID của input hidden là 'selected_size'
// <input type="hidden" name="size" id="selected_size" value="">

window.selectSize = function(size, element) {
    // 1. Xóa class active ở các thẻ khác
    document.querySelectorAll('.size-option').forEach(el => el.classList.remove('active'));
    
    // 2. Thêm class active cho thẻ được chọn (để đổi màu)
    element.classList.add('active');
    
    // 3. Cập nhật giá trị vào input ẩn để gửi form
    document.getElementById('selected_size').value = size;
};
$(document).ready(function(){

    // Xử lý nút CỘNG
    var quantitiy=0;
       $('.quantity-right-plus').click(function(e){
            
            // Ngăn chặn hành động mặc định
            e.preventDefault();
            
            // Lấy số lượng hiện tại trong ô input
            var quantity = parseInt($('#quantity').val());
            
            // Cộng thêm 1
            $('#quantity').val(quantity + 1);
            
        });

        // Xử lý nút TRỪ
        $('.quantity-left-minus').click(function(e){
            // Ngăn chặn hành động mặc định
            e.preventDefault();
            
            // Lấy số lượng hiện tại
            var quantity = parseInt($('#quantity').val());
            
            // Nếu số lượng > 1 thì mới trừ (không cho mua 0 cái)
            if(quantity>1){
                $('#quantity').val(quantity - 1);
            }
        });
        
});
</script>
@endsection
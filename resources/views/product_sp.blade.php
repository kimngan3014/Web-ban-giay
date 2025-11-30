@extends('layout.user')
@section('body')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="bread"><span><a href="{{ route('home') }}">Home</a></span> / <span>Danh sách sản phẩm</span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="colorlib-product">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 offset-sm-2 text-center colorlib-heading">
                    <h2>Tất cả sản phẩm</h2>
                </div>
            </div>

            {{-- VÒNG LẶP HIỂN THỊ SẢN PHẨM DẠNG LƯỚI --}}
            <div class="row row-pb-md">
                @if(isset($products) && count($products) > 0)
                    @foreach($products as $product)
                        <div class="col-lg-3 mb-4 text-center">
                            <div class="product-entry border">
                                <a href="{{ route('product.detail', $product->id) }}" class="prod-img">
                                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid" 
                                         alt="{{ $product->name }}"
                                         onerror="this.src='https://placehold.co/300x300?text=No+Image'">
                                </a>
                                <div class="desc">
                                    <h2><a href="{{ route('product.detail', $product->id) }}">{{ $product->name }}</a></h2>
                                    <span class="price">{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center">
                        <p>Hiện chưa có sản phẩm nào.</p>
                    </div>
                @endif
            </div>

            {{-- PHÂN TRANG --}}
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="block-27">
                        {{ $products->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
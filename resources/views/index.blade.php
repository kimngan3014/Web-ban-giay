@extends('layout/user')
@section('body')
    <aside id="colorlib-hero">
        <div class="flexslider">
            <ul class="slides">
                <li style="background-image: url(images/img_bg_1.jpg);">
                    <div class="overlay"></div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6 offset-sm-3 text-center slider-text">
                                <div class="slider-text-inner">
                                    <div class="desc">
                                        <h1 class="head-1">Men's</h1>
                                        <h2 class="head-2">Shoes</h2>
                                        <h2 class="head-3">Collection</h2>
                                        <p class="category"><span>New trending shoes</span></p>
                                        <p><a href="{{ route('men')}}" class="btn btn-primary">Shop Collection</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li style="background-image: url(images/img_bg_2.jpg);">
                    <div class="overlay"></div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6 offset-sm-3 text-center slider-text">
                                <div class="slider-text-inner">
                                    <div class="desc">
                                        <h1 class="head-1">Huge</h1>
                                        <h2 class="head-2">Sale</h2>
                                        <h2 class="head-3"><strong class="font-weight-bold">50%</strong> Off</h2>
                                        <p class="category"><span>Big sale sandals</span></p>
                                        <p><a href="{{ route('women')}}" class="btn btn-primary">Shop Collection</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li style="background-image: url(images/img_bg_3.jpg);">
                    <div class="overlay"></div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6 offset-sm-3 text-center slider-text">
                                <div class="slider-text-inner">
                                    <div class="desc">
                                        <h1 class="head-1">New</h1>
                                        <h2 class="head-2">Arrival</h2>
                                        <h2 class="head-3">up to <strong class="font-weight-bold">30%</strong> off</h2>
                                        <p class="category"><span>New stylish shoes for men</span></p>
                                        <p><a href="{{ route('men')}}" class="btn btn-primary">Shop Collection</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </aside>
    <div class="colorlib-intro">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h2 class="intro">It started with a simple idea: Create quality, well-designed products that I wanted
                        myself.</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="colorlib-product">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 text-center">
                    <div class="featured">
                        <a href="{{ route('men')}}" class="featured-img" style="background-image: url(images/men.jpg);"></a>
                        <div class="desc">
                            <h2><a href="{{ route('men')}}">Shop Men's Collection</a></h2>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 text-center">
                    <div class="featured">
                        <a href="{{ route('women')}}" class="featured-img" style="background-image: url(images/women.jpg);"></a>
                        <div class="desc">
                            <h2><a href="{{ route('women')}}">Shop Women's Collection</a></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="colorlib-product">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 offset-sm-2 text-center colorlib-heading">
                    <h2>Best Sellers</h2>
                </div>
            </div>
            <div class="row row-pb-md">
    {{-- BẮT ĐẦU VÒNG LẶP --}}
    @foreach($products as $product)
    <div class="col-lg-3 mb-4 text-center">
        <div class="product-entry border">
            <a href="{{ route('product.detail', $product->id) }}" class="prod-img">
                <img src="{{ asset('images/' . $product->image) }}" class="img-fluid" alt="{{ $product->name }}">
            </a>
            <div class="desc">
                <h2><a href="{{ route('product.detail', $product->id) }}">{{ $product->name }}</a></h2>
                <span class="price">${{ number_format($product->price, 2) }}</span>
            </div>
        </div>
    </div>
    @endforeach
    {{-- KẾT THÚC VÒNG LẶP --}}
</div>
        </div>
    </div>
@endsection

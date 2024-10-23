@extends('main')

@section('content')
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active">Shop</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->

    <!-- Begin Li's Content Wraper Area -->
    <div class="content-wraper pt-60 pb-60">
        <div class="container">
            <div class="row product">
                @if($products->count() > 0)
                    @foreach($products as $product)
                        <div class="col-lg-3 col-md-4 col-sm-6 mt-40">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">
                                    <a href="{{ route('details', $product->id) }}">
                                        <img src="{{ asset('storage/uploads/' . $product->thumb) }}" alt="{{ $product->name }}">
                                    </a>
                                    <span class="sticker">New</span>
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="#">{{ $product->category }}</a>
                                            </h5>
                                            <div class="rating-box">
                                                <ul class="rating">
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <h4><a class="product_name" href="{{ route('details', $product->id) }}">{{ $product->name }}</a></h4>
                                        <div class="price-box">
                                            <span class="new-price">{{ $product->price_sale }} VND</span>
                                           
                                                <span class="old-price">{{ $product->price }} VND</span>
                                                <span class="discount-percentage">-{{ number_format((($product->price - $product->price_sale) / $product->price) * 100, 0) }}%</span>
                                         
                                        </div>
                                    </div>
                                    <div class="add-actions">
                                        <ul class="add-actions-link">
                                            <li class="add-cart active"><a href="{{ route('cart', $product->id) }}">Add to cart</a></li>
                                            <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
                                            <li><a class="links-details" href="{{ route('wishlist', $product->id) }}"><i class="fa fa-heart-o"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- single-product-wrap end -->
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <p class="text-center">Không có sản phẩm nào để hiển thị.</p>
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper mt-40 d-flex justify-content-end">
                {{ $products->links() }}
            </div>
        </div>
    </div>
    <!-- Content Wraper Area End Here -->
@endsection

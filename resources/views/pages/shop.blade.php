@extends('main')

@section('content')

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
                                    @php
                                    $averageRating = $product->blogs->avg('star');
                                    $rating = $averageRating > 0 ? $averageRating : 0;
                                    @endphp
                                    <!-- Display Rating Stars -->
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($rating>= $i)
                                        <i class="fa fa-star text-warning"></i>
                                        @elseif ($rating >= $i - 0.5)
                                        <i class="fas fa-star-half" style="color:rgb(243, 196, 25);"></i>
                                        @else
                                        <i class="far fa-star" style="color:rgb(243, 196, 25);"></i>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            <h4><a class="product_name" href="{{ route('details', $product->id) }}">{{ $product->name }}</a></h4>
                            <div class="price-box">
                                <span class="new-price" style="color: red; font-size: 18px;">
                                    {{ formatCurrency($product->price_sale) }}
                                </span>
                                <span class="old-price">
                                    {{ formatCurrency($product->price) }}
                                </span>
                                <?php
                                $price = floatval($product->price);
                                $price_sale = floatval($product->price_sale);

                                $discount_percentage = (($price - $price_sale) / $price) * 100;
                                ?>
                                <span class="discount-percentage">-{{ number_format($discount_percentage, 0) }}%</span>
                            </div>
                        </div>
                        <div class="add-actions">
                            <ul class="add-actions-link">
                                <li class="add-cart active">
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
                                            ADD TO CART
                                        </button>
                                    </form>
                                </li>

                                <li>

                                    <a href="{{ route('details', $product->id) }}" title="quick view" class="quick-view-btn">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('wishlist.store', $product->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
                                            <i class="fa fa-heart"></i>
                                        </button>
                                    </form>
                                </li>
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
        @include('admin.alert')
    </div>
</div>
<!-- Content Wraper Area End Here -->
@endsection
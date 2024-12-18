@extends('main')

@section('content')
    <!-- content-wraper start -->
    <div class="content-wraper">
        <div class="container">
            <div class="row single-product-area">
                <div class="col-lg-5 col-md-6">
                    <!-- Product Details Left -->
                    <div class="product-details-left">
                        <div class="product-details-images slider-navigation-1">
                            <div class="lg-image">
                                <a class="popup-img venobox vbox-item" href="{{ asset('storage/uploads/' . $product->thumb) }}" data-gall="myGallery">
                                <img src="{{ asset('storage/uploads/' . $product->thumb) }}" alt="Li's Product Image">
                                </a>
                            </div>
                            <div class="lg-image">
                                <a class="popup-img venobox vbox-item" href="{{asset('user/images/product/large-size/2.jpg')}}" data-gall="myGallery">
                                    <img src="{{asset('user/images/product/large-size/2.jpg')}}" alt="product image">
                                </a>
                            </div>
                            <div class="lg-image">
                                <a class="popup-img venobox vbox-item" href="{{asset('user/images/product/large-size/3.jpg')}}" data-gall="myGallery">
                                    <img src="{{asset('user/images/product/large-size/3.jpg')}}" alt="product image">
                                </a>
                            </div>
                            <div class="lg-image">
                                <a class="popup-img venobox vbox-item" href="{{asset('user/images/product/large-size/4.jpg')}}" data-gall="myGallery">
                                    <img src="{{asset('user/images/product/large-size/4.jpg')}}" alt="product image">
                                </a>
                            </div>
                            <div class="lg-image">
                                <a class="popup-img venobox vbox-item" href="{{asset('user/images/product/large-size/5.jpg')}}" data-gall="myGallery">
                                    <img src="{{asset('user/images/product/large-size/5.jpg')}}" alt="product image">
                                </a>
                            </div>
                            <div class="lg-image">
                                <a class="popup-img venobox vbox-item" href="{{asset('user/images/product/large-size/6.jpg')}}" data-gall="myGallery">
                                    <img src="{{asset('user/images/product/large-size/6.jpg')}}" alt="product image">
                                </a>
                            </div>
                        </div>
                        <div class="product-details-thumbs slider-thumbs-1">                                        
                            <div class="sm-image"><img src="{{ asset('storage/uploads/' . $product->thumb) }}" alt="product image thumb"></div>
                            <div class="sm-image"><img src="{{asset('user/images/product/small-size/2.jpg')}}" alt="product image thumb"></div>
                            <div class="sm-image"><img src="{{asset('user/images/product/small-size/3.jpg')}}" alt="product image thumb"></div>
                            <div class="sm-image"><img src="{{asset('user/images/product/small-size/4.jpg')}}" alt="product image thumb"></div>
                            <div class="sm-image"><img src="{{asset('user/images/product/small-size/5.jpg')}}" alt="product image thumb"></div>
                            <div class="sm-image"><img src="{{asset('user/images/product/small-size/6.jpg')}}" alt="product image thumb"></div>
                        </div>
                    </div>
                    <!--// Product Details Left -->
                </div>

                <div class="col-lg-7 col-md-6">
                    <div class="product-details-view-content pt-60">
                        <div class="product-info">
                            <h1 style="color: blue;">{{$product->name}}</h1>
                            <span class="product-details-ref">Warehouse: {{$product->quantity}}</span>
                            <div class="rating-box pt-20">
                                <ul class="rating rating-with-review-item">
                                
                                    @php
                                        $averageRating = $product->blogs->avg('star');
                                        $rating = $averageRating > 0 ? $averageRating : 0;
                                    @endphp
                                    <!-- Display Rating Stars -->
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($rating >= $i)
                                            <i class="fa fa-star text-warning"></i>
                                        @elseif ($rating >= $i - 0.5)
                                            <i class="fa fa-star-half-o text-warning"></i>
                                        @else
                                            <i class="fa fa-star-o text-muted"></i>
                                        @endif
                                    @endfor
                                    <span class="ml-2 text-muted">({{ $product->blogs->count() }} đánh giá)</span>
                                    <li class="review-item"><a href="{{route('blog.detail',$product->id)}}">Read Review</a></li>
                                    <li class="review-item"><a href="{{route('blog.detail',$product->id)}}">Write Review</a></li>
                                </ul>
                            </div>
                            <div class="price-box">
                                <span class="new-price">{{ formatCurrency($product->price_sale) }}</span>
                                <span class="old-price">{{ formatCurrency($product->price) }}</span>
                                
                                @php
                                    $price = floatval($product->price);
                                    $price_sale = floatval($product->price_sale);

                                    $discount_percentage = (($price - $price_sale) / $price) * 100;
                                @endphp
                                <span class="discount-percentage">-{{ number_format($discount_percentage, 0) }}%</span>
                            </div>


                            <div class="product-desc">
                                <p>
                                    <span>{!! $product->description !!}</span>
                                    <span>{!! $product->content !!}</span>
                                </p>
                            </div>
                           
                            
                            <div class="single-add-to-cart">
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <div class="cart-quantity">
                                        <div class="quantity">
                                            <label for="quantity">Quantity</label>
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" value="1" type="number" name="quantity" id="quantity" min="1">
                                                <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-warning" style="height: 50px; width: 200px; border: none; padding: 0; cursor: pointer;">
                                            ADD TO CART
                                        </button>
                                    </div>
                                </form>

                            </div>
                            <div class="product-additional-info pt-25">
                                <form action="{{ route('wishlist.store', $product->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
                                    <i class="fa fa-heart-o"></i>Add to wishlist
                                    </button>
                                </form>
                                <div class="product-social-sharing pt-25">
                                    <ul>
                                        <li class="facebook"><a href="#"><i class="fa fa-facebook"></i>Facebook</a></li>
                                        <li class="twitter"><a href="#"><i class="fa fa-twitter"></i>Twitter</a></li>
                                        <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i>Google +</a></li>
                                        <li class="instagram"><a href="#"><i class="fa fa-instagram"></i>Instagram</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="block-reassurance">
                                <ul>
                                    <li>
                                        <div class="reassurance-item">
                                            <div class="reassurance-icon">
                                                <i class="fa fa-check-square-o"></i>
                                            </div>
                                            <p>Security policy (edit with Customer reassurance module)</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="reassurance-item">
                                            <div class="reassurance-icon">
                                                <i class="fa fa-truck"></i>
                                            </div>
                                            <p>Delivery policy (edit with Customer reassurance module)</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="reassurance-item">
                                            <div class="reassurance-icon">
                                                <i class="fa fa-exchange"></i>
                                            </div>
                                            <p> Return policy (edit with Customer reassurance module)</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <!-- content-wraper end -->
    <!-- Begin Product Area -->
    <div class="product-area pt-35">
        <div class="container">
            <div class="row">
        <div class="col-lg-12">
            <div class="li-product-tab">
                <ul class="nav li-product-menu">
                    <li><a class="active" data-toggle="tab" href="#description"><span>Description</span></a></li>
                    <li><a data-toggle="tab" href="#reviews"><span>Reviews</span></a></li>
                </ul>               
            </div>
        </div>
    </div>

            <div class="tab-content">
                <!-- Tab Description -->
                <div id="description" class="tab-pane active show" role="tabpanel">
                    <div class="product-description">
                        <span>{!! $product->content !!}</span>
                    </div>
                </div>
                
                <!-- Tab Reviews -->
                <div id="reviews" class="tab-pane" role="tabpanel">
                    <div class="product-reviews">
                        
                        <!-- Write Your Review Link -->
                        <div class="review-btn">
                            <a class="review-links" href="#" data-toggle="modal" data-target="#mymodal">Write Your Review!</a>
                        </div>
                        <div class="product-details-comment-block">
                            @foreach ($blogs as $blog)
                                <div class="comment-review">
                                    <div class="comment-header">
                                        <!-- Rating Stars -->
                                        <ul class="rating">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <li>
                                                    <i class="fa fa-star{{ $blog->star >= $i ? '' : '-o' }}"></i>
                                                </li>
                                            @endfor
                                        </ul>

                                        <span class="comment-date">{{ \Carbon\Carbon::parse($blog->created_at)->format('H:i, d/m/Y') }}</span>
                                    </div>

                                    <!-- User Info: Avatar and Name -->
                                    <div class="comment-header">
                                        <div class="comment-avatar">
                                            <img src="{{ $blog->customer->avatar ? asset('storage/' . $blog->customer->avatar) : 'https://via.placeholder.com/60' }}" alt="Avatar của {{ $blog->customer->name }}" />
                                        </div>
                                        <strong class="comment-author">{{ $blog->customer->name }}</strong>
                                    </div>

                                    <!-- Comment Content -->
                                    <div class="comment-body">
                                        <h4 class="comment-title text-primary">Đánh giá sản phẩm</h4>
                                        <p class="comment-content">{{ $blog->content }}</p>
                                    </div>

                                    <!-- Product Image from Comment (if available) -->
                                    @if ($blog->thumb)
                                        <div class="comment-image">
                                            <a href="/storage/uploads/{{ $product->thumb }}">
                                                <img src="/storage/uploads/{{ $blog->thumb }}" width="100px" />
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>


                        <!-- Modal for Writing Review -->
                        <div class="modal fade modal-wrapper" id="mymodal">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <h3 class="review-page-title">Write Your Review</h3>
                                        <div class="modal-inner-area row">
                                            <div class="col-lg-6">
                                                <div class="li-review-product">
                                                     <img src="/storage/uploads/{{ $product->thumb }}" width="300" />

                                                    <div class="li-review-product-desc">
                                                        <p class="li-product-name">{{ $product->name }}</p>
                                                        <p>
                                                            <span>{{ $product->description }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="li-review-content">
                                                    <!-- Begin Feedback Area -->
                                                    <div class="feedback-area">
                                                        <div class="feedback">
                                                            <h3 class="feedback-title">Our Feedback</h3>
                                                            <form action="{{route('comment.add')}}" method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                <p class="your-opinion">
                                                                    <label for="star">Your Rating</label>
                                                                    <input type="hidden" name="customer_id" value="{{$customer_id}}">
                                                                    <input type="hidden" name="product_id" value="{{$product->id}}">

                                                                    <span>
                                                                        <select class="star-rating" name="star" required>
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                        </select>
                                                                    </span>
                                                                </p>
                                                                <p class="feedback-form">
                                                                    <label for="content">Your Review</label>
                                                                    <textarea id="content" name="content" cols="45" rows="8" required></textarea>
                                                                </p>
                                                                <div class="feedback-input">
                                                                    <p class="feedback-form-author">
                                                                        <div class="form-group mb-3"> 
                                                                            <label for="thumb" class="form-label">Chọn Ảnh</label>
                                                                            <div class="mb-3">
                                                                                <input type="file" id="imageUpload" name="thumb_path" accept=".png, .jpg, .jpeg" onchange="previewImage(this)">
                                                                            </div>

                                                                            <!-- Trường ẩn để lưu đường dẫn ảnh sau khi tải lên -->
                                                                            <input type="hidden" name="thumb" id="thumb" >

                                                                            <div class="avatar-preview">
                                                                                <div id="imagePreview" style="background-image: url('{{ $imageUrl }}'); width: 200px; height: 200px; background-size: cover; background-position: center;"></div>
                                                                            </div>
                                                                        </div>
                                                                    </p>
                                                                </div>

                                                                <!-- Submit and Close buttons -->
                                                                <div class="feedback-btn pb-15">
                                                                    <button type="submit" class="btn btn-dark m-1">Submit</button>
                                                                    <button type="button" class="btn btn-dark m-1" data-dismiss="modal" aria-label="Close">Close</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- Feedback Area End Here -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('admin.alert')
        </div>
    </div>
    
    <!-- Product Area End Here -->
    <!-- Begin Li's Laptop Product Area -->
    <section class="product-area li-laptop-product pt-30 pb-50">
        <div class="container">
            <div class="row">
                <!-- Begin Li's Section Area -->
                <div class="col-lg-12">
                    <div class="li-section-title">
                        <h2>
                            <span>{{$countRelatedPro}} other products in the same category:</span>
                        </h2>
                    </div>
                    <div class="row">
                        <div class="product-active owl-carousel">
                            <div class="col-lg-12">
                                <!-- single-product-wrap start -->
                                <div class="single-product-wrap">
                                    <div class="product-image">
                                        <a href="single-product.html">
                                            <img src="{{asset('user/images/product/large-size/1.jpg')}}" alt="Li's Product Image">
                                        </a>
                                        <span class="sticker">New</span>
                                    </div>
                                    <div class="product_desc">
                                        <div class="product_desc_info">
                                            <div class="product-review">
                                                <h5 class="manufacturer">
                                                    <a href="product-details.html">Graphic Corner</a>
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
                                            <h4><a class="product_name" href="single-product.html">Accusantium dolorem1</a></h4>
                                            <div class="price-box">
                                                <span class="new-price">$46.80</span>
                                            </div>
                                        </div>
                                        <div class="add-actions">
                                            <ul class="add-actions-link">
                                                <li class="add-cart active"><a href="#">Add to cart</a></li>
                                                <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
                                                <li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- single-product-wrap end -->
                            </div>
                            <div class="col-lg-12">
                                <!-- single-product-wrap start -->
                                <div class="single-product-wrap">
                                    <div class="product-image">
                                        <a href="single-product.html">
                                            <img src="{{asset('user/images/product/large-size/2.jpg')}}" alt="Li's Product Image">
                                        </a>
                                        <span class="sticker">New</span>
                                    </div>
                                    <div class="product_desc">
                                        <div class="product_desc_info">
                                            <div class="product-review">
                                                <h5 class="manufacturer">
                                                    <a href="product-details.html">Studio Design</a>
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
                                            <h4><a class="product_name" href="single-product.html">Mug Today is a good day</a></h4>
                                            <div class="price-box">
                                                <span class="new-price new-price-2">$71.80</span>
                                                <span class="old-price">$77.22</span>
                                                <span class="discount-percentage">-7%</span>
                                            </div>
                                        </div>
                                        <div class="add-actions">
                                            <ul class="add-actions-link">
                                                <li class="add-cart active"><a href="#">Add to cart</a></li>
                                                <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
                                                <li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- single-product-wrap end -->
                            </div>
                            <div class="col-lg-12">
                                <!-- single-product-wrap start -->
                                <div class="single-product-wrap">
                                    <div class="product-image">
                                        <a href="single-product.html">
                                            <img src="{{asset('user/images/product/large-size/3.jpg')}}" alt="Li's Product Image">
                                        </a>
                                        <span class="sticker">New</span>
                                    </div>
                                    <div class="product_desc">
                                        <div class="product_desc_info">
                                            <div class="product-review">
                                                <h5 class="manufacturer">
                                                    <a href="product-details.html">Graphic Corner</a>
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
                                            <h4><a class="product_name" href="single-product.html">Accusantium dolorem1</a></h4>
                                            <div class="price-box">
                                                <span class="new-price">$46.80</span>
                                            </div>
                                        </div>
                                        <div class="add-actions">
                                            <ul class="add-actions-link">
                                                <li class="add-cart active"><a href="#">Add to cart</a></li>
                                                <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
                                                <li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- single-product-wrap end -->
                            </div>
                            <div class="col-lg-12">
                                <!-- single-product-wrap start -->
                                <div class="single-product-wrap">
                                    <div class="product-image">
                                        <a href="single-product.html">
                                            <img src="{{asset('user/images/product/large-size/4.jpg')}}" alt="Li's Product Image">
                                        </a>
                                        <span class="sticker">New</span>
                                    </div>
                                    <div class="product_desc">
                                        <div class="product_desc_info">
                                            <div class="product-review">
                                                <h5 class="manufacturer">
                                                    <a href="product-details.html">Studio Design</a>
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
                                            <h4><a class="product_name" href="single-product.html">Mug Today is a good day</a></h4>
                                            <div class="price-box">
                                                <span class="new-price new-price-2">$71.80</span>
                                                <span class="old-price">$77.22</span>
                                                <span class="discount-percentage">-7%</span>
                                            </div>
                                        </div>
                                        <div class="add-actions">
                                            <ul class="add-actions-link">
                                                <li class="add-cart active"><a href="#">Add to cart</a></li>
                                                <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
                                                <li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- single-product-wrap end -->
                            </div>
                            <div class="col-lg-12">
                                <!-- single-product-wrap start -->
                                <div class="single-product-wrap">
                                    <div class="product-image">
                                        <a href="single-product.html">
                                            <img src="{{asset('user/images/product/large-size/5.jpg')}}" alt="Li's Product Image">
                                        </a>
                                        <span class="sticker">New</span>
                                    </div>
                                    <div class="product_desc">
                                        <div class="product_desc_info">
                                            <div class="product-review">
                                                <h5 class="manufacturer">
                                                    <a href="product-details.html">Graphic Corner</a>
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
                                            <h4><a class="product_name" href="single-product.html">Accusantium dolorem1</a></h4>
                                            <div class="price-box">
                                                <span class="new-price">$46.80</span>
                                            </div>
                                        </div>
                                        <div class="add-actions">
                                            <ul class="add-actions-link">
                                                <li class="add-cart active"><a href="#">Add to cart</a></li>
                                                <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
                                                <li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- single-product-wrap end -->
                            </div>
                            <div class="col-lg-12">
                                <!-- single-product-wrap start -->
                                <div class="single-product-wrap">
                                    <div class="product-image">
                                        <a href="single-product.html">
                                            <img src="{{asset('user/images/product/large-size/6.jpg')}}" alt="Li's Product Image">
                                        </a>
                                        <span class="sticker">New</span>
                                    </div>
                                    <div class="product_desc">
                                        <div class="product_desc_info">
                                            <div class="product-review">
                                                <h5 class="manufacturer">
                                                    <a href="product-details.html">Studio Design</a>
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
                                            <h4><a class="product_name" href="single-product.html">Mug Today is a good day</a></h4>
                                            <div class="price-box">
                                                <span class="new-price new-price-2">$71.80</span>
                                                <span class="old-price">$77.22</span>
                                                <span class="discount-percentage">-7%</span>
                                            </div>
                                        </div>
                                        <div class="add-actions">
                                            <ul class="add-actions-link">
                                                <li class="add-cart active"><a href="#">Add to cart</a></li>
                                                <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
                                                <li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- single-product-wrap end -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Li's Section Area End Here -->
            </div>
        </div>
    </section>
    <!-- Li's Laptop Product Area End Here -->
    
    <!-- Begin Quick View | Modal Area -->
    <div class="modal fade modal-wrapper" id="exampleModalCenter" >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-inner-area row">
                        <div class="col-lg-5 col-md-6 col-sm-6">
                            <!-- Product Details Left -->
                            <div class="product-details-left">
                                <div class="product-details-images slider-navigation-1">
                                    <div class="lg-image">
                                        <img src="{{asset('user/images/product/large-size/1.jpg')}}" alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="{{asset('user/images/product/large-size/2.jpg')}}" alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="{{asset('user/images/product/large-size/3.jpg')}}" alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="{{asset('user/images/product/large-size/4.jpg')}}" alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="{{asset('user/images/product/large-size/5.jpg')}}" alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="{{asset('user/images/product/large-size/6.jpg')}}" alt="product image">
                                    </div>
                                </div>
                                <div class="product-details-thumbs slider-thumbs-1">
                                    <div class="sm-image"><img src="{{asset('user/images/product/small-size/1.jpg')}}" alt="product image thumb"></div>
                                    <div class="sm-image"><img src="{{asset('user/images/product/small-size/2.jpg')}}" alt="product image thumb"></div>
                                    <div class="sm-image"><img src="{{asset('user/images/product/small-size/3.jpg')}}" alt="product image thumb"></div>
                                    <div class="sm-image"><img src="{{asset('user/images/product/small-size/4.jpg')}}" alt="product image thumb"></div>
                                    <div class="sm-image"><img src="{{asset('user/images/product/small-size/5.jpg')}}" alt="product image thumb"></div>
                                    <div class="sm-image"><img src="{{asset('user/images/product/small-size/6.jpg')}}" alt="product image thumb"></div>
                                </div>
                            </div>
                            <!--// Product Details Left -->
                        </div>

                        <div class="col-lg-7 col-md-6 col-sm-6">
                            <div class="product-details-view-content pt-60">
                                <div class="product-info">
                                    <h2>Today is a good day Framed poster</h2>
                                    <span class="product-details-ref">Reference: demo_15</span>
                                    <div class="rating-box pt-20">
                                        <ul class="rating rating-with-review-item">
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                            <li class="review-item"><a href="#">Read Review</a></li>
                                            <li class="review-item"><a href="#">Write Review</a></li>
                                        </ul>
                                    </div>
                                    <div class="price-box pt-20">
                                        <span class="new-price new-price-2">$57.98</span>
                                    </div>
                                    <div class="product-desc">
                                        <p>
                                            <span>100% cotton double printed dress. Black and white striped top and orange high waisted skater skirt bottom. Lorem ipsum dolor sit amet, consectetur adipisicing elit. quibusdam corporis, earum facilis et nostrum dolorum accusamus similique eveniet quia pariatur.
                                            </span>
                                        </p>
                                    </div>
                                    <div class="product-variants">
                                        <div class="produt-variants-size">
                                            <label>Dimension</label>
                                            <select class="nice-select">
                                                <option value="1" title="S" selected="selected">40x60cm</option>
                                                <option value="2" title="M">60x90cm</option>
                                                <option value="3" title="L">80x120cm</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="single-add-to-cart">
                                        <form action="#" class="cart-quantity">
                                            <div class="quantity">
                                                <label>Quantity</label>
                                                <div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box" value="1" type="text">
                                                    <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                    <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                                </div>
                                            </div>
                                            <button class="add-to-cart" type="submit">Add to cart</button>
                                        </form>
                                    </div>
                                    <div class="product-additional-info pt-25">
                                        <a class="wishlist-btn" href="wishlist.html"><i class="fa fa-heart-o"></i>Add to wishlist</a>
                                        <div class="product-social-sharing pt-25">
                                            <ul>
                                                <li class="facebook"><a href="#"><i class="fa fa-facebook"></i>Facebook</a></li>
                                                <li class="twitter"><a href="#"><i class="fa fa-twitter"></i>Twitter</a></li>
                                                <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i>Google +</a></li>
                                                <li class="instagram"><a href="#"><i class="fa fa-instagram"></i>Instagram</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>   
    <!-- Quick View | Modal Area End Here -->
@endsection

@section('footer')
    <script>   
        
        function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                // Hiển thị ảnh mới trong thẻ div#imagePreview
                document.getElementById('imagePreview').style.backgroundImage = 'url(' + e.target.result + ')';
            }
            reader.readAsDataURL(input.files[0]); // Đọc file ảnh mới

            // Gửi ảnh lên server thông qua AJAX
            var formData = new FormData();
            formData.append('thumb', input.files[0]); // Đính kèm file ảnh đã chọn

            // Gọi AJAX để upload ảnh
        fetch('{{ route("upload.services") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log('Thành công:', data); // Hiển thị kết quả thành công

                // Kiểm tra xem phản hồi có chứa thông tin thành công không
                if (data.success) {
                  // Cập nhật giao diện để hiển thị ảnh
                    const imageUrl = '/storage/' + data.filePath; // Đường dẫn ảnh
                    console.log(data.filePath);

                    // Cập nhật background-image của div#imagePreview
                    document.getElementById('imagePreview').style.backgroundImage = 'url(' + imageUrl + ')';

                    // Cập nhật giá trị của input ẩn
                    document.getElementById('thumb').value = data.thumb;
                    console.log('Thành công:', data.thumb);

                }
            })
            .catch((error) => {
                console.error('Lỗi:', error);
            });

        }
    }
    
    </script>
@endsection
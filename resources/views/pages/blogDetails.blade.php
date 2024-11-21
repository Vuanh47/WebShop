@extends('main')

@section('content')
<!-- Begin Li's Main Blog Page Area -->
<div class="li-main-blog-page pt-60 pb-55">
    <div class="container">
        <div class="row">
            <!-- Begin Li's Main Content Area -->
            <div class="col-lg-12">
                <div class="row li-main-content">

                    <!-- Begin Product Section -->
                    <div class="col-12 mb-5">
                        <h4>Danh sách sản phẩm và blog tương ứng</h4>
                        <div class="row">
                            @foreach ($products as $product)
                                <!-- Bắt đầu ô sản phẩm -->
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="product-section card">
                                        <div class="card-body">
                                            <a href="/storage/uploads/{{ $product->thumb }}">
                                                <img src="/storage/uploads/{{ $product->thumb }}" class="img-fluid mb-3" alt="{{ $product->name }}">
                                            </a>
                                            <h5 class="card-title">{{ $product->name }}</h5> <!-- Tên sản phẩm -->
                                            <p class="card-text">{{ $product->description }}</p> <!-- Mô tả sản phẩm (nếu có) -->

                                            <!-- Danh sách blog tương ứng với sản phẩm -->
                                            <div class="blogs-for-product">
                                                @if($product->blogs->isEmpty())
                                                    <p>Không có blog nào cho sản phẩm này.</p>
                                                @else
                                                    @foreach ($product->blogs as $blog)
                                                        <div class="li-blog-single-item mb-3">
                                                            <div class="li-blog-banner">
                                                                <a href="{{ route('blog.details', $blog->id) }}">
                                                                <a href="/storage/uploads/{{ $blog->thumb }}"><img src="/storage/uploads/{{ $blog->thumb }}" width="100px"></a>
                                                                </a>
                                                            </div>
                                                            <div class="li-blog-content">
                                                                <h6 class="li-blog-heading pt-2">
                                                                    <a href="{{ route('blog.details', $blog->id) }}">{{ $blog->title }}</a>
                                                                </h6>
                                                                <div class="li-blog-meta small text-muted">
                                                                    <i class="fa fa-user"></i> {{ $blog->customer ? $blog->customer->name : 'Unknown Customer' }}
                                                                    <i class="fa fa-comment-o ml-3"></i> {{ $blog->comments_count }} bình luận
                                                                    <i class="fa fa-calendar ml-3"></i> {{ $blog->created_at->format('d M Y') }}
                                                                </div>
                                                                <p>{{ Str::limit($blog->content, 50) }}</p>
                                                                <a class="read-more" href="{{ route('blog.details', $blog->id) }}">Đọc thêm...</a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Kết thúc ô sản phẩm -->
                            @endforeach
                        </div>
                    </div>
                    <!-- End Product Section -->

                    <!-- Begin General Blog Section -->
                    <div class="col-12">
                        <h4>Các blog khác</h4>
                        <div class="row">
                            @foreach ($blogs as $blog)
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="li-blog-single-item card">
                                        <div class="li-blog-banner card-img-top">
                                            <a href="{{ route('blog.details', $blog->id) }}">
                                                <img class="img-fluid" src="{{ asset('storage/uploads/' . $blog->thumb . '.jpg') }}" alt="">
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <a href="{{ route('blog.details', $blog->id) }}">{{ $blog->title }}</a>
                                            </h5>
                                            <div class="li-blog-meta small text-muted">
                                                <i class="fa fa-user"></i> {{ $blog->customer ? $blog->customer->name : 'Unknown Customer' }}
                                                <i class="fa fa-comment-o ml-3"></i> {{ $blog->comments_count }} bình luận
                                                <i class="fa fa-calendar ml-3"></i> {{ $blog->created_at->format('d M Y') }}
                                            </div>
                                            <p>{{ Str::limit($blog->content, 50) }}</p>
                                            <a class="read-more" href="{{ route('blog.details', $blog->id) }}">Đọc thêm...</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- End General Blog Section -->

                    <!-- Begin Pagination Area -->
                    <div class="col-lg-12">
                        <div class="li-paginatoin-area text-center pt-25">
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="li-pagination-box">
                                        <li><a class="Previous" href="#">Previous</a></li>
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a class="Next" href="#">Next</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Pagination End Here -->
                </div>
            </div>
            <!-- Li's Main Content Area End Here -->
        </div>
    </div>
</div>
<!-- Li's Main Blog Page Area End Here -->
@endsection

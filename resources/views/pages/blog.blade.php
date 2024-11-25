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
                        <h2 class="text-danger text-center mb-4">Danh sách sản phẩm và blog tương ứng</h2>
                        <div class="row">
                            @foreach ($products as $product)
                                <!-- Bắt đầu ô sản phẩm -->
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <a href="{{ route('blog.detail', $product->id) }}" class="product-section card" style="text-decoration: none; color: inherit;">
                                        <div class="card-body">
                                            <!-- Ảnh sản phẩm -->
                                            <img src="/storage/uploads/{{ $product->thumb }}" class="img-fluid mb-3" alt="{{ $product->name }}" width="300" height="300">
                                            
                                            <!-- Tên sản phẩm -->
                                            <h5 class="card-title text-primary">{{ $product->name }}</h5>
                                            
                                            <!-- Mô tả sản phẩm -->
                                            <p class="card-text">{{ $product->description }}</p>
                                        </div>

                                        <!-- footer cart -->
                                        <div class="card-body" style="font-size: 16px; padding: 20px;">
                                            @php
                                                $averageRating = $product->blogs->avg('star');
                                                $rating = $averageRating > 0 ? $averageRating : 0;
                                            @endphp

                                            <ul class="rating">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <li>
                                                        @if ($rating >= $i)
                                                            <i class="fa fa-star"></i>
                                                        @elseif ($rating >= $i - 0.5 && $rating < $i)
                                                            <i class="fa fa-star-half-o"></i>
                                                        @else
                                                            <i class="fa fa-star-o"></i>
                                                        @endif
                                                    </li>
                                                @endfor
                                            </ul>

                                            @if ($product->blogs->isNotEmpty())
                                                @php
                                                    $latestBlog = $product->blogs->sortByDesc('created_at')->first();
                                                @endphp

                                                <div class="li-blog-meta small text-muted" style="font-size: 16px;">
                                                    <i class="fa fa-user"></i> {{ $product->blogs->count() > 0 ? $product->blogs->count() : '0' }}
                                                    <i class="fa fa-comment-o ml-3"></i> {{ $latestBlog->customer ? $latestBlog->customer->name : 'Unknown' }} 
                                                    <i class="fa fa-calendar ml-3"></i> {{ $latestBlog ? $latestBlog->created_at->format('d/m/Y') : 'N/A' }}
                                                </div>
                                                <p class="read-more" style="font-size: 16px;">Đọc thêm...</p>
                                            @else
                                                <div class="li-blog-meta small text-muted" style="font-size: 16px;">
                                                    <i class="fa fa-user"></i> 0
                                                    <i class="fa fa-comment-o ml-3"></i> 0 bình luận
                                                    <i class="fa fa-calendar ml-3"></i> N/A
                                                </div>
                                                <p>Chưa có bài viết cho sản phẩm này.</p>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- End Product Section -->

                </div>
            </div>
            <!-- Li's Main Content Area End Here -->
        </div>
    </div>
</div>
<!-- Li's Main Blog Page Area End Here -->
@endsection



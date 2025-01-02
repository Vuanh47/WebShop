@extends('main')

@section('content')
<!-- Begin Blog Detail Page -->
<div class="blog-detail-page  pb-55">
    <div class="container">
        <div class="row">
            <!-- Begin Blog Content Area -->
            <div class="col-lg-12">
                <!-- Product Information -->
                <div class="product-info mb-5">
                    <div class="row">
                        <!-- Product Image -->
                        <div class="col-md-4">
                            <img src="/storage/uploads/{{ $product->thumb }}" class="img-fluid" alt="{{ $product->name }}">
                        </div>
                        <!-- Product Details -->
                        <div class="col-md-8 pt-80">
                            <h3 class="text-primary"><a href="{{route('details', $product->id)}}">{{ $product->name }}</a></h3>
                            <p class="text-muted">{{ $product->description }}</p>
                            <p>
                                <span>{!! $product->content !!}</span>
                            </p>

                            <div class="rating mt-4">
                                @php
                                $averageRating = $product->blogs->avg('star');
                                $rating = $averageRating > 0 ? $averageRating : 0;
                                @endphp
                                <!-- Display Rating Stars -->
                                @for ($i = 1; $i <= 5; $i++)
                                    <li>
                                    @if ($rating >= $i)
                                    <i class="fa fa-star text-warning"></i>
                                    @elseif ($rating >= $i - 0.5 && $rating < $i)
                                        <i class="fa fa-star-half"></i>
                                        @else
                                        <i class="far fa-star" style="color:rgb(243, 196, 25);"></i>
                                        @endif
                                        </li>
                                        @endfor
                                        <span class="ml-2 text-muted">({{ $product->blogs->count() }} reviews)</span>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Blogs Section -->
                <!-- Blogs Section -->
                <div class="blogs-section mt-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mt-2 text-danger">Related Blog Posts</h4>
                       
                    </div>

                    <div class="container mt-5">
                        <!-- Phần Viết Bình Luận -->
                        <div class="review-input-section mb-4 pt-4">
                            <form action="{{route('comment.add')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- Button và Chọn Rating -->
                                <div class="d-flex align-items-center mb-4">
                                    <button class="btn-review" type="submit">Write Review</button>
                                    <span class="me-2 ms-3">Overall Rating*</span>
                                    <select class="star-rating" name="star" style="color: yellow; font-size: 16px;" required>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <span class="rating-text ms-2">
                                        Good! <i class="fas fa-check-circle"></i>
                                    </span>
                                </div>

                                <!-- Input Bình Luận và Hình Ảnh -->
                                <div class="mb-3">
                                    <div class="input-group">
                                        <!-- Input với Nút Chọn Hình -->
                                        <div class="input-with-image">
                                            <input class="form-control review-input" type="text" placeholder="Write your review here, e.g., 'Great! This is amazing'" name="content" required />

                                            <!-- Nút Chọn Hình -->
                                            <label for="imageInput" class="image-upload-label">
                                                <i class="fas fa-camera"></i> Image
                                                <input type="file" class="form-control-file" accept="image/*" id="imageInput" onchange="previewImage(this)" />
                                            </label>

                                            <input type="hidden" name="thumb" id="thumb">
                                            <input type="hidden" name="customer_id" value="{{$customer->id}}">
                                            <input type="hidden" name="product_id" value="{{$product->id}}">


                                            <!-- Preview Hình Ảnh -->
                                            <div class="avatar-preview">
                                                <div id="imagePreview" style="background-image: url('{{ $imageUrl }}'); width: 100px; height: 100px; background-size: cover; background-position: center; margin-left: 10px"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Phần Danh Sách Bình Luận -->
                        <div class="reviews-list mt-5">
                            @foreach ($blogs as $blog)
                            <div class="review-item d-flex align-items-start mb-4">
                                <!-- Avatar Người Dùng -->
                                <img
                                    src="{{ $blog->customer->avatar ? asset('storage/uploads/' . $blog->customer->avatar) : asset('storage/uploads/50.png') }}"
                                    alt="Reviewer Profile"
                                    class="rounded-circle me-3"
                                    width="50"
                                    height="50" />
                                <div class="review-content">
                                    <!-- Header của Bình Luận -->
                                    <div class="review-header d-flex align-items-center mb-2">
                                        <!-- Rating Stars -->
                                        <span class="rating-stars me-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <span> <!-- Thay li bằng span -->
                                                @if ($blog->star >= $i)
                                                <i class="fa fa-star text-warning"></i> <!-- Full star -->
                                                @elseif ($blog->star >= $i - 0.5 && $blog->star < $i)
                                                    <i class="fa fa-star-half"></i> <!-- Half star -->
                                                    @else
                                                    <i class="far fa-star" style="color:rgb(243, 196, 25);"></i> <!-- Empty star -->
                                                    @endif
                                        </span>
                                        @endfor
                                        </span>
                                        <span class="name fw-bold m-2">{{ $blog->customer->name }}</span>
                                        <span class="time text-muted">{{ $blog->created_at->format('H:i, d/m/Y') }}</span>
                                    </div>

                                    <!-- Nội Dung Bình Luận -->
                                    <div class="review-text mb-2">
                                        {{ $blog->content }}
                                    </div>
                                    @if ($blog->thumb)
                                    <img style="margin: 5px;"
                                        src="{{ asset('storage/uploads/' . $blog->thumb) }}"
                                        width="75"
                                        height="75" />
                                    @endif


                                    <!-- Các Hành Động Của Bình Luận -->
                                    <div class="review-actions">
                                        <a href="#" class="me-3">Like</a>
                                        <a href="#" class="me-3">Dislike</a>
                                        <a href="#">Reply</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Blog Content Area End Here -->
                </div>
            </div>
        </div>
        <!-- Blog Detail Page End Here -->
        @endsection
        @section('footer')
        <script>
            function previewImage(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
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
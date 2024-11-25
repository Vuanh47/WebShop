@extends('main')

@section('content')
<!-- Begin Blog Detail Page -->
<div class="blog-detail-page pt-60 pb-55">
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
                        <div class="col-md-8">
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
                                    @if ($rating >= $i)
                                        <i class="fa fa-star text-warning"></i>
                                    @elseif ($rating >= $i - 0.5)
                                        <i class="fa fa-star-half-o text-warning"></i>
                                    @else
                                        <i class="fa fa-star-o text-muted"></i>
                                    @endif
                                @endfor
                                <span class="ml-2 text-muted">({{ $product->blogs->count() }} reviews)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for Writing Review -->
                <div class="modal fade modal-wrapper" id="mymodal">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h3 class="review-page-title ">Write Your Review</h3>
                                <div class="modal-inner-area row">
                                    <div class="col-lg-6">
                                        <div class="li-review-product">
                                            <img src="/storage/uploads/{{ $product->thumb }}" width="300" class="img-fluid" alt="{{ $product->name }}">

                                            <div class="li-review-product-desc">
                                                <p class="li-product-name text-dark">{{ $product->name }}</p>
                                                <p>
                                                    <span>{{ $product->description }}</span>
                                                </p>
                                                <p>
                                                    <span>{!! $product->content !!}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="li-review-content">
                                            <!-- Begin Feedback Area -->
                                            <div class="feedback-area">
                                                <div class="feedback">
                                                    <h3 class="feedback-title text-danger">Your Feedback</h3>
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
                                                                    <label for="thumb" class="form-label">Choose Image</label>
                                                                    <div class="mb-3">
                                                                        <input type="file" id="imageUpload" name="thumb_path" accept=".png, .jpg, .jpeg" onchange="previewImage(this)">
                                                                    </div>

                                                                    <!-- Hidden field to store image path -->
                                                                    <input type="hidden" name="thumb" id="thumb">

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

                <!-- Blogs Section -->
            <!-- Blogs Section -->
            <div class="blogs-section mt-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mt-2 text-danger">Related Blog Posts</h4>
                    <div class="review-btn">
                        <a class="review-links " href="#" data-toggle="modal" data-target="#mymodal">Write Your Review!</a>
                    </div>
                </div>
                
                @if ($blogs->isNotEmpty())
                    <div class="product-details-comment-block">
                        @foreach ($blogs as $blog)
                            <div class="comment-review p-3 border rounded shadow-sm">
                                <div class="comment-header d-flex justify-content-between align-items-center">
                                    <!-- Rating Stars -->
                                    <ul class="rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <li>
                                                <i class="fa fa-star{{ $blog->star >= $i ? '' : '-o' }}"></i>
                                            </li>
                                        @endfor
                                    </ul>
                                    <span class="comment-date text-muted">{{ \Carbon\Carbon::parse($blog->created_at)->format('H:i, d/m/Y') }}</span>
                                </div>

                                <!-- User Info: Avatar and Name -->
                                <div class="comment-header d-flex align-items-center">
                                    <div class="comment-avatar">
                                        <img src="{{ $blog->customer->avatar ? asset('storage/' . $blog->customer->avatar) : 'https://via.placeholder.com/60' }}" alt="Avatar of {{ $blog->customer->name }}" class="img-fluid rounded-circle" />
                                    </div>
                                    <strong class="comment-author ml-3">{{ $blog->customer->name }}</strong>
                                </div>

                                <!-- Comment Content -->
                                <div class="comment-body mt-3">
                                    <h4 class="comment-title text-primary">Product Review</h4>
                                    <p class="comment-content">{{ $blog->content }}</p>
                                </div>

                                <!-- Product Image from Comment (if available) -->
                                @if ($blog->thumb)
                                    <div class="comment-image mt-3">
                                        <a href="/storage/uploads/{{ $product->thumb }}">
                                            <img src="/storage/uploads/{{ $blog->thumb }}" width="100px" class="img-fluid" />
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination Links -->
                    <div class="pagination-links mt-4 d-flex justify-content-end">
                        {{ $blogs->links() }} <!-- Hiển thị phân trang -->
                    </div>


                @else
                    <p>Currently, there are no blog posts related to this product.</p>
                @endif
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
            reader.onload = function (e) {
                // Show new image in the div#imagePreview
                document.getElementById('imagePreview').style.backgroundImage = 'url(' + e.target.result + ')';
            }
            reader.readAsDataURL(input.files[0]); // Read the selected image file

            // Send image to server via AJAX
            var formData = new FormData();
            formData.append('thumb', input.files[0]); // Attach the selected file

            // AJAX call to upload image
        fetch('{{ route("upload.services") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data); // Display success result

                // If the response contains a success message
                if (data.success) {
                  // Update the interface to show the image
                    const imageUrl = '/storage/' + data.filePath; // Image path
                    console.log(data.filePath);

                    // Update the background-image of div#imagePreview
                    document.getElementById('imagePreview').style.backgroundImage = 'url(' + imageUrl + ')';

                    // Update the value of hidden input
                    document.getElementById('thumb').value = data.thumb;
                    console.log('Success:', data.thumb);

                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });

        }
    }
    
    </script>
@endsection

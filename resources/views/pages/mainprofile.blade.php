<!doctype html>
<html class="no-js" lang="zxx">

<!-- 40432:14-->
@include('header')

<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <!-- Begin Body Wrapper -->
    <div class="body-wrapper">
        <div class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="{{ route('index') }}">Home</a></li>
                        <li class="active"><a href="{{route('profile')}}"></a>{{ $title }}</li> <!-- Sử dụng biến $title -->
                    </ul>
                </div>
            </div>
        </div>
        <!-- Begin Header Area -->
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-3 profile-sidebar">
                    <div class="text-center mb-4">
                        <img id="Image" src="https://placehold.co/100x100" alt="Profile image" class="img-fluid rounded-circle" style="width: 100px; height: 100px;">
                        <p class="mt-2">{{$customer->name}}</p>
                        <a href="#" class="text-decoration-none"><i class="fas fa-pencil-alt"></i> Edit Profile</a>
                    </div>
                    <nav class="nav flex-column">
                        <!-- My Account with sub-items -->
                        <ul class="ms-3">
                            <li><a class="nav-link" href="{{route('profile')}}"><i class="fas fa-id-card"></i> Profile</a></li>
                            <li><a class="nav-link" href="{{route('address')}}"><i class="fas fa-map-marker-alt"></i> Address</a></li>
                            <li><a class="nav-link" href="{{route('changePassword_profile')}}"><i class="fas fa-lock"></i> Change Password</a></li>
                        </ul>

                        <!-- Other navigation items -->
                        <a class="nav-link" href="{{route('my_order')}}"><i class="fas fa-shopping-cart"></i> Orders</a>
                        <a class="nav-link" href="#"><i class="fas fa-bell"></i> Notifications</a>
                        <a class="nav-link" href="#"><i class="fas fa-ticket-alt"></i> Voucher Store</a>
                    </nav>
                </div>
                @yield('content_profile')
            </div>
        </div>
        <!-- Header Area End Here -->

        <!-- Begin Footer Area -->

    </div>
    <!-- Body Wrapper End Here -->
    <!-- jQuery-V1.12.4 -->
    @include('footer')
</body>
<script>
    window.onload = function() {
        var profileImage = document.getElementById('Image');

        // Lấy dữ liệu từ Laravel, cần đảm bảo dữ liệu được chuyển đúng cách
        var imageUrl = "{{ $customer->avatar ? '/storage/uploads/' . $customer->avatar : '' }}"; // Kiểm tra nếu có avatar

        // Nếu có đường dẫn ảnh, sử dụng nó, ngược lại hiển thị ảnh mặc định
        if (imageUrl) {
            profileImage.src = imageUrl;
        } else {
            profileImage.src = "https://placehold.co/100x100"; // Hình ảnh mặc định
        }
    };
</script>

</html>
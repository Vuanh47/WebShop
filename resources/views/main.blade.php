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
                            <li class="active">{{ $title }}</li> <!-- Sử dụng biến $title -->
                        </ul>
                    </div>
                </div>
            </div>
                    <!-- Begin Header Area -->

            <!-- Header Area End Here -->
            @yield('content')


            <!-- Begin Footer Area -->
        
        </div>
        <!-- Body Wrapper End Here -->
        <!-- jQuery-V1.12.4 -->
        @include('footer')
    </body>

<!-- 40432:14-->
</html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{$title}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('user/css/font-awesome.css')}}" />
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="{{asset('user/css/libs.css')}}">
    <!-- SweetAlert JS -->
    <script src="{{asset('user/js/libs.js')}}"></script>

    <link rel="shortcut icon" type="image/x-icon" href="{{asset('user/images/favicon.png')}}">
    <!-- Material Design Iconic Font-V2.2.0 -->
    <link rel="stylesheet" href="{{asset('user/css/material-design-iconic-font.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('user/css/font-awesome.min.css')}}">
    <!-- Font Awesome Stars-->
    <link rel="stylesheet" href="{{asset('user/css/fontawesome-stars.css')}}">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="{{asset('user/css/meanmenu.css')}}">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{asset('user/css/owl.carousel.min.css')}}">
    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" href="{{asset('user/css/slick.css')}}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('user/css/animate.css')}}">
    <!-- Jquery-ui CSS -->
    <link rel="stylesheet" href="{{asset('user/css/jquery-ui.min.css')}}">
    <!-- Venobox CSS -->
    <link rel="stylesheet" href="{{asset('user/css/venobox.css')}}">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{asset('user/css/nice-select.css')}}">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="{{asset('user/css/magnific-popup.css')}}">
    <!-- Bootstrap V4.1.3 Fremwork CSS -->
    <link rel="stylesheet" href="{{asset('user/css/bootstrap.min.css')}}">
    <!-- Helper CSS -->
    <link rel="stylesheet" href="{{asset('user/css/helper.css')}}">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{asset('user/style.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('user/css/responsive.css')}}">
    <!-- Modernizr js -->
    <link rel="stylesheet" href="{{asset('user/css/slider.css')}}">
    <link rel="stylesheet" href="{{asset('user/css/font-awesome.min.css')}}">
    <!-- Thêm CDN Font Awesome -->
    <link rel="stylesheet" href="{{asset('user/css/all.min.css')}}">

    <script src="{{asset('user/js/vendor/modernizr-2.8.3.min.js')}}"></script>

    @yield('head')
</head>
<header class="li-header-4">
    <!-- Begin Header Top Area -->
    <div class="header-top">
        <div class="container">
            <div class="row">
                <!-- Begin Header Top Left Area -->
                <div class="col-lg-3 col-md-4">
                    <div class="header-top-left">
                        <ul class="phone-wrap">
                            <li><span>Email: </span><a href="#">daovuanh2207@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Header Top Left Area End Here -->
                <!-- Begin Header Top Right Area -->
                <div class="col-lg-9 col-md-8">
                    <div class="header-top-right">
                        <ul class="ht-menu">
                            <!-- Begin Language Area -->
                            <li>
                                <div class="ht-language-trigger"><span>Language</span></div>
                                <div class="language ht-language">
                                    <ul class="ht-setting-list">
                                        <div id="google_translate_element"></div>
                                        <script type="text/javascript">
                                            function googleTranslateElementInit() {
                                                new google.translate.TranslateElement({
                                                    pageLanguage: 'en'
                                                }, 'google_translate_element');
                                            }
                                        </script>
                                        <script type="text/javascript" src="{{asset('user/js/libggdich.js')}}"></script>
                                    </ul>
                                </div>
                            </li>
                            <!-- Language Area End Here -->
                            <div class="login">
                                @if(session()->has('customerName'))
                                <a href="{{route('profile',session('customerID'))}}" class="user-name" style="display: flex; align-items: center;">
                                    </i>
                                    <span style="margin-left: 5px;">{{$customer->name}}</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="margin-left: 10px;">
                                    @csrf
                                    <button type="submit" class="logout-button">Logout</button>
                                </form>
                                @else
                                <a href="{{ route('login') }}" class="login-button">Login</a>
                                @endif
                            </div>



                        </ul>
                    </div>
                </div>
                <!-- Header Top Right Area End Here -->
            </div>
        </div>
    </div>
    <!-- Begin Header Middle Area -->
    <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
        <div class="container">
            <div class="row">
                <!-- Begin Header Logo Area -->
                <div class="col-lg-3">
                    <div class="logo pb-sm-30 pb-xs-30">
                        <a href="/index.php">
                            <img style="width: 80px;" src="{{asset('user/images/logoWeb-removebg-preview.png')}}" alt="">
                        </a>
                    </div>
                </div>
                <!-- Header Logo Area End Here -->
                <!-- Begin Header Middle Right Area -->
                <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                    <!-- Begin Header Middle Searchbox Area -->
                    <form action="{{ route('search') }}" method="GET" class="hm-searchbox">

                        <select name="menu_id" class="nice-select select-search-category">
                            <option value="0">All</option>
                            @foreach ($menus as $menu)
                            <option value="{{$menu->id}}">{{$menu->name}}</option> <!-- Sử dụng $menu->id -->
                            @endforeach
                        </select>

                        <input type="text" name="query" placeholder="Enter your search key ...">
                        <button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                    <!-- Header Middle Searchbox Area End Here -->
                    <!-- Begin Header Middle Right Area -->
                    <div class="header-middle-right">
                        <ul class="hm-menu">
                            <!-- Begin Header Middle Wishlist Area -->
                            <li class="hm-wishlist">
                                <a href="{{route('wishlist')}}">
                                    <span class="cart-item-count wishlist-item-count">{{$count}}</span>
                                    <i class="fas fa-heart"></i> <!-- Trái tim đầy -->

                                </a>
                            </li>
                            <!-- Header Middle Wishlist Area End Here -->
                            <!-- Begin Header Mini Cart Area -->
                            <li class="hm-minicart">
                                <div class="hm-minicart-trigger">
                                    <span class="item-icon"></span>
                                    <span class="item-text">{{ formatCurrency($total)}}
                                        <span class="cart-item-count">{{$count_cart}}</span>
                                    </span>
                                </div>
                                <span></span>
                                <div class="minicart">
                                    <ul class="minicart-product-list">
                                        <ul>
                                            @foreach ($carts as $cart)
                                            <li>
                                                <a href="" class="minicart-product-image">
                                                    <img src="{{ asset('storage/uploads/' . $cart->thumb) }}" alt="cart products" width="55" height="55">
                                                </a>
                                                <div class="minicart-product-details">
                                                    <h6><a href="{{route('details',$cart->product_id)}}">{{ $cart->name }}</a></h6>
                                                    <span>{{ formatCurrency($cart->price)}} x {{ $cart->quantity }}</span>
                                                </div>
                                                <form action="{{ route('cart.delete', $cart->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="close" style="border: none; background: none; cursor: pointer;">
                                                        <i class="fa fa-close"></i>
                                                    </button>
                                                </form>
                                            </li>
                                            @endforeach
                                        </ul>

                                    </ul>
                                    <p class="minicart-total">SUBTOTAL: <span>{{ formatCurrency($total)}}</span></p>
                                    <div class="minicart-button">
                                        <a href="{{route('cart')}}" class="li-button li-button-dark li-button-fullwidth li-button-sm">
                                            <span>View Full Cart</span>
                                        </a>
                                        <a href="{{route('checkout')}}" class="li-button li-button-fullwidth li-button-sm">
                                            <span>Checkout</span>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <!-- Header Mini Cart Area End Here -->
                        </ul>
                    </div>
                    <!-- Header Middle Right Area End Here -->
                </div>
                <!-- Header Middle Right Area End Here -->
            </div>
        </div>
    </div>
    <!-- Header Middle Area End Here -->
    <!-- Begin Header Bottom Area -->
    <div class="header-bottom header-sticky stick d-none d-lg-block d-xl-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-center align-items-center">
                    <!-- Begin Header Bottom Menu Area -->
                    <div class="hb-menu">
                        <nav>
                            <ul>
                                <li><a href="{{ route('index') }}">Home</a></li>
                                <li><a href="{{ route('shop') }}">Shop</a></li>
                                <li><a href="{{ route('blog') }}">Blog</a></li>
                                <li><a href="{{route('cart')}}">Shopping Cart</a></li>
                                <li><a href="{{ route('order_history') }}">Order History</a></li>
                                <li><a href="{{ route('about') }}">About Us</a></li>
                                <li><a href="{{ route('contact') }}">Contact</a></li>




                            </ul>
                        </nav>
                    </div>
                    <!-- Header Bottom Menu Area End Here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Header Bottom Area End Here -->
    <!-- Begin Mobile Menu Area -->
    <div class="mobile-menu-area mobile-menu-area-4 d-lg-none d-xl-none col-12">
        <div class="container">
            <div class="row">
                <div class="mobile-menu">
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu Area End Here -->
</header>
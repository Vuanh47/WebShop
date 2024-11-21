<div class="slider-with-banner">
                <div class="container">
                    <div class="row">
                        <!-- Begin Slider Area -->
                        <div class="col-lg-8 col-md-8">
                            <div class="slider-area pt-sm-30 pt-xs-30">
                                <div class="slider-active owl-carousel">
                                @foreach ($sliders as $slider)
                                <div class="single-slide align-center-left animation-style-01 slider-shadow" style="background-image: url('storage/uploads/{{ $slider->thumb }}');">
                                <div class="slider-progress"></div>
                                        <div class="slider-content">
                                            <h5>Sale Offer <span>-20% Off</span> This Week</h5>
                                            <h2>{{$slider->name}}</h2>
                                            <h3>Starting at <span>$1209.00</span></h3>
                                            <div class="default-btn slide-btn">
                                                <a class="links" href="shop-left-sidebar.html">Shopping Now</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                                </div>
                            </div>
                        </div>
                        <!-- Slider Area End Here -->
                        <!-- Begin Li Banner Area -->
                        <div class="col-lg-4 col-md-4 text-center pt-sm-30 pt-xs-30">
                            <div class="li-banner">
                                <a href="#">
                                    <img src="{{asset('user/images/banner/1_1.jpg')}}" alt="">
                                </a>
                            </div>
                            <div class="li-banner mt-15 mt-md-30 mt-xs-25 mb-xs-5">
                                <a href="#">
                                    <img src="{{asset('user/images/banner/1_2.jpg')}}" alt="">
                                </a>
                            </div>
                        </div>
                        <!-- Li Banner Area End Here -->
                    </div>
                </div>
            </div>
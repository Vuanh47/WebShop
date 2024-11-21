@extends('main')

@section('content')
    <!-- Begin Login Content Area -->
    <div class="page-section mb-60 d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-0" id="login-container">
                <!-- Login Form -->
                <form action="{{ route('store') }}" method="post" id="login">
                    @csrf
                    <div class="login-form">
                        <h4 class="login-title">Login</h4>
                        <!-- Login form fields here -->
                        <div class="row">
                            <div class="col-12 mb-20">
                                <label>Email Address*</label>
                                <input class="mb-0" type="email" name="email" placeholder="Email Address">
                            </div>
                            <div class="col-12 mb-20">
                                <label>Password</label>
                                <input class="mb-0" type="password" name="password" placeholder="Password">
                            </div>
                            <div class="col-md-6">
                                <div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                    <input type="checkbox" id="remember_me">
                                    <label for="remember_me">Remember me</label>
                                </div>
                            </div>
                            <div class="col-md-6 mt-10 mb-20 text-left text-md-right">
                                <a href="#">Forgotten password?</a><br>
                                <p style="display: inline;">New Shop? 
                                    <a href="#register" style="color: #0058ff;">Sign Up</a>
                                </p>
                            </div>
                        </div>
                        @include("admin.alert")
                        <div class="col-12" style="padding-bottom: 40px;">
                            <button class="register-button mt-0">Login</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30" id="register-container">
                <!-- Register Form -->
                <form action="{{ route('register') }}" method="post" id="register">
                    @csrf
                    <div class="login-form">
                        <h4 class="login-title">Register</h4>
                        <!-- Register form fields here -->
                        <div class="row">
                            <div class="col-md-12 col-12 mb-20">
                                <label>Username</label>
                                <input class="mb-0" type="text" name="name" placeholder="Enter Username">
                            </div>
                            <div class="col-md-12 mb-20">
                                <label>Email</label>
                                <input class="mb-0" type="email" name="email" placeholder="Email Address">
                            </div>
                            <div class="col-md-12 mb-20">
                                <label>Phone</label>
                                <input class="mb-0" type="text" name="phone" placeholder="Enter Phone Number">
                            </div>
                            <div class="col-md-12 mb-20">
                                <label>Address</label>
                                <input class="mb-0" type="text" name="address" placeholder="Enter Address">
                            </div>
                            <div class="col-md-6 mb-20">
                                <label>Password</label>
                                <input class="mb-0" type="password" name="password" placeholder="Password">
                            </div>
                            <div class="col-md-6 mb-20">
                                <label>Confirm Password</label>
                                <input class="mb-0" type="password" placeholder="Confirm Password">
                            </div>
                        </div>
                        @include("admin.alert")
                        <div class="col-md-12 text-right mt-5">
                            <a href="#login" style="color: #0058ff;">Login</a>
                        </div>
                        <div class="col-12">
                            <button class="register-button mt-0 mb-10">Register</button>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Login Content Area End Here -->
@endsection

@section('footer')
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('login');
    const registerForm = document.getElementById('register');
    const signUpLink = document.querySelector('a[href="#register"]');
    const loginLink = document.querySelector('a[href="#login"]');

    const loginContainer = document.getElementById('login-container');
    const registerContainer = document.getElementById('register-container');

    // Hide register form initially
    registerContainer.style.display = 'none';

    signUpLink.addEventListener('click', function(event) {
        event.preventDefault();
        loginContainer.style.display = 'none';
        registerContainer.style.display = 'block';
    });

    loginLink.addEventListener('click', function(event) {
        event.preventDefault();
        registerContainer.style.display = 'none';
        loginContainer.style.display = 'block';
    });
});

</script>
@endsection
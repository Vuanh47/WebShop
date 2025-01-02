@extends('main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-0" id="login-container">
            <!-- Login Form -->
            <form action="{{ route('confirmPassword') }}" method="post" id="changePassword">
                @csrf
                <div class="login-form">
                    <h4 class="login-title">Change password</h4>
                    <!-- Login form fields here -->
                    <div class="row">
                        <div class="col-12 mb-20">
                            <label>Email Address*</label>
                            <input class="mb-0" type="email" name="email" id="emailInput" value="{{$email}}" readonly>
                        </div>

                        <div class="col-12 mb-20">
                            <label>Username</label>
                            <input class="mb-0" type="text" name="name" value="{{$name}}" readonly>
                        </div>

                        <div class="col-12 mb-20">
                            <label>Password</label>
                            <input class="mb-0" type="password" name="password" placeholder="Password">
                        </div>

                        <div class="col-12 mb-20">
                            <label>Confirm Password</label>
                            <input class="mb-0" type="password" name="confirmPassword" placeholder="Enter Confirm Password">
                        </div>

                        <div class="col-md-6 mt-10 mb-20 text-left text-md-right" style="margin-left: auto;">
                            <p style="display: inline;">New Shop?
                                <a href="#register" style="color: #0058ff;">Sign Up</a>
                            </p>
                        </div>
                    </div>
                    @include("admin.alert")
                    <div class="col-12" style="padding-bottom: 40px;">
                        <button class="btn btn-dark confirm-button mt-0" type="submit">Confirm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('footer')
<script>
    document.getElementById('changePassword').addEventListener('submit', function(e) {
        const password = document.querySelector('input[name="password"]').value;
        const confirmPassword = document.querySelector('input[name="confirmPassword"]').value;

        if (password !== confirmPassword) {
            e.preventDefault(); 
            alert('Passwords do not match! Please try again.');
        }
    });
</script>
@endsection
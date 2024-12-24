@extends('main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-0" id="login-container">
            <!-- Login Form -->
            <form action="{{ route('verify.otp') }}" method="post" id="login">
                @csrf
                <div class="login-form">
                    <h4 class="login-title">Forget password</h4>
                    <!-- Login form fields here -->
                    <div class="row">
                        <div class="col-12 mb-20">
                            <label>Email Address*</label>
                            <input class="mb-0" type="email" name="email" placeholder="Email Address" id="emailInput">
                            <div style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
                                <button class="btn btn-primary mt-2" id="sendButton">Send</button>
                                <div id="countdown" style="display: none; color: red; margin-left:auto;"></div>
                            </div>
                        </div>

                        <div class="col-12 mb-20">
                            <label>Enter OTP</label>
                            <input class="mb-0" type="number" name="otp" placeholder="Enter OTP">
                        </div>

                        <div class="col-md-6 mt-10 mb-20 text-left text-md-right" style="margin-left: auto;">
                            <p style="display: inline;">New Shop?
                                <a href="{{route('login')}}" style="color: #0058ff;">Sign Up</a>
                            </p>
                        </div>
                    </div>
                    @include("admin.alert")
                    <div class="col-12" style="padding-bottom: 40px;">
                        <button class="btn btn-dark confirm-button mt-0">Confirm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('footer')
<script>
    document.getElementById('sendButton').addEventListener('click', function(e) {
        e.preventDefault();

        const emailInput = document.getElementById('emailInput').value;

        if (!emailInput) {
            alert('Please enter your email address');
            return;
        }


        fetch('/send-otp', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({
                    email: emailInput
                }),
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                startCountdown();
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });

    function startCountdown() {
        const countdownElement = document.getElementById('countdown');
        countdownElement.style.display = 'block';

        let timeLeft = 60; // Đếm ngược 60 giây
        const interval = setInterval(() => {
            countdownElement.textContent = `Please wait ${timeLeft} seconds before resending OTP.`;
            timeLeft--;

            if (timeLeft < 0) {
                clearInterval(interval);
                countdownElement.textContent = 'OTP has expired';
            }
        }, 1000);
    }
</script>
@endsection
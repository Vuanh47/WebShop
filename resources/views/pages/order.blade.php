@extends('main')

@section('content')
<div class="cart-container">
    <h2 class="mb-4 text-center">Order </h2>

    <!-- Display the items in the cart -->
    <table class="table table-bordered border-primary">
        <thead class="thead-dark">
            <tr>
                <th>Image</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carts as $item)
                <tr>
                    <td><img src="{{ asset('storage/uploads/' . $item['thumb']) }}" alt="{{ $item['name'] }}" class="cart-item-img"></td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ formatCurrency($item['price']) }}</td>
                    <td>{{ formatCurrency($item['total']) }}</td>
                 
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Display the order summary -->
    <div class="cart-summary m-4">
        <h3>Order Summary</h3>
        <ul class="list-group">
            <li class="list-group-item"><strong>Subtotal:</strong> {{ formatCurrency($subtotal) }}</li>
            <li class="list-group-item"><strong>Discount:</strong> 
                <span id="displayDiscount">
                    {{ $discount ? $discount : '0' }} 
                    @if(session('type') == 'percentage')
                        %
                    @else
                        VND
                    @endif
                </span>
            </li>
            <li class="list-group-item"><strong>Total:</strong> <span id="totalAmount">{{ formatCurrency($total) }}</span></li>
            </ul>
    </div>

    <div class="coupon-accordion">
    <h3>Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3>
        <div id="checkout_coupon" class="coupon-checkout-content">
            <div class="coupon-info">
                    <form action="{{ route('coupon') }}" method="post" id="coupon-form">
                        @csrf
                        <div class="coupon">
                            <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                            <input id="code" class="input-text" name="code" placeholder="Coupon code" type="text">
                            <input class="btn btn-dark" name="apply_coupon" value="Apply coupon" type="submit">
                        </div>
                    </form>
            </div>
        </div>
    </div>
    <br>
    <!-- Shipping information form -->
    <div class="customer-info m-4">
        <h3 class="m-3 text-center ">Shipping Information</h3>
        <form action="{{ route('order.add') }}" method="POST">
        @csrf
        
            <!-- Hidden inputs to send total, discount, and subtotal,customer_id -->
            <input type="hidden" name="totalValue" value="{{ $total }}">
            <input type="hidden" name="type" id="type" value="{{$type}}">
            <input type="hidden" name="discount" id="discountValue" value="{{$discount}}">
            <input type="hidden" name="subtotal" id="subtotal" value="{{$subtotal}}">
            <input type="hidden" name="customer_id" value="{{ session('customerID') }}">

            <div class="form-group row">
                <label for="recipient_name" class="col-md-2 col-form-label">
                    Recipient Name:<span class="text-danger">*</span>
                </label>
                <div class="col-md-4">
                    <input type="text" name="recipient_name" id="recipient_name" class="form-control" placeholder="Enter recipient's name" required>
                </div>

                <label for="email" class="col-md-2 col-form-label">
                    Email: <span class="text-danger">*</span>
                </label>
                <div class="col-md-4">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="phone_number" class="col-md-2 col-form-label">
                    Phone Number: <span class="text-danger">*</span>
                </label>
                <div class="col-md-4">
                    <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Enter your phone number" required>
                </div>

                <label for="payment_method" class="col-md-2 col-form-label">
                    Payment Method: <span class="text-danger">*</span>
                </label>
                <div class="col-md-4">
                    <select name="payment_method" id="payment_method" class="form-control" required>
                        <option value="" disabled selected>Select payment method</option>
                        <option value="credit_card">Credit Card</option>
                        <option value="paypal">PayPal</option>
                        <option value="cash_on_delivery">Cash on Delivery</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="shipping_address" class="col-md-2 col-form-label">
                    Shipping Address: <span class="text-danger">*</span>
                </label>
                <div class="col-md-10">
                    <textarea name="shipping_address" id="shipping_address" class="form-control" rows="3" placeholder="Enter your shipping address" required></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="order_notes" class="col-md-2 col-form-label">
                    Order Notes:
                </label>
                <div class="col-md-10">
                    <textarea name="order_notes" id="order_notes" class="form-control" rows="3" placeholder="Optional: Add any notes about your order"></textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-dark btn-block mt-3">Proceed to Checkout</button>
        </form>
        @include('admin.alert')
    </div>
</div>
@endsection

@section('footer')
<script>
     document.addEventListener('DOMContentLoaded', function () {
    // 1. Lấy form mã giảm giá
    const couponForm = document.querySelector('#coupon-form');

    // 2. Kiểm tra sự tồn tại của form
    if (couponForm) {
        // Lắng nghe sự kiện submit
        couponForm.addEventListener('submit', function (event) {
            event.preventDefault(); // Ngăn chặn hành vi mặc định
            applyCoupon(); // Gọi hàm xử lý mã giảm giá
        });
    } else {
        console.error('#coupon-form không tồn tại trong DOM');
    }

    // 3. Hàm xử lý mã giảm giá
    function applyCoupon() {
        const code = document.querySelector('#code').value.trim();
        const subtotal = document.querySelector('input[name="subtotal"]').value.trim(); // Lấy giá trị subtotal từ input hidden

        if (!code) {
            alert('Vui lòng nhập mã giảm giá.');
            return;
        }

        const formData = new FormData();
        formData.append('code', code);
        formData.append('subtotal', subtotal); // Thêm subtotal vào formData
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

        // Gửi yêu cầu đến server
        fetch("{{ route('coupon') }}", {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
            },
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Thông báo thành công và cập nhật giao diện
                    alert(`Mã giảm giá đã được áp dụng!\nGiảm giá: ${data.discount}${(data.type === 'percentage' ? '%' : ' VND')}\nTổng tiền: ${data.total}đ`);

               // Cập nhật giá trị giảm giá
                const discountElement = document.querySelector('#discountValue');
                if (discountElement) {
                    discountElement.value = data.discount;  // Cập nhật giá trị của input hidden
                    //  hiển thị giá trị giảm giá trên giao diện
                    const displayDiscount = document.querySelector('#displayDiscount');
                    if (displayDiscount) {
                        displayDiscount.textContent = data.discount + (data.type === 'percentage' ? '%' : ' VND');
                    }
                }

                // Cập nhật giá trị của "type"
                const typeDiscount = document.querySelector('#type');
                if (typeDiscount) {
                    typeDiscount.value = data.type;  // Cập nhật giá trị của input hidden
                }
                const totalInput = document.querySelector('input[name="totalValue"]');
                const totalAmount = document.querySelector('#totalAmount');

                // Kiểm tra nếu cả 2 phần tử đều tồn tại
                if (totalInput && totalAmount) {
                    const formattedTotal = data.total.replace(/,/g, '').replace(/\.00$/, '');  // Loại bỏ dấu phẩy và phần thập phân .00
                    // Cập nhật giá trị trong input ẩn
                    totalInput.value = formattedTotal;
                    // Cập nhật tổng tiền hiển thị trên giao diện
                    totalAmount.textContent = formattedTotal + 'đ';
                }

                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Lỗi khi gửi yêu cầu:', error);
                alert('Đã có lỗi xảy ra khi áp dụng mã giảm giá.');
            });
    }
});

</script>

@endsection
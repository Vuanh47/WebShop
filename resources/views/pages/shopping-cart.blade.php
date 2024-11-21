@extends('main')

@section('content')
<!-- Shopping Cart Area Start -->
<div class="Shopping-cart-area pt-60 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-content table-responsive">
                    <table class="table cart-table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th class="li-product-remove">Remove</th>
                                <th class="li-product-thumbnail">Images</th>
                                <th class="cart-product-name">Product</th>
                                <th class="li-product-price">Unit Price</th>
                                <th class="li-product-quantity">Quantity</th>
                                <th class="li-product-subtotal">Total</th>
                                <th class="li-product-confirm">Confirm</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($carts->isEmpty())
                                <tr>
                                    <td colspan="7" class="text-center">Không có sản phẩm trong giỏ hàng</td>
                                </tr>
                            @else
                                @foreach ($carts as $cart)
                                    <tr data-customer-id="{{ $cart->customer_id }}" data-cart-id="{{ $cart->id }}" data-product-id="{{ $cart->product_id}}">
                                        
                                        <td>
                                            <form action="{{ route('cart.delete', $cart->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="li-product-remove" style="border: none; background: none; cursor: pointer;">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td class="li-product-thumbnail">
                                            <a href="#"><img src="/storage/uploads/{{$cart->thumb}}" data-thumb="{{ $cart->thumb }}" alt=""></a>
                                        </td>
                                        <td class="li-product-name"><a href="#">{{ $cart->name }}</a></td>
                                        <td class="li-product-price">
                                            <span class="amount">{{ number_format($cart->price, 0, ',', '.') }}</span>
                                        </td>
                                        <td class="quantity">
                                            <label>Quantity</label>
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" value="{{ $cart->quantity }}" type="text">
                                            </div>
                                        </td>
                                        <td class="product-subtotal">
                                            <span class="amount">{{ number_format($cart->total, 0, ',', '.') }}</span>
                                        </td>
                                        <td class="li-product-confirm">
                                            <input type="checkbox" name="confirm[]" value="{{ $cart->id }}" style="transform: scale(0.4);" class="cart-item-checkbox" data-total="{{ $cart->total }}">
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                
                <div class="row mb-30">
                    <div class="col-12">
                        <div class="coupon-all">
                            <form action="{{ route('coupon') }}" method="post" id="coupon-form">
                                @csrf
                                <div class="coupon">
                                    <input id="code" class="input-text" name="code" placeholder="Coupon code" type="text">
                                    <input class="button" name="apply_coupon" value="Apply coupon" type="submit">
                                </div>
                            </form>
                            <div class="coupon2">
                                <button class="btn btn-dark" id="update-cart-btn" type="button">Update cart</button>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="row">
                    <div class="col-md-5 ml-auto">
                    <form action="{{ route('order') }}" method="post">
                        @csrf
                        <div class="cart-page-total">
                            <h2>Cart Totals</h2>
                            <ul>
                                <li>Subtotal <span id="subtotal">{{ formatCurrency($subtotal) }}</span></li>
                                <li>Discount 
                                    <span id="discountValue">
                                        {{ number_format($discount, 2) }} 
                                        @if($type == 'percentage')
                                            % 
                                        @else
                                            VNĐ
                                        @endif
                                    </span>
                                </li>
                                <li>Total <span id="totalValue">{{ number_format($total_cart, 0, ',', '.') }}</span></li>
                            </ul>
                        </div>
                        <input type="hidden" value="{{$subtotal}}" name="subtotal" id="subtotal">
                        <input type="hidden" value="{{$discount}}" name="discount" id="discountValue">
                        <input type="hidden" value="{{$total_cart}}" name="total" id="totalValue">
                        <input type="hidden" name="selectedIds" id="selectedIds" nam="selectedIds">
                        <button type="submit" class="btn btn-dark mt-4">Proceed to checkout</button>
                    </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shopping Cart Area End -->
@endsection

@section('footer')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // 1. Xử lý sự kiện liên quan đến nút cập nhật giỏ hàng
        const updateButton = document.querySelector('#update-cart-btn');
        if (updateButton) {
            updateButton.addEventListener('click', function () {
                updateCart();
                console.log('Đã Click cập nhật')
            });
        } else {
            console.log('#update-cart-btn không tồn tại trong DOM');
        }

        // 2. Xử lý thay đổi số lượng sản phẩm trong giỏ hàng
        const quantityInputs = document.querySelectorAll('.cart-plus-minus-box');
        quantityInputs.forEach(input => {
            const row = input.closest('tr');
            const incButton = row.querySelector('.inc.qtybutton');
            const decButton = row.querySelector('.dec.qtybutton');

            if (incButton) {
                incButton.addEventListener('click', function () {
                    updateQuantity(input, 1);
                });
            }

            if (decButton) {
                decButton.addEventListener('click', function () {
                    updateQuantity(input, -1);
                });
            }
        });

        // 3. Xử lý thay đổi checkbox và tính tổng subtotal
        document.querySelectorAll('.cart-item-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', calculateSelectedSubtotal);
        });

        // 4. Xử lý form mã giảm giá
        const couponForm = document.querySelector('#coupon-form');
        if (couponForm) {
            couponForm.addEventListener('submit', function (event) {
                event.preventDefault();
                applyCoupon();
            });
        } else {
            console.log('#coupon-form không tồn tại trong DOM');
        }

        // 5. Định nghĩa các hàm hỗ trợ
        function updateQuantity(input, change) {
            let quantity = parseInt(input.value) || 0;
            quantity = Math.max(quantity + change, 1); // Đảm bảo số lượng tối thiểu là 1
            input.value = quantity;

            const row = input.closest('tr');
            const price = parseFloat(row.querySelector('.li-product-price .amount').textContent.replace(/\./g, '')) || 0;
            const subtotalElement = row.querySelector('.product-subtotal .amount');
            const subtotal = price * quantity;

            subtotalElement.textContent = new Intl.NumberFormat('vi-VN').format(subtotal);
            calculateSelectedSubtotal();
        }

        function calculateSelectedSubtotal() {
            let selectedSubtotal = 0;
            const selectedId_cart = [];
            const selectedId_product = [];
            const checkboxes = document.querySelectorAll('.cart-item-checkbox:checked');

            checkboxes.forEach(checkbox => {
                const row = checkbox.closest('tr');
                const id_cart = row.getAttribute('data-cart-id');
                const id_product = row.getAttribute('data-product-id');

                if (id_cart && id_product) {
                    selectedId_cart.push(id_cart);
                    selectedId_product.push(id_product);
                }

                const subtotalElement = row.querySelector('.product-subtotal .amount');
                const subtotal = parseFloat(subtotalElement?.textContent.replace(/\./g, '')) || 0;
                selectedSubtotal += subtotal;
            });

            updateSummary(selectedSubtotal, selectedId_cart, selectedId_product);
        }

        function updateSummary(subtotal, idCartList, idProductList) {
            console.log('Subtotal:' ,subtotal)
            const subtotalDisplay = document.querySelector('#subtotal');
            const discountValue = parseFloat(document.querySelector('#discountValue').textContent.replace(/[^\d]/g, '')) || 0;
            const total = subtotal - discountValue;

            subtotalDisplay.textContent = new Intl.NumberFormat('vi-VN').format(subtotal);
            document.querySelector('#totalValue').textContent = new Intl.NumberFormat('vi-VN').format(total);

            document.querySelector('input[name="subtotal"]').value = subtotal;
            document.querySelector('input[name="total"]').value = total;
            document.querySelector('input[name="selectedIds"]').value = idCartList.join(',');

           // Lưu danh sách vào cookie dưới dạng chuỗi JSON
            console.log("Các id_cart đã chọn:", idCartList);

            // Chuyển danh sách idProductList thành chuỗi JSON và lưu vào cookie
            document.cookie = "idProductList=" + encodeURIComponent(JSON.stringify(idProductList)) + "; path=/; max-age=3600"; // cookie sẽ tồn tại trong 1 giờ

            // Hàm đọc cookie theo tên
            function getCookie(name) {
                let cookieArr = document.cookie.split(";");

                // Duyệt qua tất cả các cookie và tìm cookie có tên khớp
                for (let i = 0; i < cookieArr.length; i++) {
                    let cookie = cookieArr[i].trim();
                    
                    // Kiểm tra nếu cookie bắt đầu với tên mình cần tìm
                    if (cookie.startsWith(name + "=")) {
                        return decodeURIComponent(cookie.substring(name.length + 1));
                    }
                }
                return null;
            }

            // Đọc lại danh sách từ cookie
            const savedIdProductList = JSON.parse(getCookie('idProductList')) || [];
            console.log("Danh sách id_product từ cookie:", savedIdProductList);

        }

        function updateCart() {
        const cartRows = document.querySelectorAll('tbody tr');

        cartRows.forEach((row, index) => {
            const checkbox = row.querySelector('.cart-item-checkbox');

            if (!checkbox) {
                console.log(`Không tìm thấy checkbox ở dòng ${index + 1}`);
                return; // Bỏ qua nếu không có checkbox.
            }

            if (checkbox.checked) {
                console.log(`Checkbox dòng ${index + 1} được chọn`);

                const customerId = row.getAttribute('data-customer-id');
                const productId = row.getAttribute('data-product-id');
                const thumb = row.querySelector('.li-product-thumbnail img')?.src || '';
                const name = row.querySelector('.li-product-name a')?.textContent.trim() || '';
                const quantity = parseInt(row.querySelector('.cart-plus-minus-box').value) || 0;
                const price = parseFloat(row.querySelector('.li-product-price .amount').textContent.replace(/\./g, '')) || 0;
                const total = price * quantity;

                const updateUrl = `/cart/update/${productId}`;

                const formData = new URLSearchParams();
                formData.append('customer_id', customerId);
                formData.append('product_id', productId);
                formData.append('thumb', thumb);
                formData.append('name', name);
                formData.append('price', price);
                formData.append('quantity', quantity);
                formData.append('total', total);

                fetch(updateUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: formData.toString()
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log(`Cập nhật thành công sản phẩm ID: ${productId}`);
                        } else {
                            console.error(`Cập nhật thất bại cho sản phẩm ID: ${productId}`);
                        }
                    })
                    .catch(error => {
                        console.error('Lỗi khi gửi yêu cầu:', error);
                    });
            } else {
                console.log(`Checkbox dòng ${index + 1} chưa được chọn`);
            }
        });
    }

        function applyCoupon() {
            const code = document.querySelector('#code').value.trim();
            if (!code) {
                alert('Vui lòng nhập mã giảm giá.');
                return;
            }

            const formData = new FormData();
            formData.append('code', code);
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

            fetch("{{ route('coupon') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Mã giảm giá đã được áp dụng!,data.subtotal' + data.total);
                
                        document.querySelector('#discountValue').textContent = data.discount;
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

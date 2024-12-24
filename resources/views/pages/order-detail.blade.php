@extends('main')

@section('content')
<div class="order-detail container p-4">
    <div class="card m-10">
        <div class="card-body">
            <h2 class="text-center text-success p-4">Order Information</h2>

            <div class="order-details-container">
                <!-- Order Information -->
                <div class="order-details">
                    <div class="order-detail-item">
                        <strong>Order Date:</strong> {{ $order_details[0]->order->created_at->format(' H:i , l, d F Y') }}
                    </div>
                    <div class="order-detail-item">
                        <strong>Shipping Status:</strong> {{ $order_details[0]->order->shipping_status }}
                    </div>
                    <div class="order-detail-item">
                        <strong>Shipping Address:</strong> {{ $order_details[0]->order->shipping_address }}
                    </div>
                    <div class="order-detail-item">
                        <strong>Payment Method:</strong> {{ $order_details[0]->order->payment_method }}
                    </div>
                </div>

                <!-- Order Information in the order_details table -->
                <div class="order-details">
                    <div class="order-detail-item">
                        <strong>Email:</strong> {{ $order_details[0]->order->email }}
                    </div>
                    <div class="order-detail-item">
                        <strong>Phone Number:</strong> {{ $order_details[0]->order->phone_number }}
                    </div>
                    <div class="order-detail-item">
                        <strong>Recipient Name:</strong> {{ $order_details[0]->order->recipient_name }}
                    </div>
                    <div class="order-detail-item">
                        <strong>Order Notes:</strong> {{ $order_details[0]->order->order_notes }}
                    </div>
                </div>
            </div>

            <!-- Display Order Details -->
            <h5 class="mt-4">Order Details</h5>
            <table class="table table-bordered mt-2">
                <thead class="bg-dark">
                    <tr>
                        <th>Order Code</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order_details as $detail)
                    <tr>
                        <td>{{$detail->order_id}}</td>
                        <!-- Display product image from the 'cart' table -->
                        <td>
                            <a href="/storage/uploads/{{ $detail->product->thumb }}">
                                <img src="/storage/uploads/{{ $detail->product->thumb }}" width="100px">
                            </a>
                        </td>
                        @if($detail->product)
                        <td>{{ $detail->product->name }}</td>
                        @else
                        <td>Product Not Available</td>
                        @endif

                        <td>{{ $detail->quantity }}</td>
                        <td>{{ number_format($detail->price, 0, ',', '.') }}₫</td>
                        <td>{{ number_format($detail->quantity * $detail->price, 0, ',', '.') }}₫</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Display Total Price -->
            <p class="text-end"><strong>Subtotal Amount:</strong>
                {{ formatCurrency( $order_details[0]->order->subtotal)}}
            </p>
            <p class="text-end"><strong>Discount:</strong>
                @if($order_details[0]->order->type == 'percentage')
                {{ $order_details[0]->order->discount}} %
                @else

                {{ formatCurrency($order_details[0]->order->discount)}}
                @endif
            </p>
            <p class="text-end"><strong>Total Amount:</strong>
                {{ formatCurrency( $order_details[0]->order->total_price)}}
            </p>

        </div>
        @include('admin.alert')
        <div class="card-footer text-center mb-10">
            <button class="btn btn-primary mr-10" onclick="window.location.href='{{ route('shop') }}';">Continue Shopping</button>
            <button class="btn btn-danger" data-toggle="modal" data-target="#cancelOrderModal">Cancel Order</button>

        </div>

    </div>
</div>
<div class="modal fade" id="cancelOrderModal" tabindex="-1" role="dialog" aria-labelledby="cancelOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('order.cancel') }}" method="POST" id="cancelOrderForm">
                @csrf <!-- Bảo vệ form với CSRF token -->
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelOrderModalLabel">Confirm Cancellation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to cancel this order? Please select a reason:</p>

                    <!-- Dropdown for selecting cancellation reason -->
                    <div class="form-group">
                        <label for="cancelReason">Select a reason:</label>
                        <select class="form-control" id="cancelReason" name="cancel_reason" onchange="toggleOtherReason(this.value)">
                            <option value="Product issues">Product issues</option>
                            <option value="Changed my mind">Changed my mind</option>
                            <option value="Better price elsewhere">Found a better price elsewhere</option>
                            <option value="Shipping delays">Shipping delays</option>
                            <option value="Ordered by mistake">Ordered by mistake</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <input type="hidden" name="order_id" value="{{$order_details[0]->order->id}}">
                    <!-- Text area for custom reason when 'Other' is selected -->
                    <div class="form-group" id="otherReasonGroup" style="display: none;">
                        <label for="otherReason">Please specify your reason:</label>
                        <textarea class="form-control" id="otherReason" name="other_cancel_reason" rows="3" placeholder="Enter your reason here"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Confirm Cancellation</button>
                </div>
            </form>
        </div>
    </div>
</div>






@endsection

@section('footer')
<script>
    function toggleOtherReason(value) {
        const otherReasonGroup = document.getElementById('otherReasonGroup');
        const otherReasonInput = document.getElementById('otherReason');
        if (value === 'Other') {
            otherReasonGroup.style.display = 'block'; // Hiển thị textarea
            otherReasonInput.setAttribute('required', 'required'); // Đặt textarea là bắt buộc
        } else {
            otherReasonGroup.style.display = 'none'; // Ẩn textarea
            otherReasonInput.removeAttribute('required'); // Bỏ yêu cầu bắt buộc nếu không chọn 'Other'
        }
    }
</script>
@endsection
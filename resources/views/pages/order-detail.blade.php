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
            <p class="text-end"><strong>Total Amount:</strong> 
                {{ number_format($order_details->sum(function($detail) { return $detail->quantity * $detail->price; }), 0, ',', '.') }}₫
            </p>
        </div>

        <div class="card-footer text-center mb-10">
            <button href="{{ route('shop') }}" class="btn btn-danger">Continue Shopping</button>
        </div>
    </div>
</div>

@endsection

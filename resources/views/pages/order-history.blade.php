@extends('main')

@section('content')
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Order History</h1>
        <table class="table table-bordered text-center align-middle">
            <thead class="thead-dark">
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Image</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($orders as $orderID => $orderDetails)
                @foreach ($orderDetails as $index => $detail)
                    <tr>
                        <!-- Order ID -->
                        @if ($index == 0) <!-- Chỉ hiển thị Order ID cho lần đầu tiên -->
                            <td rowspan="{{ count($orderDetails) }}">{{ $orderID }}</td>
                        @endif

                        <!-- Product Name -->
                       
                        <td class="li-product-name"><a href="{{route('details',$detail->product->id)}}"> {{ $detail->product->name }}</a></td>
                        <!-- Image -->
                        <td>
                            <a href="/storage/uploads/{{ $detail->product->thumb }}">
                                <img src="/storage/uploads/{{ $detail->product->thumb }}" width="50px">
                            </a>
                        </td>

                        <!-- Quantity -->
                        <td>
                            {{ $detail->quantity }}
                        </td>

                        <!-- Total Price -->
                        @if ($index == 0) <!-- Chỉ hiển thị Total Price cho lần đầu tiên -->
                            <td rowspan="{{ count($orderDetails) }}">{{ number_format($orderDetails->first()->order->total_price, 0, ',', '.') }}đ</td>
                        @endif

                        <!-- Order Date -->
                        @if ($index == 0) <!-- Chỉ hiển thị Order Date cho lần đầu tiên -->
                            <td rowspan="{{ count($orderDetails) }}">{{ $orderDetails->first()->created_at->format('d/m/Y') }}</td>
                        @endif

                        <!-- Status -->
                        @if ($index == 0) <!-- Chỉ hiển thị Status cho lần đầu tiên -->
                            <td rowspan="{{ count($orderDetails) }}">
                                @php
                                    $status = $orderDetails->first()->order->shipping_status;
                                @endphp
                                @if ($status == 'Pending')
                                    <span class="badge bg-warning text-dark custom-badge">Pending</span>
                                @elseif ($status == 'Processing')
                                    <span class="badge bg-info text-dark custom-badge">Processing</span>
                                @elseif ($status == 'Shipped')
                                    <span class="badge bg-primary custom-badge">Shipped</span>
                                @elseif ($status == 'Out for Delivery')
                                    <span class="badge bg-secondary custom-badge">Out for Delivery</span>
                                @elseif ($status == 'Delivered')
                                    <span class="badge bg-success custom-badge">Delivered</span>
                                @elseif ($status == 'Cancelled')
                                    <span class="badge bg-danger custom-badge">Cancelled</span>
                                @else
                                    <span class="badge bg-secondary custom-badge">Unknown Status</span>
                                @endif
                            </td>
                        @endif

                        <!-- Details Button -->
                        @if ($index == 0) <!-- Chỉ hiển thị Details Button cho lần đầu tiên -->
                            <td rowspan="{{ count($orderDetails) }}">
                                <a href="{{ route('order_details', $orderDetails->first()->order_id) }}" class="btn btn-primary btn-sm">View</a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            @endforeach

            @if ($orders->isEmpty())
                <tr>
                    <td colspan="8">No orders found.</td>
                </tr>
            @endif

            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination-wrapper mt-40 d-flex justify-content-end">
            {{ $orders->links() }}
        </div>
    </div>
</body>
@endsection

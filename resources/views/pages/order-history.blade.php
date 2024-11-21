@extends('main')

@section('content')
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Order History</h1>
        <table class="table table-bordered text-center align-middle">
            <thead class="thead-dark">
                <tr>
                    <th>Order ID</th>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($orders as $orderID => $orderDetails)
                <tr>
                    <td>{{ $orderID }}</td>
                    <td>
                        @foreach ($orderDetails as $detail)
                            <a href="/storage/uploads/{{ $detail->product->thumb }}">
                                <img src="/storage/uploads/{{ $detail->product->thumb }}" width="50px">
                            </a>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($orderDetails as $detail)
                            {{ $detail->product->name }}<br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($orderDetails as $detail)
                            {{ $detail->quantity }}<br>
                        @endforeach
                    </td>
                    <td>{{ number_format($orderDetails->first()->order->total_price, 0, ',', '.') }}đ</td>
                    <td>{{ $orderDetails->first()->created_at->format('d/m/Y') }}</td>
                    <td>
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
                    <td>
                        <a href="{{ route('order_details', $orderID) }}" class="btn btn-primary btn-sm">View</a>
                    </td>
                </tr>
            @endforeach

            @if ($orders->isEmpty())
                <tr>
                    <td colspan="8">No orders found.</td>
                </tr>
            @endif

            </tbody>
        </table>
    </div>
</body>
@endsection

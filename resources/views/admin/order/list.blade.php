@extends('admin.main')

@section('content')
<div class="card card-primary card-outline mb-4"> <!--begin::Header-->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã Đơn Hàng</th>
                <th>Khách Hàng</th>
                <th>Địa Chỉ Giao Hàng</th>
                <th>Tổng Tiền</th>
                <th>Ngày Đặt Hàng</th>
                <th>Trạng Thái</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $orderID => $orderDetails)
                @php
                    $order = $orderDetails->first()->order;  
                    $totalPrice = $orderDetails->sum(fn($detail) => $detail->quantity * $detail->price);
                @endphp
                <tr>
                    <td>{{ $orderID }}</td>
                    <td>{{ $order->customer->name ?? 'N/A' }}</td>
                    <td>{{ $order->shipping_address ?? 'N/A' }}</td>
                    <td>{{ formatCurrency($totalPrice) }}</td>
                    <td> {{ $orderDetails->first()->created_at->format('H:i d/m/Y') }}</td>
                    <td>
                        <form action="{{ route('orders.nextStatus', $order->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                {{ $statusMapping[$order->shipping_status] ?? 'N/A' }}
                            </button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('order.detail', $order->id) }}" method="post">
                        @csrf
                            <button type="submit" class="btn btn-primary">
                                Xem
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</div>
@endsection

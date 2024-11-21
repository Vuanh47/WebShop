@extends('admin.main')

@section('content')
<div class="container">
    <div class="card mb-4">
        <div class="card-header">
            <strong>Thông Tin Đơn Hàng #{{ $order->id }}</strong>
        </div>
        <div class="card-body">
            <!-- Thông tin khách hàng -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Khách Hàng:</strong> {{ $order->customer->name ?? 'N/A' }}</p>
                    <p><strong>Email:</strong> {{ $order->customer->email ?? 'N/A' }}</p>
                    <p><strong>Địa Chỉ Giao Hàng:</strong> {{ $order->shipping_address ?? 'N/A' }}</p>
                </div>
                <!-- Thông tin trạng thái -->
                <div class="col-md-6">
                    <form action="{{ route('orders.nextStatus', $order->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <p><strong>Trạng Thái:</strong>
                        <button type="submit" class="btn btn-danger">  {{ $statusMapping[$order->shipping_status] ?? 'N/A' }}</button>
                    </form></p>
                    <p><strong>Tổng Tiền:</strong> {{ formatCurrency($order->total_price) }}</p>
                    <p><strong>Ngày Đặt Hàng:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            <h4>Danh Sách Sản Phẩm</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Ảnh</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Số Lượng</th>
                        <th>Đơn Giá</th>
                        <th>Thành Tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderDetails as $detail)
                        <tr>
                            <td>
                                <a href="/storage/uploads/{{ $detail->product->thumb }}">
                                    <img src="/storage/uploads/{{ $detail->product->thumb }}" width="75px">
                                </a>
                            </td>
                            <td>{{ $detail->product->name }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>{{ formatCurrency($detail->price) }}</td>
                            <td>{{ formatCurrency($detail->quantity * $detail->price) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <a href="{{route('order.list')}}" class="btn btn-primary mt-3">Trở Về</a>
</div>
@endsection

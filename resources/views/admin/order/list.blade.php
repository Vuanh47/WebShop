@extends('admin.main')

@section('content')
<div class="container">

@foreach ($orders as $orderID => $orderDetails)
    <div class="card mb-4">
        <div class="card-header">
            <strong>Thông Tin Đơn Hàng #{{ $orderID }}</strong>
        </div>
        <div class="card-body">
            <!-- Thông tin khách hàng -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Khách Hàng:</strong> {{ $orderDetails->first()->order->customer->name ?? 'N/A' }}</p>
                    <p><strong>Email:</strong> {{ $orderDetails->first()->order->customer->email ?? 'N/A' }}</p>
                    <p><strong>Địa Chỉ Giao Hàng:</strong> {{ $orderDetails->first()->order->shipping_address ?? 'N/A' }}</p>
                </div>
                <!-- Thông tin trạng thái -->
                <div class="col-md-6">
                    <p><strong>Trạng Thái:</strong> {{ $orderDetails->first()->order->shipping_status ?? 'N/A' }}</p>
                    <p><strong>Tổng Tiền:</strong> {{ formatCurrency($orderDetails->first()->order->total_price) }}</p>
                    <p><strong>Ngày Đặt Hàng:</strong> {{ $orderDetails->first()->created_at->format('d/m/Y H:i') }}</p>
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
                            <td><a href="/storage/uploads/{{ $detail->product->thumb }}"><img src="/storage/uploads/{{ $detail->product->thumb }}" width="75px"></a></td>

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
@endforeach

    <a href="" class="btn btn-primary mt-3">Trở Về Trang Chủ</a>
</div>

@endsection

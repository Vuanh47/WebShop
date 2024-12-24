@extends('admin.main')

@section('content')
<!-- Form Lọc -->
<div class="d-flex justify-content-between align-items-center mb-2">
    <form action="{{ route('search.order') }}" method="GET" style="direction: rtl; text-align: right;"
        class="d-flex align-items-center ms-auto">
        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button></span>
        <select name="order_type" class="form-control">
            <option value="">Tất Cả</option>
            @foreach ($statusMapping as $key => $value)
            <option value="{{ $key }}">
                {{ $value }}

            </option>
            @endforeach
        </select>

    </form>



</div>

<!-- Bảng danh sách đơn hàng -->
<div class="card card-primary card-outline mb-4">
    <table class="table">
        <thead class="table">
            <tr>
                <th>Mã Đơn Hàng</th>
                <th>Khách Hàng</th>
                <th>Địa Chỉ</th>
                <th>Tổng Tiền</th>
                <th>Ngày Đặt</th>
                <th>Trạng Thái</th>
                <th class="text-center">Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $index => $order)
            <tr>
                <td>{{ $order->id}}</td>
                <td>{{ $order->customer->name ?? 'N/A' }}</td>
                <td>{{ $order->shipping_address ?? 'N/A' }}</td>
                <td>{{ number_format($order->total_price) }} đ</td>
                <td>{{ $order->created_at->format('H:i d/m/Y') }}</td>
                <td>
                    <span class="badge bg-{{ 

                                        ($order->shipping_status == 'Processing' ? 'info' :
                    ($order->shipping_status == 'Shipped' ? 'primary' :
                        ($order->shipping_status == 'Out for Delivery' ? 'info' :
                            ($order->shipping_status == 'Delivered' ? 'success' :
                                ($order->shipping_status == 'Cancelled' ? 'danger' : 'secondary'))))) }}">
                        {{ $statusMapping[$order->shipping_status] ?? 'N/A' }}
                    </span>


                <td class="text-center">
                    <form action="{{ route('orders.nextStatus', $order->id) }}" method="POST"
                        class="update-status-form">
                        @csrf
                        <button class="btn btn-danger btn-sm w-100 update-status mb-2" data-id="{{ $order->id }}"
                            type="button">Cập Nhật</button>
                    </form>

                    <a href="{{ route('order.detail', $order->id) }}" class="btn btn-sm btn-primary w-100">
                        Xem
                    </a>
                </td>


            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center text-muted">Không có đơn hàng nào phù hợp.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if ($orders->hasPages())
    <div class="card-footer d-flex justify-content-center">
        {{ $orders->links('pagination::bootstrap-4') }}
    </div>
    @endif
</div>

<!-- Phân Trang -->
</div>
@endsection

@section('footer')
<script>
    $(document).ready(function() {
        // Xử lý sự kiện click vào nút "Cập Nhật"
        $('.update-status').on('click', function() {
            var orderId = $(this).data('id'); // Lấy ID đơn hàng

            // Gửi yêu cầu AJAX
            $.ajax({
                url: "{{ route('orders.nextStatus', ':id') }}".replace(':id', orderId), // Đảm bảo URL đúng
                type: 'POST', // Đảm bảo đây là 'POST'
                data: {
                    _token: "{{ csrf_token() }}", // CSRF token
                },
                success: function(response) {
                    if (response.success) {
                        // Cập nhật trạng thái đơn hàng trong bảng
                        $('span[data-id="' + orderId + '"]').removeClass().addClass('badge bg-' + response.statusClass);
                        $('span[data-id="' + orderId + '"]').text(response.statusText);

                        // Thay đổi nội dung nút "Cập Nhật"
                        var btn = $('button[data-id="' + orderId + '"]');
                        btn.text('Đã Cập Nhật');
                        btn.prop('disabled', true);

                        alert("Cập nhật trạng thái thành công!");
                    } else {
                        alert("Có lỗi xảy ra khi cập nhật trạng thái.");
                    }
                },
                error: function(xhr, status, error) {
                    alert("Lỗi khi gửi yêu cầu.");
                }
            });
        });
    });
</script>
@endsection
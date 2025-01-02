@extends('admin.main')

@section('content')

<!-- Bảng danh sách đơn hàng -->
<div class="card card-primary card-outline mb-4">
  <div class="card-header">
    <h3 class="card-title">Danh sách các đơn hàng đã hủy</h3>
  </div>
  <div class="card-body">
    <!-- Bảng hiển thị thông tin đơn hàng -->
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Order ID</th>
          <th>Lý do hủy</th>
          <th>Lý do khác</th>
          <th>Trạng thái</th>
          <th>Ngày cập nhật</th>
          <th>Hoạt động</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($orderCancel as $order)
        <tr>
          <td>{{ $order->id }}</td>
          <td>{{ $order->order_id }}</td>
          <td>{{ $order->cancel_reason }}</td>
          <td>{{ $order->other_cancel_reason ?: 'Không có' }}</td>
          <td>{{ $order->status }}</td>
          <td>{{ $order->created_at }}</td>
          <td>
            <!-- Form cập nhật trạng thái -->
            <form action="{{ route('cancelOrder.update', $order->id) }}" method="POST">
              @csrf
              @method('PUT')
              <select name="status" class="form-control" onchange="this.form.submit()">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Đang chờ</option>
                <option value="approved" {{ $order->status == 'approved' ? 'selected' : '' }}>Đã duyệt</option>
                <option value="rejected" {{ $order->status == 'rejected' ? 'selected' : '' }}>Bị từ chối</option>

              </select>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection
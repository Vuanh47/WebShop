@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Voucher</th>
                <th>Giá Trị</th>
                <th>Loại</th>
                <th>Số Lượng</th>
                <th>Ngày Bắt Đầu</th>
                <th>Ngày Kết Thúc</th>
                <th>Điều Kiện</th>
                <th>Active</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($vouchers as $voucher)
                <tr>
                    <td>{{ $voucher->id }}</td>
                    <td>{{ $voucher->code }}</td>
                    <td>{{ $voucher->value }}</td>
                    <td>{{ $voucher->type }}</td>
                    <td>{{ $voucher->quantity }}</td>
                    <td>{{ $voucher->start_date }}</td>
                    <td>{{ $voucher->end_date }}</td>
                    <td>{!! $voucher->conditions !!}</td>
                    <td>
                        @if($voucher->active == 1)
                            <button class="btn btn-success btn-sm">Yes</button>
                        @else
                            <button class="btn btn-danger btn-sm">No</button>
                        @endif
                    </td>
                    <td>{{ $voucher->updated_at }}</td>
                    
                    <!-- Nút Sửa -->
                    <td>
                        <a href="{{ route('voucher.edit', $voucher->id) }}" class="btn btn-warning btn-sm m-1" title="Sửa">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('voucher.destroy', $voucher->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm m-1">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="text-center">Không có voucher nào</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection

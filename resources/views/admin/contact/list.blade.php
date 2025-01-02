@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Khách Hàng</th>
                <th>Tiêu Đề</th>
                <th>Thông Điệp</th>
                <th>Ngày Tạo</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->customer->name ?? 'Chưa có thông tin' }}</td> 
                    <td>{{ $contact->subject }}</td>
                    <td>{{ Str::limit($contact->message, 50) }}</td> 
                    <td>{{ $contact->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <a href="" class="btn btn-primary btn-sm">Xem</a>
                        <a href="" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

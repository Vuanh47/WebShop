@extends('admin.main')

@section('content')
<div class="card card-primary card-outline mb-4">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Sản Phẩm</th>
                <th>Danh Mục</th>            
                <th>Mô Tả</th>
                <th>Số Lượng</th>
                <th>Giá Gốc</th>
                <th>Giá Sale</th>
                <th>Active</th>
                <th>Ảnh</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
            
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->quality }}</td>
                <td>{{ number_format($product->price, 0, ',', '.') }} </td>
                <td>{{ number_format( $product->price_sale, 0, ',', '.') }} </td>
                <td>
                    @if($product->active == 1)
                        <button class="btn btn-success btn-sm mt-1">Yes</button>
                    @else
                        <button class="btn btn-danger btn-sm mt-1">No</button>
                    @endif
                </td>

                <td><a href="/storage/uploads/{{ $product->thumb }}"><img src="/storage/uploads/{{ $product->thumb }}" width="100px"></a></td>
                
                <!-- Nút Sửa -->
                <td>
                    <a href="{{route('product.edit', $product->id) }}" class="btn btn-warning btn-sm" title="Sửa">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{route('product.destroy', $product->id)}} " method="POST" style="display:inline-block mt-2;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm mt-2">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>

                </td>

            </tr>

            @empty
                <tr>
                <td colspan="12" class="text-center">Không có sản phẩm nào</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div>
</div>
@endsection

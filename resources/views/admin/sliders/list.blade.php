@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Slider</th>
                <th>URL</th>            
                <th>Sắp Xếp</th>
                <th>Ảnh</th>
                <th>Active</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($sliders as $slider)
            
            <tr>
                <td>{{ $slider->id }}</td>
                <td>{{ $slider->name }}</td>
                <td>{{ $slider->url }}</td>
                <td>{!! $slider->sort_by !!}</td>
                <td><a href="/storage/uploads/{{ $slider->thumb }}"><img src="/storage/uploads/{{ $slider->thumb }}" width="100px"></a></td>
                <td>
                    @if($slider->active == 1)
                        <button class="btn btn-success btn-sm">Yes</button>
                    @else
                        <button class="btn btn-danger btn-sm">No</button>
                    @endif
                </td>

               
                <td>{{ $slider->updated_at }}</td>
                
                <!-- Nút Sửa -->
                <td>
                    <a href="{{route('slider.edit', $slider->id) }}" class="btn btn-warning btn-sm" title="Sửa">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{route('slider.destroy', $slider->id)}} " method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
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
@endsection

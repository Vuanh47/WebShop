@extends('admin.main')

@section('header')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <div class="card card-primary card-outline mb-4"> <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Chỉnh Sửa Danh Mục</div>
        </div> <!--end::Header--> 

        <!--begin::Form-->
        <form action="{{ route('menu.update', $menu->id) }}" method="post">  <!-- Sử dụng route và truyền ID -->
            @csrf
            @method('PUT')  <!-- Phương thức PUT để cập nhật dữ liệu -->

            <!--begin::Body-->
            <div class="card-body">
                <!-- Tên Danh Mục -->
                <div class="form-group mb-3"> 
                    <label for="menu" class="form-label">Tên Danh Mục</label> 
                    <input type="text" name="name" class="form-control" id="menu" value="{{ $menu->name }}" placeholder="Nhập Danh Mục">
                </div>

                <div class="form-group mb-3">
                    <label for="parent_id" class="form-label">Danh Mục</label> 
                    <select name="parent_id" id="parent_id" class="form-control">
                        <option value="0">Danh Mục Cha</option>

                        @foreach ($menus as $item)  <!-- Lặp qua tất cả các danh mục để chọn danh mục cha -->
                            <option value="{{ $item->id }}" {{ $item->id == $menu->parent_id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>  
                </div>

                
                <!-- Mô Tả -->
                <div class="form-group mb-3"> 
                    <label for="description" class="form-label">Mô Tả</label> 
                    <textarea class="form-control" name="description" id="description" placeholder="Nhập Mô Tả">{{ $menu->description }}</textarea>
                </div>
                
                <!-- Mô Tả Chi Tiết -->
                <div class="form-group mb-3"> 
                    <label for="content" class="form-label">Mô Tả Chi Tiết</label> 
                    <textarea class="form-control" name="content" id="content" placeholder="Nhập Mô Tả Chi Tiết">{{ $menu->content }}</textarea>
                </div>

                <!-- Trạng thái Kích Hoạt -->
                <div class="form-group mb-3"> 
                    <label for="menu" class="form-label">Kích Hoạt</label> 
                    <div class="col-sm-10">
                        <div class="form-check"> 
                            <input class="form-check-input" type="radio" name="active" id="active" value="1" {{ $menu->active == 1 ? 'checked' : '' }}> 
                            <label class="form-check-label" for="active">Có</label>
                        </div>
                        <div class="form-check"> 
                            <input class="form-check-input" type="radio" name="active" id="noactive" value="0" {{ $menu->active == 0 ? 'checked' : '' }}> 
                            <label class="form-check-label" for="noactive">Không</label>
                        </div>
                    </div>
                </div>
            </div> <!--end::Body--> 
            
            <!--begin::Footer-->
            <div class="card-footer" style="display: flex; justify-content: space-between; align-items: center; font-size: 20px;"> 
                <span> 
                    <button type="submit" class="btn btn-primary">Cập Nhật Danh Mục</button> 
                </span>
                <span> 
                    @include('admin.alert')
                </span>
            </div> <!--end::Footer-->
        </form> <!--end::Form-->
    </div>
@endsection

@section('footer')
    <script>   
        CKEDITOR.replace('content'); // Thay thế trường textarea "Mô Tả Chi Tiết" bằng CKEditor
    </script>
@endsection

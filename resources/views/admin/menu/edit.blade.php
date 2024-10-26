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
                    <label for="description" class="form-label">Mô Tả Chi Tiết</label> 
                    <textarea class="form-control" name="description" id="description" placeholder="Nhập Mô Tả">{{ $menu->description }}</textarea>
                </div>
                
              
                <label for="thumb" class="form-label">Chọn Ảnh</label>
                <div class="mb-3">
                    <input type="file" id="imageUpload" name="thumb_path" accept=".png, .jpg, .jpeg" onchange="previewImage(this)">
                </div>

                <!-- Trường ẩn để lưu đường dẫn ảnh sau khi tải lên -->
                <input type="hidden" name="thumb" id="thumb" value="{{$menu->thumb}}">

                <div class="avatar-preview">
                    <!-- Hiển thị ảnh từ server hoặc ảnh mặc định -->
                    <div id="imagePreview" style="background-image: url('{{ $imageUrl }}'); width: 200px; height: 200px; background-size: cover; background-position: center;"></div>
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
         
        function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                // Hiển thị ảnh mới trong thẻ div#imagePreview
                document.getElementById('imagePreview').style.backgroundImage = 'url(' + e.target.result + ')';
            }
            reader.readAsDataURL(input.files[0]); // Đọc file ảnh mới

            // Gửi ảnh lên server thông qua AJAX
            var formData = new FormData();
            formData.append('thumb', input.files[0]); // Đính kèm file ảnh đã chọn

            // Gọi AJAX để upload ảnh
        fetch('{{ route("upload.services") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log('Thành công:', data); // Hiển thị kết quả thành công

                // Kiểm tra xem phản hồi có chứa thông tin thành công không
                if (data.success) {
                  // Cập nhật giao diện để hiển thị ảnh
                    const imageUrl = '/storage/' + data.filePath; // Đường dẫn ảnh
                    console.log(data.filePath);

                    // Cập nhật background-image của div#imagePreview
                    document.getElementById('imagePreview').style.backgroundImage = 'url(' + imageUrl + ')';

                    // Cập nhật giá trị của input ẩn
                    document.getElementById('thumb').value = data.thumb;
                    console.log('Thành công:', data.thumb);

                }
            })
            .catch((error) => {
                console.error('Lỗi:', error);
            });

        }
    }
    </script>
@endsection

@extends('admin.main')

@section('header')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <div class="card card-primary card-outline mb-4"> <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Thêm Voucher</div>
        </div> <!--end::Header--> 

        <!--begin::Form-->
        <form action="" method="post"> 
            <!--begin::Body-->
            <div class="card-body">
               <div class="row">
                     <!-- Tên Voucher -->
                    <div class="form-group col-6 mb-3"> 
                        <label for="name" class="form-label">Tên Voucher</label> 
                        <input type="text" name="code" class="form-control" id="code" placeholder="Nhập Tên Voucher">
                    </div>

                     <!-- Số Lượng -->
                    <div class="form-group col-6 mb-3">
                        <label for="quantity" class="form-label">Số Lượng</label>
                        <input type="number" name="quantity" class="form-control" id="quantity" placeholder="Nhập Số Lượng">
                    </div>
               </div>

                   
               <div class="row">
                    <!-- Giá trị Voucher -->
                    <div class="form-group col-6 mb-3">
                        <label for="value" class="form-label">Giá Trị</label>
                        <input type="number" name="value" class="form-control" id="value" placeholder="Nhập Giá Trị Voucher" step="0.01">
                    </div>

                    <!-- Loại Voucher -->
                    <div class="form-group col-6 mb-3">
                        <label for="type" class="form-label">Loại</label>
                        <select name="type" class="form-control" id="type">
                            <option value="percentage">Phần Trăm</option>
                            <option value="fixed">Số Tiền Cố Định</option>
                        </select>
                    </div>
              </div>

               <div class="row">
                 <!-- Ngày Bắt Đầu -->
                    <div class="form-group col-6 mb-3">
                        <label for="start_date" class="form-label">Ngày Bắt Đầu</label>
                        <input type="date" name="start_date" class="form-control" id="start_date">
                    </div>

                    <!-- Ngày Kết Thúc -->
                    <div class="form-group col-6 mb-3">
                        <label for="end_date" class="form-label">Ngày Kết Thúc</label>
                        <input type="date" name="end_date" class="form-control" id="end_date">
                    </div>
               </div>

                <!-- Điều Kiện -->
                <div class="form-group mb-3">
                    <label for="conditions" class="form-label">Điều Kiện</label>
                    <textarea class="form-control" name="conditions" id="conditions" placeholder="Nhập Điều Kiện"></textarea>
                </div>

            

                <!-- Kích Hoạt -->
                <div class="form-group mb-3"> 
                    <label for="active" class="form-label">Kích Hoạt</label> 
                    <div class="col-sm-10">
                        <div class="form-check"> 
                            <input class="form-check-input" type="radio" name="active" id="active" value="1" checked> 
                            <label class="form-check-label" for="active">Có</label>
                        </div>
                        <div class="form-check"> 
                            <input class="form-check-input" type="radio" name="active" id="noactive" value="0"> 
                            <label class="form-check-label" for="noactive">Không</label>
                        </div>
                    </div>
                </div>
            </div> <!--end::Body--> 
            
            <!--begin::Footer-->
            <div class="card-footer" style="display: flex; justify-content: space-between; align-items: center; font-size: 20px;"> 
                <span> 
                    <button type="submit" class="btn btn-primary">Tạo Voucher</button> 
                </span>
                <span> 
                    @include('admin.alert')
                </span>
            </div> <!--end::Footer-->

            @csrf
        </form> <!--end::Form-->
    </div>
@endsection

@section('footer')
    <script>   
        CKEDITOR.replace('conditions'); // Thay thế trường textarea "Điều Kiện" bằng CKEditor nếu cần
        
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('imagePreview').style.backgroundImage = 'url(' + e.target.result + ')';
                }
                reader.readAsDataURL(input.files[0]);

                var formData = new FormData();
                formData.append('thumb', input.files[0]);

                // AJAX để upload ảnh
                fetch('{{ route("upload.services") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const imageUrl = '/storage/' + data.filePath;
                        document.getElementById('imagePreview').style.backgroundImage = 'url(' + imageUrl + ')';
                        document.getElementById('thumb').value = data.thumb;
                    }
                })
                .catch(error => console.error('Lỗi:', error));
            }
        }
    </script>
@endsection

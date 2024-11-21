@extends('admin.main')

@section('header')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <div class="card card-primary card-outline mb-4"> <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Chỉnh Sửa Voucher</div>
        </div> <!--end::Header--> 

        <!--begin::Form-->
        <form action="{{ route('voucher.update', $voucher->id) }}" method="post">  <!-- Sử dụng route và truyền ID -->
            @csrf
            @method('PUT')  <!-- Phương thức PUT để cập nhật dữ liệu -->

            <!--begin::Body-->
            <div class="card-body">
                <div class="row">
                    <!-- Tên Voucher -->
                    <div class="form-group col-6 mb-3"> 
                        <label for="name" class="form-label">Tên Voucher</label> 
                        <input type="text" name="name" class="form-control" id="name" value="{{ $voucher->name }}" placeholder="Nhập Tên Voucher">
                    </div>

                    <!-- Số Lượng -->
                    <div class="form-group col-6 mb-3">
                        <label for="quantity" class="form-label">Số Lượng</label>
                        <input type="number" name="quantity" class="form-control" id="quantity" value="{{ $voucher->quantity }}" placeholder="Nhập Số Lượng">
                    </div>
                </div>

                <div class="row">
                    <!-- Giá trị Voucher -->
                    <div class="form-group col-6 mb-3">
                        <label for="value" class="form-label">Giá Trị</label>
                        <input type="number" name="value" class="form-control" id="value" value="{{ $voucher->value }}" placeholder="Nhập Giá Trị Voucher" step="0.01">
                    </div>

                    <!-- Loại Voucher -->
                    <div class="form-group col-6 mb-3">
                        <label for="type" class="form-label">Loại</label>
                        <select name="type" class="form-control" id="type">
                            <option value="percentage" {{ $voucher->type == 'percentage' ? 'selected' : '' }}>Phần Trăm</option>
                            <option value="fixed" {{ $voucher->type == 'fixed' ? 'selected' : '' }}>Số Tiền Cố Định</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <!-- Ngày Bắt Đầu -->
                    <div class="form-group col-6 mb-3">
                        <label for="start_date" class="form-label">Ngày Bắt Đầu</label>
                        <input type="date" name="start_date" class="form-control" id="start_date" value="{{ $voucher->start_date }}">
                    </div>

                    <!-- Ngày Kết Thúc -->
                    <div class="form-group col-6 mb-3">
                        <label for="end_date" class="form-label">Ngày Kết Thúc</label>
                        <input type="date" name="end_date" class="form-control" id="end_date" value="{{ $voucher->end_date }}">
                    </div>
                </div>

                <!-- Điều Kiện -->
                <div class="form-group mb-3">
                    <label for="conditions" class="form-label">Điều Kiện</label>
                    <textarea class="form-control" name="conditions" id="conditions" placeholder="Nhập Điều Kiện">{{ $voucher->conditions }}</textarea>
                </div>

                <!-- Kích Hoạt -->
                <div class="form-group mb-3"> 
                    <label for="active" class="form-label">Kích Hoạt</label> 
                    <div class="col-sm-10">
                        <div class="form-check"> 
                            <input class="form-check-input" type="radio" name="active" id="active" value="1" {{ $voucher->active == 1 ? 'checked' : '' }}> 
                            <label class="form-check-label" for="active">Có</label>
                        </div>
                        <div class="form-check"> 
                            <input class="form-check-input" type="radio" name="active" id="noactive" value="0" {{ $voucher->active == 0 ? 'checked' : '' }}> 
                            <label class="form-check-label" for="noactive">Không</label>
                        </div>
                    </div>
                </div>
            </div> <!--end::Body--> 
            
            <!--begin::Footer-->
            <div class="card-footer" style="display: flex; justify-content: space-between; align-items: center; font-size: 20px;"> 
                <span> 
                    <button type="submit" class="btn btn-primary">Cập Nhật Voucher</button> 
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
        CKEDITOR.replace('conditions'); // Thay thế trường textarea "Điều Kiện" bằng CKEditor
    </script>
@endsection

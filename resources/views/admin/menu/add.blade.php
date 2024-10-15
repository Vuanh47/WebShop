@extends('admin.main')

@section('header')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <div class="card card-primary card-outline mb-4"> <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Thêm Danh Mục</div>
        </div> <!--end::Header--> 

        <!--begin::Form-->
        <form action="" method="post"> 
            <!--begin::Body-->
            <div class="card-body">
                <div class="form-group mb-3"> 
                    <label for="menu" class="form-label">Tên Danh Mục</label> 
                    <input type="text" name="name" class="form-control" id="menu" placeholder="Nhập Danh Mục">
                </div>

                <div class="form-group mb-3">
                    <label for="parent_id" class="form-label">Danh Mục</label> 
                    <select name="parent_id" id="parent_id" class="form-control">
                        <option value="0">Danh Mục Cha</option>

                        @foreach ($menus as $menu)
                            <option value="{{$menu->id}}">{{$menu->name}}</option>
                        @endforeach
                    </select>  
                </div>    
                
                <div class="form-group mb-3"> 
                    <label for="description" class="form-label">Mô Tả</label> 
                    <textarea class="form-control" name="description" id="description" placeholder="Nhập Mô Tả"></textarea>
                </div>
                
                <div class="form-group mb-3"> 
                    <label for="content" class="form-label">Mô Tả Chi Tiết</label> 
                    <textarea class="form-control" name="content" id="content" placeholder="Nhập Mô Tả Chi Tiết"></textarea>
                </div>

                <div class="form-group mb-3"> 
                    <label for="menu" class="form-label">Kích Hoạt</label> 
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
                    <button type="submit" class="btn btn-primary">Tạo Danh Mục</button> 
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
        CKEDITOR.replace('content'); // Thay thế trường textarea "Mô Tả Chi Tiết" bằng CKEditor
    </script>
@endsection

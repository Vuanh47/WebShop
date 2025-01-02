@extends('pages.mainprofile')

@section('content_profile')
<div class="col-md-9 profile-content">
    <h3>My Profile</h3>
    <p>Manage your profile information to secure your account</p>
    <form action="{{route('profile.update')}}" method="post">

        @csrf
        <div class="profile-image mt-4 text-center">
            <img id="profileImage" src="https://placehold.co/100x100" alt="Profile image" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
            <div class="mt-3">
                <label for="fileInput" class="btn btn-outline-success" id="chooseImageBtn">Choose Image</label>
            </div>
            <input type="file" id="fileInput" accept=".jpeg, .png, .jpg" onchange="previewImage(this)" style="display: none;">
            <input type="hidden" name="thumb" id="thumb">

        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="name" value="{{$customer->name}}">
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <div class="d-flex align-items-center">
                    <input type="email" class="form-control" id="email" name="email" value="{{$customer->email}}">
                </div>
            </div>

            <div class="col-md-6">
                <label for="phone" class="form-label">Phone Number</label>
                <div class="d-flex align-items-center">
                    <input type="text" class="form-control" id="phone" name="phone" value="{{$customer->phone}}">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-danger">Save</button>
    </form>
</div>
@endsection

@section('footer')

<script>
    window.onload = function() {
        var profileImage = document.getElementById('profileImage');

        // Lấy dữ liệu từ Laravel, cần đảm bảo dữ liệu được chuyển đúng cách
        var imageUrl = "{{ $customer->avatar ? '/storage/uploads/' . $customer->avatar : '' }}"; // Kiểm tra nếu có avatar

        // Nếu có đường dẫn ảnh, sử dụng nó, ngược lại hiển thị ảnh mặc định
        if (imageUrl) {
            profileImage.src = imageUrl;
        } else {
            profileImage.src = "https://placehold.co/100x100"; // Hình ảnh mặc định
        }
    };

    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('profileImage').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]); // Read the file

            var formData = new FormData();
            formData.append('thumb', input.files[0]);

            fetch('{{ route("upload.servicesCus") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                    if (data.success) {
                        const imageUrl = '/storage/' + data.filePath;
                        console.log(data.filePath);

                        // Update the profile image source
                        document.getElementById('profileImage').src = imageUrl;

                        document.getElementById('thumb').value = data.thumb;
                        console.log('Thành công:', data.thumb);

                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        }
    }
</script>
@endsection
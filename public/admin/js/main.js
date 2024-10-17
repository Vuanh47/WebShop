$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


//upload file
// $('#upload').change(function previewImage(input) {
//     if (input.files && input.files[0]) {
//         var reader = new FileReader();
//         reader.onload = function (e) {
//             document.getElementById('imagePreview').style.backgroundImage = 'url(' + e.target.result + ')';
//         }
//         reader.readAsDataURL(input.files[0]);
        
//         // Gửi dữ liệu lên route update bằng AJAX
//         var formData = new FormData();
//         formData.append('thumb', input.files[0]); // Lấy file ảnh đã chọn

//         // Gọi AJAX để gửi dữ liệu lên route update
//         fetch('{{ route("update.product") }}', {
//             method: 'POST',
//             headers: {
//                 'X-CSRF-TOKEN': '{{ csrf_token() }}' // Đính kèm CSRF token cho bảo mật
//             },
//             body: formData
//         })
//         .then(response => response.json())
//         .then(data => {
//             console.log('Thành công:', data);
//         })
//         .catch((error) => {
//             console.error('Lỗi:', error);
//         });
//     }
// }
// );



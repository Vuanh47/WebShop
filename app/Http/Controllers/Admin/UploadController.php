<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; // Thay 'YourModel' bằng model của bạn

class UploadController extends Controller
{
    public function update(Request $request)
    {
        if ($request->hasFile('thumb')) {
            $file = $request->file('thumb');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads', $filename, 'public');
            $thumb = str_replace('uploads/', '', $path);
            return response()->json([
                'success' => 'Ảnh đã được tải lên thành công!',
                'filePath' => $path,
                'thumb' => $thumb
            ]);
        }
    
        return response()->json(['error' => 'Không tìm thấy file!'], 400);
    }
    
}






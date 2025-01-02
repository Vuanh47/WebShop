<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; // Thay 'YourModel' bằng model của bạn

class UploadController extends Controller
{
    public function update(Request $request)
    {
        try {
            if ($request->hasFile('thumb')) {
                $file = $request->file('thumb');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('uploads', $filename, 'public');
                $thumb = str_replace('uploads/', '', $path);

                return response()->json([
                    'success' => true,
                    'message' => 'Ảnh đã được tải lên thành công!',
                    'filePath' => $path,
                    'thumb' => $thumb,
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy file để upload!',
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi: ' . $e->getMessage(),
            ], 500);
        }
    }
}

@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Active</th>
                <th>Update</th>
                <th>Hình Ảnh</th>
                <th>Actions</th> <!-- Tiêu đề cho cột hành động -->
            </tr>
        </thead>
        <tbody>
            <?php
            // Định nghĩa hàm renderMenu trong view
            function renderMenu($menus, $parent_id = 0, $char = '') {
                $html = '';

                foreach ($menus as $key => $menu) {
                    if ($menu->parent_id == $parent_id) {
                        // Kiểm tra giá trị active và tạo HTML tương ứng
                        $activeButton = $menu->active == 1 
                            ? '<button class="btn btn-success btn-sm">Yes</button>' 
                            : '<button class="btn btn-danger btn-sm">No</button>';
                
                        $html .= '
                            <tr>
                                <td>' . $menu->id . '</td>
                                <td>' . $char . $menu->name . '</td>
                                <td>' . $activeButton . '</td>
                                <td>' . $menu->updated_at . '</td>
                                <td><a href="/storage/uploads/' . $menu->thumb . '"><img src="/storage/uploads/' . $menu->thumb . '" width="100px"></a></td>

                                <td>
                                    <a href="' . route('menu.edit', $menu->id) . '" class="btn btn-warning btn-sm" title="Sửa">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="' . route('menu.destroy', $menu->id) . '" method="POST" style="display:inline-block;" onsubmit="return confirm(\'Bạn có chắc chắn muốn xóa?\')">
                                        ' . csrf_field() . '
                                        ' . method_field('DELETE') . '
                                        <button type="submit" class="btn btn-danger btn-sm" title="Xóa">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        ';
                
                        unset($menus[$key]);
                        $html .= renderMenu($menus, $menu->id, $char . '--'); // Gọi lại hàm để render menu con
                    }
                }
                

                return $html; // Trả về chuỗi HTML
            }
            ?>
            <!-- Gọi hàm renderMenu để hiển thị danh sách menu -->
            {!! renderMenu($menus) !!}
        </tbody>
    </table>
@endsection

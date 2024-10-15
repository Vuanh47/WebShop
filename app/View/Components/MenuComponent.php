<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ListComponent extends Component // Đổi tên class ở đây
{
    public $menus;
    public $parentId;
    public $char;

    public function __construct($menus, $parentId = 0, $char = '')
    {
        $this->menus = $menus;
        $this->parentId = $parentId;
        $this->char = $char;
    }

    public function render()
    {
        return view('components.list', [ // Cập nhật đường dẫn tới view
            'menus' => $this->menus,
            'parentId' => $this->parentId,
            'char' => $this->char,
        ]);
    }
}

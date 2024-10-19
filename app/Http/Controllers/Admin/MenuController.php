<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Service\Menu\MenuService;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected $menuService;


    public function __construct(MenuService $menuService){
        $this->menuService = $menuService;
    }

    public function create(){
        return view('admin.menu.add',[
            'title' => 'Thêm Danh Mục',
            'menus' => $this->menuService->getParent(),
        ]);
    }

    public function store(CreateFormRequest $request){
       $result = $this->menuService->creat($request);

       return redirect()->back();
    }

    public function index(){
        return view('admin.menu.list',[
            'title' =>'Danh Sách Danh Mục',
            'menus' => $this->menuService->getAll()    
        ]);
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $menus = Menu::all(); // Danh sách tất cả các danh mục
        return view('admin.menu.edit', [
            'menu' => $menu, // Truyền danh mục hiện tại
            'menus' => $menus, // Truyền danh sách các danh mục
            'title' => 'Chỉnh sửa Danh Mục'
        ]);
        

    }

    public function update(Request $request, $id)
    {
        // Xử lý cập nhật menu
        $menu = Menu::findOrFail($id);
        $menu->update($request->all());
        return redirect()->route('menu.list')->with('success', 'Menu updated successfully!');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return redirect()->route('menu.list')->with('success', 'Menu deleted successfully!');
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateFormRequest;
use App\Http\Service\Menu\MenuService;
use App\Http\Service\Product\ProductService;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;
    protected $menuService;  // Không cần chỉ định kiểu MenuService ở đây

    public function __construct(ProductService $productService, MenuService $menuService){
        $this->productService = $productService;
        $this->menuService = $menuService;  // Khởi tạo menuService
    }
    
    public function create()
    {
        return view('admin.products.add', [
            'title' => 'Thêm Sản Phẩm',
            'imageUrl' => '',
            'menus' => $this->menuService->getAll(),
        ]);
    }

    public function store(CreateFormRequest $request)
    {
        $result = $this->productService->creat($request);
        return redirect()->back();
    }

    public function index(){
        return view('admin.products.list',[
            'title' =>'Danh Sách Sản Phẩm',
            'products' => $this->productService->getAll()    
        ]);
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
         // Lấy đường dẫn của file ảnh
         $imagePath = public_path('storage\\uploads\\' . $product->thumb);
        
        // Kiểm tra xem file ảnh có tồn tại không và xóa nó
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        
        $product->delete();
        return redirect()->route('product.list')->with('success', 'Product deleted successfully!');
     }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $products = Product::all(); 
         // Tạo biến img với đường dẫn đến hình ảnh tương ứng
        $imageUrl = '/storage/uploads/' . $product->thumb;
        return view('admin.products.edit', [
            'imageUrl' => $imageUrl,
            'product' => $product, // Truyền danh mục hiện tại
            'products' => $products, // Truyền danh sách các danh mục
            'title' => 'Chỉnh sửa Danh Mục'
        ]);
        

    }

    public function update(Request $request, $id)
    {
        // Xử lý cập nhật menu
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return redirect()->route('product.list')->with('success', 'Menu updated successfully!');
    }

}


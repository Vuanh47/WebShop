<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateFormRequest;
use App\Http\Service\Menu\MenuService;
use App\Http\Service\Product\ProductService;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        return redirect()->route('product.list');
    }

    public function index(){
        return view('admin.products.list',[
            'title' =>'Danh Sách Sản Phẩm',
            'products' => $this->productService->getAll()    
        ]);
    }

    public function search(Request $request)
    {
        $products = $this->productService->getAll();
        
        $searchTerm = $request->input('query');
 

       
        $products = Product::query();
        if(!empty($searchTerm)){

            $products = $products->where(function ($query) use ($searchTerm) {
                $query->where('name', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('description', 'LIKE', "%{$searchTerm}%");
            });
        }

        $products = $products->paginate(10);
        return view('admin.products.list', [
            'products' => $products,
            'searchTerm' => $searchTerm,
            'title' =>'Danh Sách Sản Phẩm',
         
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
        $imageUrl = '/storage/uploads/' . $product->thumb;
        return view('admin.products.edit', [
            'imageUrl' => $imageUrl,
            'product' => $product, 
            'products' => $products, 
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
    public function getProductDetails($id)
{
    try {
        $product = Product::with('blogs')->findOrFail($id);

        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'thumb' => $product->thumb,
            'price_sale' => formatCurrency($product->price_sale),
            'price' => formatCurrency($product->price),

            'description' => $product->description,
            'content' => $product->content,
            'quantity' =>$product->quantity,
            'rating' => $product->blogs->avg('star') ?? 0,
        ]);
    } catch (\Exception $e) {
        Log::error($e->getMessage());

        return response()->json(['error' => 'Failed to fetch product details'], 500);
    }
}


}


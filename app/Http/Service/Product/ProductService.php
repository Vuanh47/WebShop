<?php

namespace App\Http\Service\Product;

use App\Models\Product;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

 class ProductService {

    function store(){
        
    }

    public function getAll(){
      return Product::orderByDesc('id')->paginate(20);
  }
    public function creat($request){
      try {

           Product::create([
              'name' =>(string) $request->input('name'),
              'category' =>(string) $request->input('category'),
              'description' =>(string) $request->input('description'),
              'content' =>(string) $request->input('content'),
              'active' =>(string) $request->input('active'),
              'price' =>(string) $request->input('price'),
              'price_sale' =>(string) $request->input('price_sale'),
              'thumb' =>(string) $request->input('thumb'),
              
          ]);

          Session::flash('success', 'Tạo Sản Phẩm Thành Công');
      } catch (\Exception $err) {
          Session::flash('error', $err->getMessage());
          return false;
      }
      return true;
  }

 }


 




<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Service\Product\UploadService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   protected $uploadService;
    // public function __construct( $uploadService){
    //     $this->uploadService = $uploadService;
    // }
    
    public function create()
    {
        return view('admin.products.add',[
            'title' => 'Thêm Sản Phẩm',
            'imageUrl' =>''
            
        ]);
    }
    
    // public function store(Request $request)
    // {
    //     $result = $this->uploadService->creat($request);

    //     return redirect()->back();
    // }


    public function index()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     */

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Slider\CreateFormRequest;
use App\Http\Service\Slider\SliderService;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller{
    protected $sliderService;
    public function __construct(SliderService $sliderService){
        $this->sliderService = $sliderService;
    }
    public function create(){
        return view('admin.sliders.add',[
            'title' => 'Thêm Slider',
            'imageUrl' =>''
        ]);
    }

    
    public function store(CreateFormRequest $request){
        $result =$this->sliderService->creat($request);
        return redirect()->back();
        
    }

    public function index(){

        return view('admin.sliders.list',[
            'title' =>'Danh Sách Slider',
            'sliders' => $this->sliderService->getAll()
        ]);
    }

    public  function destroy($id){
        $slider= Slider::findOrFail($id);

        $imagePath = public_path('\\storage\\uploads\\' . $slider->thumb);
        if(file_exists($imagePath)){
            unlink($imagePath);
        }

        $slider->delete();
        return redirect()->route('slider.list')->with('success' ,'Slider deleted success');
    }

    public function edit($id){
        $slider = Slider::findOrFail($id);
        $sliders = Slider::all();
        $imageUrl = '/storage/uploads/'.$slider->thumb;

        return view('admin.sliders.edit',[
            'title' => 'Chỉnh Sửa Slider',
            'slider' => $slider,
            'sliders' => $sliders,
            'imageUrl' => $imageUrl
        ]);
    }

    public function update(Request $request,$id){
        $slider = Slider::findOrFail($id);
        $slider->update($request->all());
        return redirect()->route('slider.list')->with('success', 'Menu updated successfully!');
    }
}
<?php
namespace App\Http\Service\Slider;
use App\Models\Slider;
use Illuminate\Support\Facades\Session;

class SliderService{

    public function creat($request){
        try {
  
            Slider::create([
                'name' =>(string) $request->input('name'),
                'url' =>(string) $request->input('url'),
                'sort_by' =>(string) $request->input('sort_by'),
                'active' =>(string) $request->input('active'),
                'thumb' =>(string) $request->input('thumb'),
                
            ]);
  
            Session::flash('success', 'Tạo Slider Thành Công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }

    function getAll(){
        return Slider::orderByDesc('id')->paginate(20);
    }
}
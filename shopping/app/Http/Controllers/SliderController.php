<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderAddRequest;
use App\Slider;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;


class SliderController extends Controller
{
    use StorageImageTrait;
    private $slider;
    function __construct(Slider $slider) {
        $this->slider=$slider;
    }
    function index() {
        $sliders = $this->slider->latest()->paginate(5);
        return View('admin.slider.index',compact('sliders'));
    }
    function create() {
        return View('admin.slider.add');
    }
    function store(SliderAddRequest $request) {
        try {
            $dataSliderCreate = [
                'name' => $request->name,
                'description' => $request->description
            ];
            $data = $this->storageTraitUpload($request, 'image_path', 'slider');
            if (isset($data)) {
                $dataSliderCreate['image_path'] = $data['file_path'];
                $dataSliderCreate['image_name'] = $data['file_name'];
            }
            $this->slider->create($dataSliderCreate);
            return redirect()->route('sliders.index');
        }
        catch (\Exception $exception) {
            Log::error('Message'.$exception->getMessage().'Line:'.$exception->getLine());
        }
    }
    function edit($id) {
        $sliders = $this->slider->find($id);
        return View('admin.slider.edit',compact('sliders'));
    }
    function update(Request $request,$id) {
        try {
            $dataUpdate = [
                'name' =>  $request->name,
                'description' => $request->description
            ];
            $data = $this->storageTraitUpload($request,'image_path','slider');
            if(isset($data)) {
                $dataUpdate['image_path'] = $data['file_path'];
                $dataUpdate['image_name'] = $data['file_name'];
            }
            $this->slider->find($id)->update($dataUpdate);
            return redirect()->route('sliders.index');
        }
        catch (\Exception $exception) {
            Log::error('Message'.$exception->getMessage().'Line:'.$exception->getLine());
        }
    }
    function delete($id) {
        try {
            $this->slider->find($id)->delete();
            return response()->json([
                'code'=>200,
                'message'=>'success',
            ],200);
        }
        catch (\Exception $exception) {
            Log::error('Message'.$exception->getMessage().'Line:'.$exception->getLine());
            return response()->json([
                'code'=>500,
                'message'=>'fail',

            ],500);
        }
    }

}

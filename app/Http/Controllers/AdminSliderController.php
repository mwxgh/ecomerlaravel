<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SliderAddRequest;
use App\Models\Slider;
use App\Traits\StorageImageTrait;
use App\Traits\DeleteModelTrait;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AdminSliderController extends Controller
{
    use StorageImageTrait,DeleteModelTrait;
    private $slider;
    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }
    public function index()
    {
        $sliders = $this->slider->latest()->paginate(10);
        return view('admin.slider.index',compact('sliders'));
    }
    public function create()
    {
        return view('admin.slider.create');
    }
    public function store(SliderAddRequest $request)
    {
        try {
            DB::beginTransaction();
            $dataSliderCreate =[
                'name'=>$request->name,
                'description'=>$request->description
            ];
            $dataImage = $this->storageTraitUpload($request,'image_path','slider_img');
            if (!empty($dataImage)) {
                $dataSliderCreate['image_name'] = $dataImage['file_name'];
                $dataSliderCreate['image_path'] = $dataImage['file_path'];
            }
            $this->slider->create($dataSliderCreate);
            DB::commit();
            return redirect()->route('sliders.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message :' . $e->getMessage() . ' --- line :' .$e->getLine());
        }
    }
    public function edit($id)
    {
        $slider = $this->slider->find($id);
        return view('admin.slider.edit',compact('slider'));
    }
    public function update(Request $request,$id)
    {
        try {
            DB::beginTransaction();
            $dataSliderUpdate =[
                'name'=>$request->name,
                'description'=>$request->description
            ];
            $dataImage = $this->storageTraitUpload($request,'image_path','slider_img');
            if (!empty($dataImage)) {
                $dataSliderUpdate['image_name'] = $dataImage['file_name'];
                $dataSliderUpdate['image_path'] = $dataImage['file_path'];
            }
            $this->slider->find($id)->update($dataSliderUpdate);
            DB::commit();
            return redirect()->route('sliders.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message :' . $e->getMessage() . ' --- line :' .$e->getLine());
        }
    }
    public function delete($id)
    {
        return $this->deleteModelTrait($id,$this->slider);
    }
}

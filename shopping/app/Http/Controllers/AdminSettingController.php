<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingAddRequest;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class AdminSettingController extends Controller
{
    private $setting;
    function __construct(Setting $setting) {
        $this->setting = $setting;
    }
    function index() {
        $settings = $this->setting->latest()->paginate(5);
        return View('admin.setting.index',compact('settings'));
    }
    function create() {
        return View('admin.setting.add');
    }
    function store(SettingAddRequest $request) {
        $this->setting->create([
           'config_key'=>$request->config_key,
            'config_value'=>$request->config_value,
            'type'=>$request->type
        ]);
        return redirect()->route('settings.index');
    }
    function edit($id) {
        $setting = $this->setting->find($id);
        return View('admin.setting.edit',compact('setting'));
    }
    function update(Request $request,$id) {
        $this->setting->find($id)->update([
            'config_key'=>$request->config_key,
            'config_value'=>$request->config_value,
            'type'=>$request->type
        ]);
        return redirect()->route('settings.index');
    }
    function delete($id) {
        try {
            $this->setting->find($id)->delete();
            return response()->json([
                'code'=>200,
                'message'=>'success',

            ],200);
        }
        catch (\Exception $ex) {
            Log::error('Message'.$ex->getMessage());
            return response()->json([
                'code'=>500,
                'message'=>'fail',

            ],500);
        }
    }
}

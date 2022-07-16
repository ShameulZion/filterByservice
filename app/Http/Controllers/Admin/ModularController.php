<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class ModularController extends Controller
{
    public function index()
    {
        return view('admin.module.index');
    }

    public function addBanner(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            
            $request->validate([
                'name' => 'required|string',
                'setting' => 'required|array',
                'setting.*.banner' => 'required',
                'setting.*.width' => 'required|string',
                'setting.*.height' => 'required|string',
                'setting.*.status' => 'required'
            ]);

            
            $banner = Banner::create([
                'name' => $request->name,
                'setting' => 
                [
                    'banner' => $request->banner, 
                    'width' => $request->width, 
                    'height' => $request->height, 
                    'status' => $request->status
                ],
            ]);
            return redirect()->back()->with('flash_message_success', 'Banner Module added Successfully');
        }
        $data['banners'] = Banner::where('status',true)->get();
        return view('admin.module.add-banner',$data);
    }
}

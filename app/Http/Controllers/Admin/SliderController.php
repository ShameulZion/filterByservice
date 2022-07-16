<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\SliderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('admin.banner.index');
        $data['sliders'] = Slider::latest()->get();
        return view('admin.slider.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slider = Slider::create([
            'user_id' => auth()->user()->id,
            'slider_name' => $request->slider_name,
            'status' => $request->status,
        ]);
        notify()->success('Slider Successfully Added.', 'Added');
        return redirect()->route('admin.slider.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $slider->update([
            'user_id' => auth()->user()->id,
            'slider_name' => $request->slider_name,
            'status' => $request->status,
        ]);
        notify()->success('Slider Successfully Updated.', 'Updated');
        return redirect()->route('admin.slider.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        notify()->success('Slider Successfully Deleted.', 'Deleted');
        return redirect()->back();
    }


    public function addSlide($id)
    {
        $slider = Slider::findOrFail($id);
        $items = SliderItem::latest()->get();
        return view('admin.slider.item.index',compact('slider','items'));
    }


    public function itemCreate($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.item.form',compact('slider'));
    }

    public function itemStore(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);
        $sliderItem = SliderItem::create([
            'slider_id' => $slider->id,
            'title' => $request->title,
            'buttonText' => $request->buttonText,
            'buttonUrl' => $request->buttonUrl,
            'status' => $request->status,
        ]);
        if ($request->hasFile('image')) {
            $sliderItem->addMedia($request->image)->toMediaCollection('image');
        }
        notify()->success('Slider Item Successfully Added.', 'Added');
        return redirect()->route('admin.slider.slide-list',$slider->id);
    }

    /**
     * Edit menu item
     * @param $menuId
     * @param $itemId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function itemEdit($sliderId, $itemId)
    {
        $slider = Slider::findOrFail($sliderId);
        $sliderItem = $slider->sliderItems()->findOrFail($itemId);
        return view('admin.slider.item.form',compact('slider','sliderItem'));
    }
    

    /**
     * Update menu item
     * @param Request $request
     * @param $menuId
     * @param $itemId
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function itemUpdate(Request $request, $sliderId, $itemId)
    {
        $slider = Slider::findOrFail($sliderId);
        $slider->sliderItems()->findOrFail($itemId)->update([
            'slider_id' => $slider->id,
            'title' => $request->title,
            'buttonText' => $request->buttonText,
            'buttonUrl' => $request->buttonUrl,
            'status' => $request->status,
        ])->addMedia($request->image)->toMediaCollection('image');
        notify()->success('Slide Item Successfully Updated.', 'Updated');
        return redirect()->route('admin.slider.slide-list',$slider->id);
    }

    /**
     * Delete a menu item
     * @param $menuId
     * @param $itemId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function itemDestroy($sliderId, $itemId)
    {
        Slider::findOrFail($sliderId)
            ->sliderItems()
            ->findOrFail($itemId)
            ->delete();
        notify()->success('Slider Item Successfully Deleted.', 'Deleted');
        return redirect()->back();
    }
}


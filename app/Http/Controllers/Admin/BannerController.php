<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\BannerItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Banner\CreateBannerRequest;
use App\Http\Requests\Banner\UpdateBannerRequest;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('admin.banner.index');
        $data['banners'] = Banner::latest()->get();
        return view('admin.banner.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('admin.banner.create');
        return view('admin.banner.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $banner = Banner::create([
            'user_id' => auth()->user()->id,
            'banner_name' => $request->banner_name,
            'status' => $request->status,
        ]);
    
        notify()->success('Banner Successfully Added.', 'Added');
        return redirect()->route('admin.banner.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        Gate::authorize('admin.banner.create');
        return view('admin.banner.form')->with(compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $banner->update([
            'user_id' => auth()->user()->id,
            'banner_name' => $request->banner_name,
            'status' => $request->status,
        ]);

        notify()->success('Banner Successfully Updated.', 'Updated');
        return redirect()->route('admin.banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        Gate::authorize('admin.banner.destroy');
        if ($role->deletable) {
            $banner->delete();
            notify()->success("Banner Successfully Deleted", "Deleted");
        } else {
            notify()->error("You can\'t delete system banner.", "Error");
        }
        return back();
    }

    public function addBanner($id)
    {
        $banner = Banner::findOrFail($id);
        $items = BannerItem::where('banner_id',$banner->id)->latest()->get();
        return view('admin.banner.item.index',compact('banner','items'));
    }


    public function itemCreate($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banner.item.form',compact('banner'));
    }

    public function itemStore(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);
        $item = BannerItem::create([
            'banner_id' => $banner->id,
            'title' => $request->title,
            'url' => $request->url,
            'sort_order' => $request->sort_order,
        ]);
        if ($request->hasFile('image')) {
            $item->addMedia($request->image)->toMediaCollection('image');
        }
        notify()->success('Banner Item Successfully Added.', 'Added');
        return redirect()->route('admin.banner.banner-list',$banner->id);
    }

    /**
     * Edit menu item
     * @param $menuId
     * @param $itemId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function itemEdit($bannerId, $itemId)
    {
        $banner = Banner::findOrFail($bannerId);
        $bannerItem = $banner->bannerItems()->findOrFail($itemId);
        return view('admin.banner.item.form',compact('banner','bannerItem'));
    }
    

    /**
     * Update menu item
     * @param Request $request
     * @param $menuId
     * @param $itemId
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function itemUpdate(Request $request, $bannerId, $itemId)
    {
        $banner = Banner::findOrFail($bannerId);
        $banner->bannerItems()->findOrFail($itemId)->update([
            'banner_id' => $banner->id,
            'title' => $request->title,
            'url' => $request->url,
            'sort_order' => $request->sort_order,
        ]);
        if ($request->hasFile('image')) {
            $banner->bannerItems()->findOrFail($itemId)->addMedia($request->image)->toMediaCollection('image');
        }
        notify()->success('Banner Item Successfully Updated.', 'Updated');
        return redirect()->route('admin.banner.banner-list',$banner->id);
    }

    /**
     * Delete a menu item
     * @param $menuId
     * @param $itemId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function itemDestroy($bannerId, $itemId)
    {
        Banner::findOrFail($bannerId)
            ->bannerItems()
            ->findOrFail($itemId)
            ->delete();
        notify()->success('Banner Item Successfully Deleted.', 'Deleted');
        return redirect()->back();
    }
}

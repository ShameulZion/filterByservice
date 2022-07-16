<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Page\CreatePageRequest;
use App\Http\Requests\Page\UpdatePageRequest;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pages'] = Page::where('parent_id','0')->latest()->get();
        return view('admin.page.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pages'] = Page::where('parent_id','0')->latest()->get();
        return view('admin.page.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePageRequest $request)
    {
        $page = Page::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keyword' => $request->meta_keyword,
            'sort_order' => $request->sort_order,
            'parent_id' => $request->parent_id,
            'status' => $request->status,
            'top' => $request->filled('top'),
        ]);
        if ($request->hasFile('image')) {
            $fileAdders = $page->addMultipleMediaFromRequest(['image'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('image');
                });
        }
        notify()->success('Page Successfully Added.', 'Added');
        return redirect()->route('admin.page.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {        
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $data['pages'] = Page::where('parent_id','0')->latest()->get();
        return view('admin.page.form', $data)->with(compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        $page->update([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keyword' => $request->meta_keyword,
            'sort_order' => $request->sort_order,
            'parent_id' => $request->parent_id,
            'status' => $request->status,
            'top' => $request->filled('top'),
        ]);
        if ($request->hasFile('image')) {
            $fileAdders = $page->addMultipleMediaFromRequest(['image'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('image');
                });
        }
        notify()->success('Page Successfully Updated.', 'Updated');
        return redirect()->route('admin.page.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
    }
}

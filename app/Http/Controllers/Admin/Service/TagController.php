<?php

namespace App\Http\Controllers\Admin\Service;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Tag\CreateTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('tag.index');
        $data['tags'] = Tag::latest()->where('type','service')->get(['id','title','slug']);
        return view('admin.service.tag.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('tag.create');
        return view('admin.service.tag.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTagRequest $request)
    {
        $tags = Tag::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'slug' => SlugService::createSlug(Tag::class, 'slug', $request->title),
            'type' => "service",
            'description' => $request->description,
            'status' => $request->filled('status'),
        ]);
        notify()->success('Tag Successfully Added.', 'Added');
        return redirect()->route('tag.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        Gate::authorize('tag.edit');
        return view('admin.service.tag.form')->with(compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->update([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'type' => "service",
            'description' => $request->description,
            'status' => $request->filled('status'),
        ]);
        notify()->success('Tag Successfully Updated.', 'Updated');
        return redirect()->route('tag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        Gate::authorize('tag.destroy');
        $tag->delete();
        notify()->success("Tag Successfully Deleted", "Deleted");
        return back();
    }


    public function chceckSlug(Request $request)
    {
        $slug = SlugService::createSlug(Tag::class, 'slug', $request->title);
        return response()->json(['slug'=>$slug]);
    }
}

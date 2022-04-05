<?php

namespace App\Http\Controllers\Admin\Service;

use App\Http\Controllers\Controller;
use Image;
use File;
use App\Models\Category;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\FilterProfile;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('category.index');
        $data['categories'] = Category::with('department')->latest()->where('parent_id', 0)->where('type','service')->get(['id','department_id','title','slug','image']);
        return view('admin.service.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('category.create');
        $data['categories'] = Category::where('parent_id', 0)->where('type','service')->get(['id','title']);
        $data['departments'] = Department::where('type','service')->get(['id','title']);
        $data['filter_profiles'] = FilterProfile::orderBy('sort_order','DESC')->get(['id','title']);
        return view('admin.service.category.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $request->title);
        if($request->hasFile('image')){
            $image_tmp = $request->file('image');
            if ($image_tmp->isValid()) {
                // Upload Images after Resize
                $extension = $image_tmp->getClientOriginalExtension();
                $fileName = $slug.'.'.$extension;
                $path = 'media/category/'.$fileName;
                Image::make($image_tmp)->save($path);
            }
        }
        $category = Category::create([
            'user_id'       => auth()->user()->id,
            'department_id' => $request->department_id,
            'title'         => $request->title,
            'slug'          => $slug,
            'type'          => "service",
            'parent_id'     => $request->parent_id,
            'description'   => $request->description,
            'status'        => $request->filled('status'),
            'image'        => $fileName,
        ]);
        $category->filterProfiles()->sync($request->input('filterProfiles', []));
        notify()->success('Category Successfully Added.', 'Added');
        return redirect()->route('category.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        Gate::authorize('category.edit');
        $data['categories'] = Category::where('parent_id', 0)->where('type','service')->get();
        $data['departments'] = Department::where('type','service')->get(['id','title']);
        $data['filter_profiles'] = FilterProfile::orderBy('sort_order','DESC')->get(['id','title']);
        return view('admin.service.category.form', $data)->with(compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {       
        if($request->hasFile('image')){
            $image_tmp = $request->file('image');
            if ($image_tmp->isValid()) {
                // Delete old image if exists
                $imagePath = public_path('media/category/'.$category->avatar);
                if(File::exists($imagePath)){
                    File::delete($imagePath);
                }
                $extension = $image_tmp->getClientOriginalExtension();
                $fileName = Str::slug($request->title).'.'.$extension;
                $path = 'media/category/'.$fileName;
                Image::make($image_tmp)->save($path);
            }
        }
        $category->update([
            'user_id'       => auth()->user()->id,
            'title'         => $request->title,
            'type'          => "service",
            'parent_id'     => $request->parent_id,
            'description'   => $request->description,
            'status'        => $request->filled('status'),
            'image'        => $fileName,
        ]);
        $category->filterProfiles()->sync($request->input('filter_profiles', []));
        notify()->success('Category Successfully Updated.', 'Updated');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $imagePath = public_path('media/category/'.$category->image);
        if(File::exists($imagePath)){
            File::delete($imagePath);
        }
        $category->delete();
        notify()->success("Category Successfully Deleted", "Deleted");
        return back();
    }

    /**
     * Creating not duplicate slug
     *
     * @return \Illuminate\Http\Response
     */
    public function chceckSlug(Request $request)
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $request->title);
        return response()->json(['slug'=>$slug]);
    }
}

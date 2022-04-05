<?php

namespace App\Http\Controllers\Admin\Service;

use App\Http\Controllers\Controller;
use File;
use DB;
use Image;
use App\Models\Tag;
use App\Models\Filter;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\FilterProfile;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Service\CreateServiceRequest;
use App\Http\Requests\Service\UpdateServiceRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('service.index');
        $data['services'] = Service::latest()->get();
        return view('admin.service.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('service.create');
        $data['categories'] = Category::where('status', true)->where('type','service')->latest()->get(['id','title']);
        $data['tags'] = Tag::where('status', true)->where('type','service')->latest()->get(['id','title']);
        $data['filter_profiles'] = FilterProfile::orderBy('sort_order','DESC')->get(['id','title']);
        return view('admin.service.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateServiceRequest $request)
    {
        Gate::authorize('service.create');
        $slug = SlugService::createSlug(Service::class, 'slug', $request->title);
        if($request->hasFile('featured_image')){
            $image_tmp = $request->file('featured_image');
            if ($image_tmp->isValid()) {
                // Upload Images after Resize
                $extension = $image_tmp->getClientOriginalExtension();
                $fileName = $slug.'.'.$extension;
                $path = 'media/service/'.$fileName;
                Image::make($image_tmp)->save($path);
            }
        }
        $service = Service::create([
            'user_id'           => auth()->user()->id,
            'title'             => $request->title,
            'slug'              => $slug,
            'category_id'       => $request->category_id,
            'short_description' => $request->short_description,
            'long_description'  => $request->long_description,
            'order'             => $request->order,
            'preview'           => $request->preview,
            'envato'            => $request->envato,
            'status'            => $request->filled('status'),
            'featured_image'    => $fileName,
        ]);
        $service->tags()->attach($request->tags);
        $service->categories()->attach($request->categories);
        $service->filterProfiles()->sync($request->input('filter_profiles', []));
        notify()->success('Service Successfully Added.', 'Added');
        return redirect()->route('service.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return view('admin.service.show')->with(compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $data['categories'] = Category::where('status', true)->where('type','service')->latest()->get(['id','title']);
        $data['tags'] = Tag::where('status', true)->where('type','service')->latest()->get(['id','title']);
        $data['filter_profiles'] = FilterProfile::orderBy('sort_order','DESC')->get(['id','title']);
        return view('admin.service.form',$data)->with(compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        if($request->hasFile('featured_image')){
            $image_tmp = $request->file('featured_image');
            if ($image_tmp->isValid()) {
                // Delete old image if exists
                $imagePath = public_path('media/service/'.$service->featured_image);
                if(File::exists($imagePath)){
                    File::delete($imagePath);
                }
                $extension = $image_tmp->getClientOriginalExtension();
                $fileName = Str::slug($request->title).'.'.$extension;
                $path = 'media/service/'.$fileName;
                Image::make($image_tmp)->save($path);
            }
        }
        $service->update([
            'user_id'           => auth()->user()->id,
            'title'             => $request->title,
            'category_id'       => $request->category_id,
            'short_description' => $request->short_description,
            'long_description'  => $request->long_description,
            'order'             => $request->order,
            'preview'           => $request->preview,
            'envato'            => $request->envato,
            'status'            => $request->filled('status'),
            'featured_image'    => $fileName,
        ]);
        $service->tags()->sync($request->tags);
        $service->categories()->sync($request->categories);
        $service->filterProfiles()->sync($request->input('filter_profiles', []));
        notify()->success('Service Successfully Updated.', 'Updated');
        return redirect()->route('service.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
    }


    public function chceckSlug(Request $request)
    {
        $slug = SlugService::createSlug(Service::class, 'slug', $request->title);
        return response()->json(['slug'=>$slug]);
    }

    public function chceckFilter(Request $request)
    {
        $filter_profile_id = $request->filter_profile_id;

        $filters = DB::table('filter_filter_profile')
                 ->where('filter_profile_id',$filter_profile_id)
                 ->join('filters','filters.id','=','filter_filter_profile.filter_id')
                 ->join('filter_groups','filter_groups.filter_id','=','filters.id')
                 ->select('filters.group_name','filter_groups.id','filter_groups.order','filter_groups.filter_name')
                 ->orderBy('filter_groups.order','asc')
                 ->get();

        return \Response::json($filters);
    }
}

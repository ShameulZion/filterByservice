<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Testimonial\CreateTestimonialRequest;
use App\Http\Requests\Testimonial\UpdateTestimonialRequest;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('admin.testimonial.index');
        $data['testimonials'] = Testimonial::latest()->get();
        return view('admin.testimonial.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('admin.testimonial.create');
        return view('admin.testimonial.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTestimonialRequest $request)
    {
        $testimonial = Testimonial::create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'designation' => $request->designation,
            'company' => $request->company,
            'description' => $request->description,
            'sort_order' => $request->sort_order,
            'status' => $request->status,
        ]);
        if ($request->hasFile('image')) {
            $testimonial->addMedia($request->image)->toMediaCollection('image');
        }
        notify()->success('Testimonial Successfully Added.', 'Added');
        return redirect()->route('admin.testimonial.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        Gate::authorize('admin.testimonial.edit');
        return view('admin.testimonial.form')->with(compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial)
    {
        $testimonial->update([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'designation' => $request->designation,
            'company' => $request->company,
            'description' => $request->description,
            'sort_order' => $request->sort_order,
            'status' => $request->status,
        ]);
        if ($request->hasFile('image')) {
            $testimonial->addMedia($request->image)->toMediaCollection('image');
        }
        notify()->success('Testimonial Successfully Updated.', 'Updated');
        return redirect()->route('admin.testimonial.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        Gate::authorize('admin.testimonial.destroy');
        $testimonial->delete();        
        notify()->success("Testimonial Successfully Deleted", "Deleted");
        return back();
    }
}

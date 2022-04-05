<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Department\CreateDepartmentRequest;
use App\Http\Requests\Department\UpdateDepartmentRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('department.index');
        $data['departments'] = Department::latest()->where('type','service')->get();
        return view('admin.department.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('department.create');
        return view('admin.department.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDepartmentRequest $request)
    {
        $departments = Department::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'slug' => SlugService::createSlug(Department::class, 'slug', $request->title),
            'type' => "service",
            'description' => $request->description,
            'status' => $request->filled('status'),
        ]);
        notify()->success('Department Successfully Added.', 'Added');
        return redirect()->route('department.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        Gate::authorize('department.edit');
        return view('admin.department.form')->with(compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department = Department::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'type' => "service",
            'description' => $request->description,
            'status' => $request->filled('status'),
        ]);
        notify()->success('Department Successfully Updated.', 'Updated');
        return redirect()->route('department.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        Gate::authorize('department.destroy');
        $department->delete();
        notify()->success("Department Successfully Deleted", "Deleted");
        return back();
    }

    public function chceckSlug(Request $request)
    {
        $slug = SlugService::createSlug(Department::class, 'slug', $request->title);
        return response()->json(['slug'=>$slug]);
    }
}

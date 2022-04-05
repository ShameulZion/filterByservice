<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\FilterProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FilterProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('filterProfile.index');
        $data['filterProfiles'] = FilterProfile::latest()->get();
        return view('admin.filter.profile.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('filterProfile.create');
        return view('admin.filter.profile.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('filterProfile.create');
        $request->validate([
            'title' => 'required|string|max:255|unique:filter_profiles',
        ]);
        $filterProfile = FilterProfile::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'sort_order' => $request->sort_order,
        ]);
        notify()->success('Filter Profile Successfully Added.', 'Added');
        return redirect()->route('filterProfile.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FilterProfile  $filterProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(FilterProfile $filterProfile)
    {
        Gate::authorize('filterProfile.edit');
        return view('admin.filter.profile.form')->with(compact('filterProfile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FilterProfile  $filterProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FilterProfile $filterProfile)
    {
        Gate::authorize('filterProfile.edit');
        $request->validate([
            'title' => 'required|string|max:255|unique:filter_profiles'
        ]);
        $filterProfile->update([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'sort_order' => $request->sort_order,
        ]);
        notify()->success('Filter Profile Successfully Updated.', 'Updated');
        return redirect()->route('filterProfile.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FilterProfile  $filterProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(FilterProfile $filterProfile)
    {
        Gate::authorize('filterProfile.destroy');
        $filterProfile->delete();
        notify()->success("Filter Profile Successfully Deleted", "Deleted");
        return back();
    }
}

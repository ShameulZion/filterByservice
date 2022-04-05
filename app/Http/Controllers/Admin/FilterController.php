<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Filter;
use App\Models\FilterGroup;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\FilterProfile;
use Illuminate\Support\Facades\Gate;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('filterProfile.index');
        $data['filters'] = Filter::with('filterGroups')->latest()->get();
        return view('admin.filter.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('filterProfile.create');
        $data['filterProfiles'] = FilterProfile::get(['id','title']);
        return view('admin.filter.form', $data);
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
        Gate::authorize('filterProfile.create');
        $request->validate([
            'title'         => 'required|string|max:255|unique:filters',
            'group_name'    => 'required|string|max:255',
            // 'filter_name.*' => 'integer',
            // 'filter_name'   => 'required','array',
        ]);
        $filter = Filter::create([
            'user_id'       => auth()->user()->id,
            'title'         => $request->title,
            'group_name'    => $request->group_name,
            'sort_order'    => $request->sort_order,
        ]);
        // Filter Profile Add in Filter
        $filter->filterProfiles()->sync($request->input('filterProfiles', []));

        foreach($request->filter_name as $key=>$group){
            $filterProfiles = FilterGroup::create([
                'user_id'       => auth()->user()->id,
                'filter_id'     => $filter->id,
                'filter_name'   => $request->filter_name[$key],
                'order'         => $request->order[$key],
            ]);
        }


        notify()->success('Filter Successfully Added.', 'Added');
        return redirect()->route('filter.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Filter  $filter
     * @return \Illuminate\Http\Response
     */
    public function edit(Filter $filter)
    {
        Gate::authorize('filterProfile.edit');
        $data['filterProfiles'] = FilterProfile::get(['id','title']);
        return view('admin.filter.form',$data)->with(compact('filter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Filter  $filter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Filter $filter)
    {
        Gate::authorize('filterProfile.edit');
        $request->validate([
            'title'         => 'required|string|max:255|unique:filters,title,'.$filter->id,
            'group_name'    => 'required|string|max:255',
            // 'filter_name.*' => 'integer',
            // 'filter_name'   => 'required','array',
        ]);
        $filter->update([
            'user_id'       => auth()->user()->id,
            'title'         => $request->title,
            'group_name'    => $request->group_name,
            'sort_order'    => $request->sort_order,
        ]);
        $filter->filterProfiles()->sync($request->input('filterProfiles', []));

        notify()->success('Filter Successfully Updated.', 'Updated');
        return redirect()->route('filter.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Filter  $filter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Filter $filter)
    {
        //
    }
}

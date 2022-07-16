<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Speaker;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Speaker\CreateSpeakerRequest;
use App\Http\Requests\Speaker\UpdateSpeakerRequest;

class SpeakerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('admin.speaker.index');
        $data['speakers'] = Speaker::orderBy('sort_order','asc')->get();
        return view('admin.speaker.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('admin.speaker.create');
        return view('admin.speaker.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSpeakerRequest $request)
    {
        $speaker = Speaker::create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'designation' => $request->designation,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
            'sort_order' => $request->sort_order,
            'status' => $request->status,
        ]);
        if ($request->hasFile('image')) {
            $speaker->addMedia($request->image)->toMediaCollection('image');
        }
        notify()->success('Speaker Successfully Added.', 'Added');
        return redirect()->route('admin.speaker.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Speaker  $speaker
     * @return \Illuminate\Http\Response
     */
    public function edit(Speaker $speaker)
    {
        Gate::authorize('admin.speaker.edit');
        return view('admin.speaker.form')->with(compact('speaker'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Speaker  $speaker
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSpeakerRequest $request, Speaker $speaker)
    {
        $speaker->update([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'designation' => $request->designation,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
            'sort_order' => $request->sort_order,
            'status' => $request->status,
        ]);
        if ($request->hasFile('image')) {
            $speaker->addMedia($request->image)->toMediaCollection('image');
        }
        notify()->success('Speaker Successfully Updated.', 'Updated');
        return redirect()->route('admin.speaker.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Speaker  $speaker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Speaker $speaker)
    {
        Gate::authorize('admin.speaker.destroy');
        $speaker->delete();        
        notify()->success("Speaker Successfully Deleted", "Deleted");
        return back();
    }
}

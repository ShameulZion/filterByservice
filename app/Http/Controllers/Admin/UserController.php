<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Image;
use File;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('user.index');
        $data['users'] = User::latest()->get();
        return view('admin.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('user.create');
        $data['roles'] = Role::get();
        return view('admin.user.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        // Upload Image
        if($request->hasFile('avatar')){
            $image_tmp = $request->file('avatar');
            if ($image_tmp->isValid()) {
                // Upload Images after Resize
                $extension = $image_tmp->getClientOriginalExtension();
                $fileName = Str::slug($request->name).'.'.$extension;
                $path = 'media/user/'.$fileName;
                Image::make($image_tmp)->save($path);
            }
        }
        $user = User::create([
            'role_id' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->filled('status'),
            'avatar' => $fileName,
        ]);
        notify()->success('User Successfully Added.', 'Added');
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {        
        Gate::authorize('user.edit');
        $roles = Role::get();
        return view('admin.user.form')->with(compact('roles','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {        
        Gate::authorize('user.edit');
        $roles = Role::get();
        return view('admin.user.form')->with(compact('roles','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if($request->hasFile('avatar')){
            $image_tmp = $request->file('avatar');
            if ($image_tmp->isValid()) {
                // Delete old image if exists
                $imagePath = public_path('media/user/'.$user->avatar);
                if(File::exists($imagePath)){
                    File::delete($imagePath);
                }
                $extension = $image_tmp->getClientOriginalExtension();
                $fileName = Str::slug($request->name).'.'.$extension;
                $path = 'media/user/'.$fileName;
                Image::make($image_tmp)->save($path);
            }
        }
        $user->update([
            'role_id'   => $request->role,
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => isset($request->password) ? Hash::make($request->password) : $user->password,
            'status'    => $request->filled('status'),
            'avatar'     => $fileName,
        ]);
        notify()->success('User Successfully Updated.', 'Updated');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Gate::authorize('user.destroy');
        // Delete old image if exists
        $imagePath = public_path('media/user/'.$user->avatar);
        if(File::exists($imagePath)){
            File::delete($imagePath);
        }
        $user->delete();        
        notify()->success("User Successfully Deleted", "Deleted");
        return back();
    }
}

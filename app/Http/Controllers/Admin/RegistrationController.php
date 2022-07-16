<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Register;

class RegistrationController extends Controller
{
    public function index()
    {
        $registrations = Register::latest()->get();
        return view('admin.registration.index')->with(compact('registrations'));
    }
}

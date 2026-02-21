<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;

class StaffController extends Controller
{

    public function create()
    {
        return view('admin.staff.create');
    }


    public function store(Request $request)
    {
 
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, 
            'role' => 'admin', 
        ]);


        return redirect()->route('admin.dashboard')->with('success', 'New staff account created successfully!');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    function index()
    {
        return view('index');
    }

    function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login')->with([
            'success' => 'Logout successfully',
        ]);
    }

    function login(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::where('username', $validated['username'])->first();
        if ($admin && Hash::check($validated['password'], $admin->password)) {
            Auth::guard('admin')->login($admin);
            return redirect()->route('order');
        } else {
            return back()->with([
                'error' => 'Invalid credentials',
            ]);
        }
    }
}

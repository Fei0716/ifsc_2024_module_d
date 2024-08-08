<?php

namespace App\Http\Controllers;

use App\Models\Courier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CourierController extends Controller
{
    public function create()
    {
        return view('create-courier');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'unique:couriers|required',
            'password' => 'required',
        ]);

        $courier = new Courier();
        $courier->name = $request->name;
        $courier->username = $request->username;
        $courier->password = Hash::make($request->password);
        $courier->save();

        return redirect()->route('courier.create')->with(['success' => 'New courier created successfully']);
    }

    public function index()
    {
        $couriers = Courier::all();
        return view('courier', compact('couriers'));
    }

    public function show(Courier $courier)
    {
        return view('courier-order', compact('courier'));
    }
}

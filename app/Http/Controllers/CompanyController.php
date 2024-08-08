<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    public function create()
    {
        return view('create-company');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'unique:companies|required',
            'webhook_address' => 'unique:companies|required',
        ]);

        $company = new Company();
        $company->name = $request->name;
        $company->webhook_address = $request->webhook_address;
        $company->api_key = Hash::make($request->name);
        $company->save();

        return redirect()->route('company.create')->with(['success' => 'New company created successfully', 'api_key' => $company->api_key]);
    }
}

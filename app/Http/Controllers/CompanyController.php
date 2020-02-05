<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Company;
use App\Http\Requests\StoreCompanyPost;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::where('user_id', Auth::user()->id)->get();
        return view('company.index', compact('companies'));
    }

    public function create()
    {
        return view('company.create');
    }

    public function store(StoreCompanyPost $request)
    {
        auth()->user()->companies()->create($request->all());
        return redirect()->route('company.index')->with('status', 'Company added successfully.');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

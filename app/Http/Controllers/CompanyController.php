<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Company;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::where('user_id', Auth::user()->id);
        return view('company.index', compact('companies'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        auth()->user()->company()->create($attributes);
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

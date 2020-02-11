<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Company;
use App\User;
use App\Http\Requests\StoreCompanyPost;
use App\Http\Requests\UpdateCompanyPost;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::whereHas('users', function($query) {
            $query->where('company_user.user_id', Auth::user()->id);
        })->get();
        return view('company.index', compact('companies'));
    }

    public function create()
    {
        return view('company.create');
    }

    public function store(StoreCompanyPost $request)
    {
        $company = new Company(['name' => $request->name, 'user_id' => Auth::user()->id]);
        //save the company and attach it to the user.
        $user = User::findOrFail(Auth::user()->id)->companies()->save($company);

        return redirect()->route('company.index')->with('status', 'Company added successfully.');

    }

    public function show($id)
    {
        //
    }

    public function edit(Company $company)
    {
        if ($company->user_id == Auth::user()->id) {
            $users = User::whereHas('companies', function($query) use($company) {
                $query->where('company_id', $company->id);
            })->get();

            return view('company.edit', compact('company', 'users'));
        } else {
            return redirect()->route('company.index');
        }

    }

    public function update(UpdateCompanyPost $request, Company $company)
    {
        if ($company->user_id == Auth::user()->id) {
            //search and see if user is part of that company first
            $userExists = User::whereHas('companies', function($query) use($company, $request ) {
                $query->where('company_id', $company->id)->where('company_user.user_id', $request->user_id);
            })->first();
            //if user part of that company allow the update to be made
            if ($userExists) {
                $company->update($request->all());
                return redirect()->route('company.index')->with('status', 'Company updated successfully.');
            }
            return;
        } else {
            return redirect()->route('company.index');
        }
    }

    public function destroy($id)
    {
        //
    }
}

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
        })->paginate(10);
        return view('company.index', compact('companies'));
    }

    public function create()
    {
        return view('company.create');
    }

    public function store(StoreCompanyPost $request)
    {
        //save the company and attach user to that company.
        $company = new Company(['name' => $request->name, 'user_id' => Auth::user()->id]);
        $company = User::findOrFail(Auth::user()->id)->companies()->save($company);
        //set this as default company
        User::findOrFail(Auth::user()->id)->update(['company_id' => $company->id]);
        return redirect()->route('company.index')->with('status', 'Company added successfully.');

    }

    public function show(Company $company)
    {
         if ($company->user_id == Auth::user()->id) {

            $users = User::whereHas('companies', function($query) use($company) {
                $query->where('company_user.company_id', $company->id);
            })->get();
            return view('company.show', compact('users'));
        } else {
            return abort(404);
        }
    }

    public function edit(Company $company)
    {
        if ($company->user_id == Auth::user()->id) {
            $users = User::whereHas('companies', function($query) use($company) {
                $query->where('company_id', $company->id);
            })->get();

            return view('company.edit', compact('company', 'users'));
        } else {
            return abort(404);
        }

    }

    public function update(UpdateCompanyPost $request, Company $company)
    {
        if ($company->user_id == Auth::user()->id) {
            //search and see if user is part of that company first
            $userExists = User::whereHas('companies', function($query) use($company, $request ) {
                $query->where('company_user.company_id', $company->id)->where('company_user.user_id', $request->user_id);
            })->first();
            //if user part of that company allow the update to be made
            if ($userExists) {
                $company->update($request->all());
                return redirect()->route('company.index')->with('status', 'Company updated successfully.');
            }
            return;
        } else {
            return abort(404);
        }
    }

    public function destroy($id)
    {
        //
    }

    public function setDefaultCompany($id)
    {
        $userId = Auth::user()->id;
        $userPartOfCompany = User::whereHas('companies', function($query) use ($id, $userId) {
            $query->where('company_id', $id)->where('company_user.user_id', $userId);
        })->first();

        if ($userPartOfCompany) {
            User::findOrFail($userId)->update(['company_id' => $id]);
            return redirect()->route('company.index')->with('status', 'Company set as default company.');
        }
    }
}

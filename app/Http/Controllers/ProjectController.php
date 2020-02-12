<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProjectPost;
use App\Project;
use App\User;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('company_id', Auth::user()->company_id)->orderBy('title')->paginate(10);
        return view('project.index', compact('projects'));
    }

    public function create()
    {
        $users = User::where('company_id', Auth::user()->company_id)->orderBy('name')->get(['id', 'name']);
        return view('project.create', compact('users'));
    }

    public function store(StoreProjectPost $request)
    {
        $project = Project::create(['title' => $request->title,
            'description' => $request->description,
            'company_id' => Auth::user()->company_id]);

        $project->users()->attach(Auth::user()->id);
        return redirect()->route('project.index')->with('status', 'Project added successfully.');
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

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
        $projects = Project::where('company_id', Auth::user()->company_id)->whereHas('users', function($query){ 
            $query->where('project_user.user_id', Auth::user()->id);
        })->orderBy('title')->paginate(10);
        return view('project.index', compact('projects'));
    }

    public function create()
    {
        $users = User::whereHas('companies', function($query) {
            $query->where('company_user.company_id', Auth::user()->company_id);
        })->orderBy('name')->get(['id', 'name']);
        return view('project.create', compact('users'));
    }

    public function store(StoreProjectPost $request)
    {
        $project = Project::create(['title' => $request->title,
            'description' => $request->description,
            'company_id' => Auth::user()->company_id]);

        $project->users()->attach($request->users);
        return redirect()->route('project.index')->with('status', 'Project added successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit(Project $project)
    {
        if ($project->company_id == Auth::user()->company_id) {
            $users = User::whereHas('companies', function($query) {
                $query->where('company_user.company_id', Auth::user()->company_id);
            })->orderBy('name')->get(['id', 'name']);
            return view('project.edit', compact('project', 'users'));
        } else {
            return redirect()->route('project.index')->with('status', 'Please set this projects company to your default company in the companies section before editing.');
        }
    }

    public function update(StoreProjectPost $request, Project $project)
    {
        if ($project->company_id == Auth::user()->company_id) {
            $project->update(['title' => $request->title, 'description' => $request->description]);
            $project->users()->sync($request->users);
            $message = "Project updated successfully.";
        } else {
            $message = "Please set this projects company to your default company in the companies section before editing.";
        }
        return redirect()->route('project.index')->with('status', $message);
    }

    public function destroy(Project $project)
    {
        if ($project->company_id == Auth::user()->company_id) {
            $project->delete();
        } else {
            return abort(404);
        }
        return redirect()->route('project.index')->with('status', "Project has been deleted successfully!");
    }
}

<?php

namespace App\Http\Controllers;

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

    public function edit(Project $project)
    {
        $this->authorize('access', $project);
        $users = User::whereHas('companies', function($query) {
            $query->where('company_user.company_id', Auth::user()->company_id);
        })->orderBy('name')->get(['id', 'name']);
        return view('project.edit', compact('project', 'users'));
    }

    public function update(StoreProjectPost $request, Project $project)
    {
        $this->authorize('access', $project);
        $project->update(['title' => $request->title, 'description' => $request->description]);
        $project->users()->sync($request->users);
        return redirect()->route('project.index')->with('status', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $this->authorize('access', $project);
        $project->delete();
        return redirect()->route('project.index')->with('status', "Project has been deleted successfully!");
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\StoreTaskPost;
use App\Task;
use App\User;
use App\Project;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::whereHas('project', function($query){ 
            $query->where('company_id', Auth::user()->company_id);
        })->whereHas('users', function($query){ 
            $query->where('task_user.user_id', Auth::user()->id);
        })->paginate(10);
        return view('task.index', compact('tasks'));
    }

    public function create()
    {
        $users = User::whereHas('companies', function($query) {
            $query->where('company_user.company_id', Auth::user()->company_id);
        })->orderBy('name')->get(['id', 'name']);
        $projects = Project::where('company_id', Auth::user()->company_id)->get(['id', 'title']);
        return view('task.create', compact('projects', 'users'));
    }

    public function store(StoreTaskPost $request)
    {
        $startDate = Carbon::parse($request->start_date)->format('Y-m-d');
        $endDate = Carbon::parse($request->end_date)->format('Y-m-d');
        $task = Task::create(['title' => $request->title,
            'description' => $request->description,
            'project_id' => $request->project_id,
            'user_id' => Auth::user()->id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'time_estimate' => $request->time_estimate]
        );
        $task->users()->attach($request->users);
        return redirect()->route('task.index')->with('status', 'Task added successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit(Task $task)
    {
        if ($task->project->company_id == Auth::user()->company_id) {
            $users = User::whereHas('companies', function($query) {
                $query->where('company_user.company_id', Auth::user()->company_id);
            })->orderBy('name')->get(['id', 'name']);
            $projects = Project::where('company_id', Auth::user()->company_id)->get(['id', 'title']);
            return view('task.edit', compact('projects', 'users', 'task'));
        } else {
            return abort(404);
        }
    }

    public function update(StoreTaskPost $request, Task $task)
    {
        $startDate = Carbon::parse($request->start_date)->format('Y-m-d');
        $endDate = Carbon::parse($request->end_date)->format('Y-m-d');
        $task->update(['title' => $request->title,
            'description' => $request->description,
            'project_id' => $request->project_id,
            'user_id' => Auth::user()->id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'time_estimate' => $request->time_estimate]);
        $task->users()->sync($request->users);
        return redirect()->route('task.index')->with('status', 'Task updated successfully.');
    }

    public function destroy($id)
    {
        //
    }
}

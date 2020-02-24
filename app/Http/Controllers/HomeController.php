<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Task;
use Illuminate\Support\Facades\Auth;
use Khill\Lavacharts\Lavacharts;
class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index()
    {
    	$tasksCompleted = Task::whereIn('status', array(2))->whereHas('project', function($query){ 
            $query->where('company_id', Auth::user()->company_id);
        })->whereHas('users', function($query){ 
            $query->where('task_user.user_id', Auth::user()->id);
        })->count();

        $tasksNotCompleted = Task::whereIn('status', array(0, 1))->whereHas('project', function($query){ 
            $query->where('company_id', Auth::user()->company_id);
        })->whereHas('users', function($query){ 
            $query->where('task_user.user_id', Auth::user()->id);
        })->count();

        $tasksOverDue = Task::whereIn('status', array(0, 1))->where('end_date', '<', date('Y-m-d'))->whereHas('project', function($query){ 
            $query->where('company_id', Auth::user()->company_id);
        })->whereHas('users', function($query){ 
            $query->where('task_user.user_id', Auth::user()->id);
        })->count();

    	$lava = new Lavacharts;
    	$reasons = $lava->DataTable();
    	$reasons->addStringColumn('Reasons')
    	->addNumberColumn('Percent')
    	->addRow(array('Completed tasks', $tasksCompleted))
    	->addRow(array('Unfinished tasks', $tasksNotCompleted));
    	$donutchart = $lava->DonutChart('IMDB', $reasons);
        return view('index', compact('lava', 'tasksCompleted', 'tasksNotCompleted', 'tasksOverDue'));
    }
}

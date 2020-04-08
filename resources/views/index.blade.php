
@extends('layouts.app')
@section('title', 'Home')
@section('content')
@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>
@endpush
<div class="row">
	<div class="col-sm-3">
        <div class="card">
            <div class="card-body">
            	<div class="row">
            		<div class="col">
            			<h2 class="text-muted">Projects</h2>
            			<p>{{ $projectsCount }}</p>
            		</div>
            		<div class="col-auto">
            			<div class="icon icon-shape bg-primary text-white rounded-circle shadow">
            				<i class="material-icons stat-icon">assignment</i>
                        </div>
            		</div>
            	</div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card">
            <div class="card-body">
            	<div class="row">
            		<div class="col">
            			<h2 class="text-muted">Tasks to-do</h2>
            			<p>{{ $tasksNotCompleted }}</p>
            		</div>
            		<div class="col-auto">
            			<div class="icon icon-shape bg-warning text-white rounded-circle shadow">
            				<i class="material-icons stat-icon">list</i>
                        </div>
            		</div>
            	</div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card">
            <div class="card-body">
            	<div class="row">
            		<div class="col">
            			<h2 class="text-muted">Tasks completed</h2>
            			<p>{{ $tasksCompleted }}</p>
            		</div>
            		<div class="col-auto">
            			<div class="icon icon-shape bg-success text-white rounded-circle shadow">
            				<i class="material-icons stat-icon">check_circle</i>
                        </div>
            		</div>
            	</div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card">
            <div class="card-body">
            	<div class="row">
            		<div class="col">
            			<h2 class="text-muted">Over due tasks</h2>
            			<p>{{ $tasksOverDue->count() }}</p>
            		</div>
            		<div class="col-auto">
            			<div class="icon icon-shape bg-danger text-white rounded-circle shadow">
            				<i class="material-icons stat-icon">warning</i>
                        </div>
            		</div>
            	</div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-sm-6 p-y-2">
        <div class="card">
            <div class="card-header bg-white">
                Upcoming tasks
            </div>
            <div class="card-body">
                <table id="task_table" class="table">
                    <thead>
                        <tr>
                            <th>Task</th>
                            <th>Start date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->start_date->format('jS F Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header bg-white">
                Task progress
            </div>
            <div class="card-body">
                <div id="chart-div"></div>
                {!! $lava->render('DonutChart', 'IMDB', 'chart-div') !!}
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-sm-6 p-y-2">
        <div class="card">
            <div class="card-header bg-white">
                Projects
            </div>
            <div class="card-body">
                <table id="project_table" class="table">
                    <thead>
                        <tr>
                            <th>Project</th>
                            <th>Progress</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr>
                                <td>{{ $project->title }}</td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $project->percentage }}%" aria-valuenow="{{ $project->percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header bg-white">
                Overdue tasks
            </div>
            <div class="card-body">
                <table id="over_due_task_table" class="table">
                    <thead>
                    <tr>
                        <th>Task</th>
                        <th>Due date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($tasksOverDue as $taskOverDue)
                        <tr>
                            <td>{{ $taskOverDue->title }}</td>
                            <td>{{ $taskOverDue->end_date->format('jS F Y') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
    <script type="text/javascript" src="{{ url('js/datatables.js') }}"></script>
@endpush

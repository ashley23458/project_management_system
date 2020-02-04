
@extends('layouts.app')
@section('title', 'Home')
@section('content')
<div class="row">
	<div class="col-sm-3">
        <div class="card">
            <div class="card-body">
            	<div class="row">
            		<div class="col">
            			<h2 class="text-muted">Projects</h2>
            			<p>1</p>
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
            			<p>1</p>
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
            			<p>156</p>
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
            			<p>10</p>
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
                
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header bg-white">
                Task progress
            </div>
            <div class="card-body">
                
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
                
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header bg-white">
                Overdue tasks
            </div>
            <div class="card-body">
                
            </div>
        </div>
    </div>
</div>
@endsection

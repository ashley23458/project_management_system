@extends('layouts.app')
@section('title', 'Create new task')
@section('content')
@push('stylesheets')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
@endpush
<div class="row">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header  bg-white">
				<h2>Create new task</h2>
			</div>
			<div class="card-body">
				<form method="POST" action="{{ route('task.store') }}">
				    {{ csrf_field() }}
				    <div class="form-group row">
				    	<label for="title" class="col-sm-3 col-form-label">Title</label>
				    	<div class="col-sm-9">
				    		<input type="text" class="form-control  @error('title') is-invalid @enderror" id="title" name="title" placeholder="Enter title" value="{{old('title')}}">
				    		@error('title')
				    		    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
				    		@enderror
				    	</div>
				    </div>
				    <div class="form-group row">
				    	<label for="description" class="col-sm-3 col-form-label">Description</label>
				    	<div class="col-sm-9">
				    		<textarea class="form-control  @error('description') is-invalid @enderror" id="description" rows="3" name="description" placeholder="Enter description"></textarea>
				    		@error('description')
				    		    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
				    		@enderror
				    	</div>
				    </div>
				    <div class="form-group row">
				    	<label for="project_id" class="col-sm-3 col-form-label">Select a project</label>
				    	<div class="col-sm-9">
				    		<select class="form-control" id="project_id" name="project_id">
				    			<option>Please select...</option>
				    			@foreach ($projects as $project)
				    			    <option value="{{ $project->id }}" {{ (collect(old('project_id'))->contains($project->id)) ? 'selected':'' }}>{{ $project->title }}</option>
				    			@endforeach
				    		</select>
				    	</div>
				    </div>
				    <div class="form-group row">
				    	<label for="users" class="col-sm-3 col-form-label">Add users to the project</label>
				    	<div class="col-sm-9">
				    		<select multiple class="form-control" id="users" name="users[]">
				    			@foreach ($users as $user)
				    			    <option value="{{ $user->id }}" {{ (collect(old('users'))->contains($user->id)) ? 'selected':'' }}>{{ $user->name }}</option>
				    			@endforeach
				    		</select>
				    	</div>
				    </div>
				    <div class="form-group row">
				    	<label for="start_date" class="col-sm-3 col-form-label">Start date</label>
				    	<div class="col-sm-9">
				    		<input id="start_date" name="start_date" value="{{ old('start_date') }}" type="text" class="datepicker form-control">
				    		@error('start_date')
				    		    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
				    		@enderror
				    	</div>
				    </div>
				    <div class="form-group row">
				    	<label for="end_date" class="col-sm-3 col-form-label">Due date:</label>
				    	<div class="col-sm-9">
				    		<input id="end_date" name="end_date" value="{{ old('end_date') }}" type="text" class="datepicker form-control">
				    		@error('end_date')
				    		    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
				    		@enderror
				    	</div>
				    </div>
				    <div class="form-group row">
				    	<label for="time_estimate" class="col-sm-3 col-form-label">Time estimation (hh:mm):</label>
				    	<div class="col-sm-9">
				    		<input type="text" class="form-control" id="time_estimate" name="time_estimate" value="{{ old('time_estimate') }}" placeholder="hh:mm">
				    		@error('time_estimate')
				    		    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
				    		@enderror
				    	</div>
				    </div>
				    <button type="submit" class="btn btn-info">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="{{ url('js/datepicker.js') }}"></script>
@endpush

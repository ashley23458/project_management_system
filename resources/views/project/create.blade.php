@extends('layouts.app')
@section('title', 'Create new project')
@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header  bg-white">
				<h2>Create new project</h2>
			</div>
			<div class="card-body">
				<form method="POST" action="{{ route('project.store') }}">
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
				    	<label for="users" class="col-sm-3 col-form-label">Add users to the project</label>
				    	<div class="col-sm-9">
				    		<select multiple class="form-control" id="users" name="users[]">
				    			@foreach ($users as $user)
				    			    <option value="{{ $user->id }}" {{ (collect(old('users'))->contains($user->id)) ? 'selected':'' }}>{{ $user->name }}</option>
				    			@endforeach
				    		</select>
                            @if ($errors->has('users.*'))
                                <strong class="invalid-feedback">{{ $errors->first('users.*') }}</strong>
                            @endif
				    	</div>
				    </div>
				    <button type="submit" class="btn btn-info">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection


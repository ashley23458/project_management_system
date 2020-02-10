@extends('layouts.app')
@section('title', 'Edit company')
@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header  bg-white">
				<h2>Edit company</h2>
			</div>
			<div class="card-body">
				<form method="POST" action="{{ route('company.update', $company->id) }}">
					@method('PUT')
					@csrf
				    <div class="form-group row">
				    	<label for="name" class="col-sm-3 col-form-label">Company name</label>
				    	<div class="col-sm-9">
				    		<input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name', $company->name)}}" placeholder="Enter company name">
				    		@error('name')
				    		    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
				    		@enderror
				    	</div>
				    </div>
				    <div class="form-group row">
				    	<label for="owner" class="col-sm-3 col-form-label">Owner</label>
				    	<div class="col-sm-9">
				    		<select name="user_id" class="form-control" id="owner">
				    			<option>Please select...</option>
				    			    @foreach ($users as $user)
				    			        <option value="{{$user->id}}" {{ (old('user_id', $user->id) == $company->user_id ? "selected":"") }}> {{$user->name}} </option>
				    			    @endforeach
				    	    </select>
				    	</div>
				    </div>
                </div>
				    <button type="submit" class="btn btn-info">Update</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@extends('layouts.app')
@section('title', 'Create new company')
@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header  bg-white">
				<h2>Create new company</h2>
			</div>
			<div class="card-body">
				<form method="POST" action="{{ route('company.store') }}">
				    {{ csrf_field() }}
				    <div class="form-group row">
				    	<label for="name" class="col-sm-3 col-form-label">Company name</label>
				    	<div class="col-sm-9">
				    		<input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter company name">
				    		@error('name')
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
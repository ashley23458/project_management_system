@extends('layouts.app')
@section('title', 'Send invite')
@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header  bg-white">
				<h2>Send invite to join this company</h2>
			</div>
			<div class="card-body">
				<form method="POST" action="{{ route('send_invite', $company->id) }}">
					@method('PUT')
					@csrf
				    <div class="form-group row">
				    	<label for="email" class="col-sm-3 col-form-label">Users email</label>
				    	<div class="col-sm-9">
				    		<input type="text" class="form-control  @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')}}" placeholder="Enter users email">
				    		@error('email')
				    		    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
				    		@enderror
				    	</div>
				    </div>
                </div>
				    <button type="submit" class="btn btn-info">Send invitation</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
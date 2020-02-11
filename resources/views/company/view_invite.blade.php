@extends('layouts.app')
@section('title', 'View invite')
@section('content')
<div class="col-sm-6 p-y-2">
        <div class="card">
            <div class="card-header bg-white">
                <h2> Invitation to join <span class="text-capitalize font-weight-bold">{{$invite->company->name}}</span></h2>
            </div>
            <div class="card-body">
            	<p>Please accept or decline the invitation!</p>
            </div>
            <div class="card-footer">
				<a href="{{ route('invite_respond', ['response'=> 0, 'token' => $token]) }}" class="btn btn-danger create-new" role="button">Decline</a>
				<a href="{{ route('invite_respond', ['response'=> 1, 'token' => $token]) }}" class="btn btn-success create-new" role="button">Accept</a>
            </div>
        </div>
</div>


@endsection
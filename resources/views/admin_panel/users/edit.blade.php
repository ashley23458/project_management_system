@extends('layouts.app')
@section('title', 'Edit company')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header  bg-white">
                    <h2>Edit user</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.update', $user->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name', $user->name)}}" placeholder="Enter users name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">Email address</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control  @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email', $user->email)}}" placeholder="Enter users email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role_id" class="col-sm-3 col-form-label">Select a role</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="role_id" name="role_id">
                                    <option>Please select...</option>
                                    @foreach ($roles as $role)
                                        <option value="{{$role->id}}"
                                            {{ (old('role_id', $user->role_id) == $role->id ? "selected":"") }}>
                                            {{$role->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

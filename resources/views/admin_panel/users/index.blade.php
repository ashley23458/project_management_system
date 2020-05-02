@extends('layouts.app')
@section('title', 'Companies')
@section('content')
    <div class="card bg-white">
        <div class="card-header">
            <div class="row">
                <div class="col-md-8">
                    <h2>Users</h2>
                </div>
            </div>
            <div class="card-body">
                @if (count ($users) > 0)
                    <div class="table-responsive-md">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email </th>
                                <th>User role</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email}}</td>
                                        <td>{{ $user->role->name}}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-secondary create-new" role="button"><i class="fas fa-pencil-alt"></i> Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$users->links()}}
                @endif
            </div>
        </div>

@endsection


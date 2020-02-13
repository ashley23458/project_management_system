@extends('layouts.app')
@section('title', 'Tasks')
@section('content')
<div class="card bg-white">
	<div class="card-header">
		<div class="row">
			<div class="col-md-8">
				<h2>Tasks for <strong>{{Auth::user()->defaultCompany->name}}</strong></h2>
			</div>
			<div class="col-md-4">
				<a href="{{ route('task.create') }}" class="btn btn-info create-new" role="button"><i class="fas fa-plus"></i> Create New</a>	
			</div>
	</div>
	<div class="card-body">
		@if (count ($tasks) > 0)
			<div class="table-responsive-md">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Title</th>
							<th scope="col">Description</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($tasks as $task)
							<tr>
								<td>{{ $task->title }}</td>
								<td>{{ $task->description }}</td>
								<td><a href="{{ route('task.edit', $task->id) }}" class="btn btn-secondary create-new" role="button"><i class="fas fa-pencil-alt"></i> Edit</a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			{{$tasks->links()}}
		@endif
	</div>
</div>

@endsection
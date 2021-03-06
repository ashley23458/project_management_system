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
							<th scope="col">Status</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($tasks as $task)
							<tr>
								<td>{{ $task->title }}</td>
								<td>{{ $task->description }}</td>
								<td>
									@if ($task->status == 1)
									    <span class="badge badge-pill badge-warning">In-progress</span>
									@elseif($task->status == 2)
									    <span class="badge badge-pill badge-success">Complete</span>
									@else 
									    <span class="badge badge-pill badge-secondary">Not started</span>
									@endif
								</td>
								<td>
									
									<form id="formDelete" method="post" class="float-right" action="{{ route('task.destroy', $task->id) }}">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<button class="btn btn-danger create-new" type="submit" onclick="return confirm('Are you sure you want to delete this task?')">
											<i class="fas fa-trash"></i> Delete
										</button>
									</form>
									<a href="{{ route('task.edit', $task->id) }}" class="btn btn-secondary create-new" role="button"><i class="fas fa-pencil-alt"></i> Edit</a>
								</td>
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

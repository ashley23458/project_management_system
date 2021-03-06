@extends('layouts.app')
@section('title', 'Projects')
@section('content')
<div class="card bg-white">
	<div class="card-header">
		<div class="row">
			<div class="col-md-8">
				<h2>Projects for <strong>{{Auth::user()->defaultCompany->name}}</strong></h2>
			</div>
			<div class="col-md-4">
				<a href="{{ route('project.create') }}" class="btn btn-info create-new" role="button"><i class="fas fa-plus"></i> Create New</a>	
			</div>
	</div>
	<div class="card-body">
		@if (count ($projects) > 0)
			<div class="table-responsive-md">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Title</th>
							<th scope="col">Description</th>
							<th scope="col">Created</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($projects as $project)
							<tr>
								<td>{{ $project->title }}</td>
								<td>{{ $project->description }}</td>
								<td>{{ $project->updated_at->format('jS F Y h:i A') }}</td>
								<td>
									<form id="formDelete" method="post" class="float-right" action="{{ route('project.destroy', $project->id) }}">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<button class="btn btn-danger create-new" type="submit" onclick="return confirm('Are you sure you want to delete this project?')">
											<i class="fas fa-trash"></i> Delete
										</button>
									</form>
									<a href="{{ route('project.edit', $project->id) }}" class="btn btn-secondary create-new" role="button"><i class="fas fa-pencil-alt"></i> Edit</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			{{$projects->links()}}
		@endif
	</div>
</div>

@endsection
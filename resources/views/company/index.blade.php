@extends('layouts.app')
@section('title', 'Home')
@section('content')
<div class="card bg-white">
	<div class="card-header">
		<div class="row">
			<div class="col-md-8">
				<h2>Companies</h2>
			</div>
			<div class="col-md-4">
				<a href="{{ route('company.create') }}" class="btn btn-info create-new" role="button"><i class="fas fa-plus"></i> Create New</a>	
			</div>
	</div>
	<div class="card-body">
		<div class="table-responsive-md">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Title</th>
						<th scope="col">Owner</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($companies as $company)
						<tr>
							<th scope="row">{{ $company->id }}</th>
							<td>{{ $company->title }}</td>
							<td>{{ $company->createdBy->name }}</td>
							<td></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection
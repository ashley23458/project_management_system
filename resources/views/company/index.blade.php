@extends('layouts.app')
@section('title', 'Home')
@section('content')

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

@endsection
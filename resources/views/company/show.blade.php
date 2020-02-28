@extends('layouts.app')
@section('title', 'Company employees')
@section('content')
<div class="card bg-white">
	<div class="card-header">
		<div class="row">
			<div class="col-md-8">
				<h2>Company employees</h2>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive-md">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">User</th>
						<th scope="col">Email</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($users as $user)
						<tr>
							<td>{{ $user->name }}</td>
							<td>{{ $user->email }}</td>
							<td>
								<form id="formDelete" method="post" class="float-right" action="">
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
									<button class="btn btn-danger create-new" type="submit" onclick="return confirm('Are you sure you want to delete this employee?')">
										<i class="fas fa-trash"></i> Delete
									</button>
								</form>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection
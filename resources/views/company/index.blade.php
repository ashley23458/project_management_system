@extends('layouts.app')
@section('title', 'Companies')
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
        @if (count ($companies) > 0)
            <div class="table-responsive-md">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Owner</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                            <tr>
                                <td>
                                    @if ($company->user_id == Auth::user()->id)
                                        <a href="{{ route('company.show', $company->id) }}" class="alert-link">{{ $company->name }}</a>
                                    @else
                                        {{ $company->name }}
                                    @endif
                                </td>
                                <td>{{ $company->owner->name }}</td>
                                <td>
                                    @if ($company->id == Auth::user()->company_id)
                                        <a href="" class="btn btn-success create-new" role="button"><i class="fas fa-check"></i> Current default company</a>
                                    @else
                                        <a href="{{ route('set_default_company', $company->id) }}" class="btn btn-secondary create-new" role="button"><i class="fas fa-pencil-alt"></i> Set default company</a>
                                    @endif
                                    @if ($company->user_id == Auth::user()->id)
                                        <a href="{{ route('company_invite', $company->id) }}" class="btn btn-secondary create-new" role="button"><i class="fas fa-envelope-open-text"></i> Send invitation</a>
                                        <a href="{{ route('company.edit', $company->id) }}" class="btn btn-secondary create-new" role="button"><i class="fas fa-pencil-alt"></i> Edit</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{$companies->links()}}
        @endif
	</div>
</div>

@endsection

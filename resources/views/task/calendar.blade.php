@extends('layouts.app')
@section('title', 'Calendar')
@section('content')
@push('stylesheets')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.1/fullcalendar.min.css" />

@endpush
<div class="card bg-white">
	<div class="card-header">
		<div class="row">
			<div class="col-md-8">
				<h2>Showing all your tasks for <strong>{{Auth::user()->defaultCompany->name}}</strong></h2>
			</div>
			<div class="col-md-4">
				<a href="{{ route('task.create') }}" class="btn btn-info create-new" role="button"><i class="fas fa-plus"></i> Create New task</a>	
			</div>
	</div>
	<div class="card-body">
		<div id='calendar' class="col-md-8"></div>
	</div>
</div>

@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.1/fullcalendar.min.js"></script>
<script>
    $(document).ready(function() {
        // page is now ready, initialize the calendar...
        $('#calendar').fullCalendar({
            themeSystem: 'bootstrap4',
            header: {
            	left: 'prev,next today',
            	center: 'title',
            	right: 'month, listMonth'
            },
            displayEventTime: false,
            weekNumbers: true,
            eventLimit: true,
            events : [
                @foreach($tasks as $task)
                {
                	id: '{{$task->id}}',
                    title : '{{$task->title}}',
                    start : '{{$task->start_date}}',
                    end : '{{$task->start_date}}',
                    url : '{{ route('task.edit', $task->id) }}'
                },
                @endforeach
                ],
            });
    });
</script>
@endpush

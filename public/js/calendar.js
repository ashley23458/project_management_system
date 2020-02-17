$(document).ready(function() {
        // page is now ready, initialize the calendar...
        $('#calendar').fullCalendar({
            // put your options and callbacks here
            defaultView: 'agendaWeek',
            events : [
                @foreach($tasks as $task)
                {
                    title : 'fart',
                    start : 'fart',
                },
                @endforeach
            ],
        });
    });
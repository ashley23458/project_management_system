$(document).ready( function () {
	$('#task_table').DataTable({
		"bFilter": false,
		"bInfo": false,
		"lengthChange": false,
		"pageLength": 2
	});

	$('#project_table').DataTable({
		"bFilter": false,
		"bInfo": false,
		"lengthChange": false,
		"pageLength": 2
	});
});
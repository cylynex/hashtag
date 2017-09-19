function category_select(category_id) {

	var gettags = 1;

	// Ajax query for tag data
	$.ajax({
		url: '/js/ajax.php',
		data: {
			gettags:gettags
		},
		type: 'POST',
		success: function(output) {
			alert(output);
			//status_red(output);
			//$(divtohide).fadeOut(1000);
		}			
	});	
	
	
	
	// Output
	$('#result_tags').html("tags will go here");
}
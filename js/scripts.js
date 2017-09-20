function category_select(section) {
	
	// section = which weight to use (1/2/3)
	var sectionid = "#category"+section;
	var gettags = $(sectionid).val();
	
	// Ajax query for tag data
	$.ajax({
		url: '/js/ajax.php',
		data: {
			gettags:gettags
		},
		type: 'POST',
		success: function(output) {
			//alert(output);
			// Output
			$('#result_tags').html(output);
		}			
	});	
	
	
	
	
}
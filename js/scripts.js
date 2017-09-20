function category_select(section) {
	
	// section = which weight to use (1/2/3)
	var sectionid = "#category"+section;
	var gettags = $(sectionid).val();
	
	var resultbox = "#result_tags"+section;
	
	// Ajax query for tag data
	$.ajax({
		url: '/js/ajax.php',
		data: {
			gettags:gettags,section:section
		},
		type: 'POST',
		success: function(output) {
			//alert(output);
			$(resultbox).html(output);
		}			
	});	
	
	
	
	
}
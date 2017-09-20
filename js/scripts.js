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


// Add new tags
function add_new_tag() {
	
	
	// get the data
	var add_tag = 1;
	var tag = $('#tag').val();
	var tag_hub = $('#tag_hub').is(":checked");
	var tag_category = $('#tag_category').val();
	
	$.ajax({
		url: '/js/ajax.php',
		data: { 
			add_tag:add_tag,
			tag:tag,
			tag_hub:tag_hub,
			tag_category:tag_category
		},
		type: 'POST',
		success: function(output) {
			//alert(output);
			$('#StatusDisplay').show();
			$('#statusbox').html(output);
			//$('#StatusDisplay').fadeOut(3500);
			$('#tag').val('');
			$('#tag_category').val('');
		}
	});
	
	return false;
	
}
function category_select(section,socialmedia) {
	
	// section = which weight to use (1/2/3)
	var sectionid = "#category"+section;
	var gettags = $(sectionid).val();
	
	var resultbox = "#result_tags"+section;
	
	// Ajax query for tag data
	$.ajax({
		url: '/js/ajax.php',
		data: {
			gettags:gettags,
			section:section,
			socialmedia:socialmedia
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
	var tag_sm = $('#tag_sm').val();
	
	$.ajax({
		url: '/js/ajax.php',
		data: { 
			add_tag:add_tag,
			tag:tag,
			tag_hub:tag_hub,
			tag_category:tag_category,
			tag_sm:tag_sm
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


// Display all tags in a category
function display_all_in_category() {
	var category = $('#category').val();
	var display_category = 1;
	
	$.ajax({
		url: '/js/ajax.php',
		data: { 
			display_category:display_category,
			category:category
		},
		type: 'POST',
		success: function(output) {
			//alert(output);
			$('#result_tags').html(output);
		}
	});
}
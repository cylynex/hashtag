function add_tag(table) {
	
	//$(divtohide).fadeOut(1000);
	
	
	if (table == "tag") {
		var addtag = 1;
		var addloc = 0;
		var tag = $('#newtag').val();
		var cat = $('#tag_cat1').val();
		var meta = $('#meta').val();
	} else {
		var addtag = 0;
		var addloc = 1;
		var tag = $('#newloc').val();
		var cat = $('#loc_cat').val();
		var meta = $('#loc_meta').val();
	}
	
	
	$.ajax({
		url: 'js/ajax.php',
		data: {
			addtag:addtag,
			addloc:addloc,
			tag:tag,
			cat:cat,
			meta:meta
		},
		type: 'post',
		success: function(output) {
			// alert(output);
						
			$('#statusbox').html(output);
			$('#statusbox').fadeIn(400);
			$('#statusbox').delay(5000).fadeOut(400);
			$('#newtag').val('');
			$('#tag_cat1').val('');
			//$('#meta').val('');
			$('#newloc').val('');
			$('#loc_cat').val('');
			//$('#loc_meta').val('');
			
		}			
	});	
	
	return false;
}
<?php
include ("../inc/init.php");

// Get the tags for output from a category
function get_tags() {
	
	// category
	$tc = $_POST['gettags'];
	
	$tags = Tags::query("SELECT * FROM tags WHERE tag_category = '$tc'");
	//echo json_encode($tags);
	foreach ($tags AS $tagout) {
		echo "#".$tagout->tag." ";
	}
		
}


if ($_POST['gettags']) { get_tags(); }
?>
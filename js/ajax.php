<?php
include ("../inc/init.php");

// Get the tags for output from a category
function get_tags() {
	
	// category
	$tc = $_POST['gettags'];
	
	// Sort section weight (15 / 10 / 5)
	switch($_POST['section']) {
		case 1: $limit = 15; break;
		case 2: $limit = 10; break;
		case 3: $limit = 5; break;
	}
	
	$tags = Tags::query("SELECT * FROM tags WHERE tag_category = '$tc' ORDER BY rand() LIMIT $limit");
	
	// Output
	foreach ($tags AS $tagout) {
		echo "#".$tagout->tag." ";
	}
		
}


if ($_POST['gettags']) { get_tags(); }
?>
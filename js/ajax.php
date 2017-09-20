<?php
include ("../inc/init.php");

// Get the tags for output from a category
function get_tags() {
	
	//$cats = Categories::query("SELECT * FROM categories WHERE category = 'Sunset' ");
	//$tags = new Tags;
	//$tags->tag_poll();
	$tags = Tags::query("SELECT * FROM tags");
	var_dump($tags);
	
	
}


if ($_POST['gettags']) { get_tags(); }
?>
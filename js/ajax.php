<?php
include ("../inc/init.php");

// Get the tags for output from a category
function get_tags() {
	
	// category
	$tc = $_POST['gettags'];
	
	// Sort section weight (15 / 10 / 5)
	switch($_POST['section']) {
		case 1: 
			$limit = 15; 
			$limithub = intval($limit * .75);
			break;
		case 2: 
			$limit = 10;
			$limithub = intval($limit * .75); 
			break;
		case 3: 
			$limit = 5; 
			$limithub = intval($limit * .75);
			break;
	}
	
	// Standard query for unweighted results
	// $tags = Tags::query("SELECT * FROM tags WHERE tag_category = '$tc' ORDER BY rand() LIMIT $limit");

	// Hub weighted query (approx 75% - hardcoded for now)
	$tags = Tags::query("SELECT * FROM tags WHERE tag_category = '$tc' AND tag_hub = '1' AND tag_approved = '1' ORDER BY rand() LIMIT $limithub ");
			
	// Output
	$tagcount = 0;
	foreach ($tags AS $tagout) {
		echo "#".$tagout->tag." ";
		$tagcount++;
	}
	
	// Sort how many more to do
	$hubtags = $tagcount;
	$tagfinish = $limit - $tagcount;
	
	// Debug Stuff
	// echo "<br>Tags so far: $tagcount<br>";
	// echo "Tags to finish: $tagfinish<br>";
	
	$tags = Tags::query("SELECT * FROM tags WHERE tag_category = '$tc' AND tag_hub = '0' AND tag_approved = '1' ORDER BY rand() LIMIT $tagfinish ");
	foreach ($tags AS $tagout) {
		echo "#".$tagout->tag." ";
	}		
}


// Add new tag
function add_tag() {
	
	$addtag = new Tags;
	$addtag->tag = $_POST['tag'];
	$addtag->tag_category = $_POST['tag_category'];
	$addtag->tag_approved = 0;
	if ($_POST['tag_hub'] == "true") {
		$addtag->tag_hub = 1;
	} else {
		$addtag->tag_hub = 0;
	}
	
	if ($addtag->tag_verify_unique()) {
		if ( (!empty($addtag->tag)) && (!empty($addtag->tag_category)) ) { 
			$addtag->create();
			echo "Added Tag <b>{$addtag->tag}</b>.  If approved, it will be added to the pool.";
		} else { 
			echo "Cannot add empty tag or category.";
		}
	} else {
		echo "Could not add tag, it already exists within that category.";
	}
	
}


if ($_POST['gettags']) { get_tags(); }
if ($_POST['add_tag']) { add_tag(); }
?>
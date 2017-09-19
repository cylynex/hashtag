<?php
include ("../inc/init.php");

// Get the tags for output from a category
function get_tags() {
	echo "ok here";
	//$cat = new Categories();
	//$cat->query("SELECT * FROM categories");
	//var_dump($cat);
	
	$cats = $db->query("SELECT * FROM categories");
            
	foreach ($cats AS $tagcat) {
		echo $tagcat->category."<br>";
	}
	
}


if ($_POST['gettags']) { get_tags(); }
?>
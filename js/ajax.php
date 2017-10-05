<?php
include ("../inc/init.php");

// Get the tags for output from a category
function get_tags() {
	
	// category
	$tc = $_POST['gettags'];
	$socialmedia = $_POST['socialmedia'];
	
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
	
	// Standard query for unweighted results - deprecated
	// $tags = Tags::query("SELECT * FROM tags WHERE tag_category = '$tc' ORDER BY rand() LIMIT $limit");

	// Hub weighted query (approx 75% - hardcoded for now)
	$tags = Tags::query("SELECT * FROM tags WHERE tag_category = '$tc' AND tag_hub = '1' AND tag_approved = '1' AND tag_sm = '$socialmedia' ORDER BY rand() LIMIT $limithub ");
			
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
	
	$tags = Tags::query("SELECT * FROM tags WHERE tag_category = '$tc' AND tag_hub = '0' AND tag_approved = '1' AND tag_sm = '$socialmedia' ORDER BY rand() LIMIT $tagfinish ");
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
	$addtag->tag_sm = $_POST['tag_sm'];
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


// Add new category
function add_category() {
	$addcat = new Categories;
	$addcat->category = $_POST['category'];
	$addcat->category_approved = 0;

	if ($addcat->category_verify_unique()) {
		if ( (!empty($addcat->category)) ) { 
			$addcat->create();
			echo "Added Category <b>{$addcat->category}</b>.  If approved, it will be added to the pool.";
		} else { 
			echo "Cannot add empty category.";
		}
	} else {
		echo "Could not add category, it already exists within that category.";
	}
	
}


// Display Category
function display_category() {
	$showcat = new Tags;
	$cat = intval($_POST['category']);
	$output = $showcat->tag_poll(" WHERE tag_category = '$cat' ");
	$count = 1;
	?>
    
    <table class="table hover">
    <tr>
    	<th>ID</th>
        <th>Tag</th>
        <th>Is Hub?</th>
        <th>Social</th>
    </tr>
    <tbody>
	
		<?php    
        foreach ($output AS $catdata) {
            echo "<tr>";
            echo "<td>".$catdata->tag_id."</td>";
            echo "<td>".$catdata->tag."</td>";
            if ($catdata->tag_hub == 1) { echo "<td>YES</td>"; } else { echo "<td>NO</td>"; } 
			
			// Translate social stuff to words
			$smid = $catdata->tag_sm;
			$socialdata = new Social;
			$socialname = $socialdata->find_by_id($smid,"social_id");
			echo "<td><i class='fa fa-fw fa-2x point ".$socialname->social_icon."' title='".$socialname->social."' alt='".$socialname->social."'></i></td>";
		
			echo "</tr>";
        }
        ?>
    </tbody>
    </table>
    
    <?php
}


// Gets photo description
function photo_desc() {
	echo "hereinajax";
	$photod_type = $_POST['photo_desc'];
	$title = $_POST['title'];
	$location = $_POST['location'];
	$description = $_POST['description'];
	
	// Get matching data
	//$content = $this->query("SELECT * FROM photo_desc_data WHERE photod_id = '$photod_type' ");
	//var_dump($content);
	
	//$output = "Title: {$title}<br>";
	//$output .= "Location: {$location}<br>";
	
	
}


if ($_POST['gettags']) { get_tags(); }
if ($_POST['add_tag']) { add_tag(); }
if ($_POST['add_category']) { add_category(); }
if ($_POST['display_category']) { display_category(); }
if ($_POST['photo_desc']) { photo_desc(); }
?>
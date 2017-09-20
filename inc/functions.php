<?php

// show the content
function fetch_page() {
	switch($GLOBALS['url1']) {
		case "home" :
			$page = "home.php";
			$GLOBALS['pagetitle'] = "Home - ";
			break;
		case "addtag" :
			$page = "addtag.php";
			$GLOBALS['pagetitle'] = "Add Tag - ";
			break;
		default:
			$page = "home.php";
			$GLOBALS['pagetitle'] = "";
			break;
	}
	
	return $page;	
}


// clean input
function sanitize($term) {
	$term = str_ireplace("<script>","",$term);
	$term = str_ireplace("<script","",$term);
	$term = str_ireplace("</script>","",$term);
	$term = str_ireplace("javascript","",$term);
	$term = str_ireplace(".php","",$term);
	$term = str_ireplace("href","",$term);
	$term = str_ireplace("etc/passwd","",$term);
	$term = str_ireplace("passwd","",$term);
	$term = str_ireplace("iframe","",$term);
	$term = str_ireplace("../","",$term);
	$term = str_ireplace("response.write","",$term);
	$term = str_ireplace("print","",$term);
	$term = str_ireplace("md5","",$term);
	$term = str_ireplace("response.","",$term);
	$term = preg_replace('/[^A-Za-z0-9\-_@. ]/', '', $term); // Removes special chars.
	return $term;
}


?>
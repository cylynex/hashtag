<?php 

$urlVariables = explode("/",$_SERVER['REQUEST_URI']);

function globalizeurl($urlloc,$urlVariables) {
	
	$urlid = "url".$urlloc;
	
	// Check for get variable 
	$stc = substr($urlVariables[$urlloc],0,1); 
	if ($stc == "?") { 
		$url == "";
	} else { 
		$url = sanitize($urlVariables[$urlloc]);
		if ($url) { $GLOBALS[$urlid] = $url; } 
		else { unset($GLOBALS[$urlid]);	}
	}
	
	return $url;
}


if (isset($urlVariables[1])) { $url1 = globalizeurl(1,$urlVariables); }
if (isset($urlVariables[2])) { $url2 = globalizeurl(2,$urlVariables); }	
if (isset($urlVariables[3])) { $url3 = globalizeurl(3,$urlVariables); }	
if (isset($urlVariables[4])) { $url4 = globalizeurl(4,$urlVariables); }	
if (isset($urlVariables[5])) { $url5 = globalizeurl(5,$urlVariables); }	
if (isset($urlVariables[6])) { $url6 = globalizeurl(6,$urlVariables); }	
if (isset($urlVariables[7])) { $url7 = globalizeurl(7,$urlVariables); }	
if (isset($urlVariables[8])) { $url8 = globalizeurl(8,$urlVariables); }	

if ((!$url1) || ($url1 == "") || ($url1 == " ")) { 
	$url1 = "home";
} else if ($url1 == "404") {
	// 404 do nothing.
}

$page = fetch_page();

include("pages/$page");
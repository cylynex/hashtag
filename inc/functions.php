<?php 

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

// show the content
function fetch_page() {
	switch($GLOBALS['url1']) {
		case "privacy-policy" :
			$page = "privacy-policy.php";
			$GLOBALS['pagetitle'] = "Privacy Policy - ";
			break;
		case "terms-of-use" :
			$page = "termsofuse.php";
			$GLOBALS['pagetitle'] = "Terms of Use - ";
			break;
		case "clinical-perspectives" : 
			$page = "clinical-perspectives.php";
			$GLOBALS['pagetitle'] = "Clinical Perspectives - ";
			break;
		case "about" : 
			$page = "about.php";
			$GLOBALS['pagetitle'] = "About - ";
			break;
		case "emotional-anatomy" : 
			$page = "emotional-anatomy.php";
			$GLOBALS['pagetitle'] = "Emotional Anatomy - ";
			break;
		case "treatment-gap" : 
			$page = "treatment-gap.php";
			$GLOBALS['pagetitle'] = "Treatment Gap - ";
			break;
		case "sign-up" : 
			$page = "sign-up.php";
			$GLOBALS['pagetitle'] = "Sign Up - ";
			break;
		default:
			$page = "home.php";
			$GLOBALS['pagetitle'] = "";
			break;
	}
	
	return $page;	
}

// Error Box Display (for ajax)
function error_box() {
	?>
    <div class="row ErrorDisplay">
    	 <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-exclamation-triangle fa-fw"></i> Errors
                    <div class="pull-right"></div>
                </div>
                                    
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-12">
                        	<div class="FormErrors"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}


// SHow the appropriate footnote
function show_footnote($page) {
	switch($page) {
		case "home1" :
			$out = "<sup>1</sup> Data on File. Aclaris Therapeutics SK In-office Observational Study, 406 dermatology patients, 2016.";
			break;
		case "sign-up1" :
			$out = "SIGNUP PAGE";
			break;
		case "about1" :
			$out = "1 Data on File. Aclaris Therapeutics Burke Screener of 594 dermatologists, 2014.<br />
					2 Bickers DR, et al. The burden of skin diseases: 2004. J Am Acad Dermatol 2006;55:490-500.<br />
					3 Jackson JM, et al. Current Understanding of Seborrheic Keratosis: Prevalence, Etiology, Clinical Presentation, Diagnosis, and Management, J Drugs Dermatol.; 14:10, 2015; 1119-1125.<br />
					4 Data on File. Aclaris Therapeutics SK In-office Observational Study, 406 dermatology patients, 2016.<br />
					5 Hairston MA, et al. Dermatosis Papulosa Nigra. Arch Dermatol. 1964;89(5):655-658. doi:10.1001/archderm.1964.01590290021003";
			break;
		case "emotional-anatomy1" :
			$out = "1 Data on File. Aclaris Therapeutics SK In-office Observational Study, 406 dermatology patients, 2016. ";
			break;
		case "clinical-perspectives1" : 
			$out = "";
			break;
		default :
			$out = "";
			break;
	}
	
	echo $out;
}

?>
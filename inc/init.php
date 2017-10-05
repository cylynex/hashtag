<?php ob_start();

// Constants
defined('SITE_ROOT') ? null : define('SITE_ROOT', '/');

// Includes
require_once("dbc.php");
require_once("database.php");
require_once("functions.php");
require_once("categories.php");
require_once("tags.php");
require_once("social.php");
require_once("photos.php");


// Don't load for ajax
if ($_SERVER['REQUEST_URI'] != "/js/ajax.php") { ?>
	<script src="/js/scripts.js"></script>
    <script src="/js/sb-admin-2.js"></script>
<?php } ?>
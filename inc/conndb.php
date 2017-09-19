<?php

$con = new mysqli("localhost", "cylynex", "se1fserv", "hashtags");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $con ->connect_errno . ") " . $con->connect_error;
}
$GLOBALS['con'] = $con;
?>

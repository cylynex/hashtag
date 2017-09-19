<?php

/* Turn off Magic Quotes */
if (get_magic_quotes_gpc()) {
        $in = array(&$_GET, &$_POST, &$_COOKIE);
        while (list($k,$v) = each($in)) {
                foreach ($v as $key => $val) {
                        if (!is_array($val)) {
                                $in[$k][$key] = stripslashes($val);
                                continue;
                        }
                        $in[] =& $in[$k][$key];
                }
        }
        unset($in);
}

function formatBytes($bytes, $precision = 2) {
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
  
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
  
    $bytes /= pow(1024, $pow);
  
    return round($bytes, $precision) . ' ' . $units[$pow];
}

/************************************************/
/* Date Tools									*/
/************************************************/
function dateconvert($date,$func) {
	if ($func == 1){ //insert conversion
		$date = date("Y-m-d",strtotime($date));
		return $date;
	}
	
	if ($func == 2){ //output conversion
		list($year, $day, $month) = explode('-', $date);
		$date = "$day-$month-$year";
		return $date;
	}
	
	if ($func == 3) {
		//takes a date in the format yyyy-mm-dd and converts it to a nice format
		$year = substr($date,0,4);
		$month = substr($date,5,2);
		$day = substr($date,8,2);
		$stamp = mktime(0,0,0,$month,$day,$year);
		//$date = date('l, F d, Y',$stamp);
		$date = date('F j, Y',$stamp);
		return $date;
	}
	
	if ($func == 4){ //output conversion
		list($year, $day, $month) = explode('-', $date);
		$date = "$day/$month/$year";
		return $date;
	}
	
	if ($func == 101) { // jquery insert conversion
		list($day, $month, $year) = explode('/', $date);
		$date = "$year-$day-$month";
		return $date;
	}
	
	if ($func == 102) { // jquery output conversion
		list($year, $day, $month) = explode('-', $date);
		$date = "$day/$month/$year";
		return $date;
	}
}


/**********************************************************************************************************************
	
	Function sc_mysql_escape()

	Purpose: to call mysql_real_escape_string(), stripping slashes before only if necessary	
	

**********************************************************************************************************************/

function sc_mysql_escape($value) {

	if (is_string($value));
	
	// strip out slashes IF they exist AND magic_quotes is on
	if (get_magic_quotes_gpc() && (strstr($value,'\"') || strstr($value,"\\'"))) $value = stripslashes($value);

	// escape string to make it safe for mysql
	return @mysql_real_escape_string($value);
}

/*********************************************************************************************************************************************

	Purpose:
		This function adds a single record to the DB
	
	Parameters:
		$table		table name (string)
		$data		array with field names as keys, and values rep. those field values
	

*********************************************************************************************************************************************/

function scrub($data) {
	$chars = array(")","(",";","-","|",">","<");
	$newdata = str_replace($chars, "", $data);
	return $newdata;
}

function safecode($data) {
	//$data = sc_mysql_escape($data);
	$bad = array("?>","<?","<?php","mysql","'","&","%","=","<script>","</script>","#",")","(","{","}");
	$data = str_replace($bad,"",$data);
	
	$data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
	
	return $data;
}

function remove_numbers($string) {
	$numstokill = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", " ");
	$string = str_replace($numstokill, '', $string);
	return $string;
}

function add_record($table,$data,$front="0"){

	// fix characters that MySQL doesn't like
	foreach(array_keys($data) as $field_name) {

		//$data[$field_name] = sc_mysql_escape($data[$field_name]);
		if ($data[$field_name] != NULL) {
			$data[$field_name] = mysqli_real_escape_string($GLOBALS['con'],$data[$field_name]);
		}
		
		if ($front == 1) {
			$data[$field_name] = safecode($data[$field_name]);
		}
		
		// Strip - not needed.
		//$data[$field_name] = scrub($data[$field_name]);
		
		if ($field_name <> "PHPSESSID") {
			if (!$field_string) {
				$field_string = "`$field_name`";
				$value_string = "'$data[$field_name]'";
			} else {
				$field_string .= ",`$field_name`";
				$value_string .= ",'$data[$field_name]'";
			}
		}
	}
	
	// Replace quotes with code
	//$value_string = str_replace('"',"&quot;", $value_string);
	$query = "INSERT INTO $table ($field_string) VALUES ($value_string)";
	
	/* DEBUG ONLY
	?>
    <script language="javascript">
		alert("<?php echo '<b>INFO:</b> '.mysql_error().'<br /><br /><b>Query was:</b> '.$query; ?>");
		</script>
    <?
	*/
				
	// if query is not successful, show error and return
	if (!mysqli_query($GLOBALS['con'],$query)) {
		?>
		<script language="javascript">
		alert("<?php echo '<b>Error:</b> '.$GLOBALS['con']->error.'<br /><br /><b>Query was:</b> '.$query; ?>");
		</script>
<?php		return;
	}
	
	// grab rn# that was just added
	$insert_id = mysqli_insert_id($GLOBALS['con']);
	
	// return record number of the record just added, in case we need it
	return $insert_id;
}


/************************************************************************************************************************

	Purpose:
		To modify a record
		
	Parameters:
		$table		table name
		$data		array with field names as keys, and values rep. those field values
		$where		MySQL where statement, minus the "WHERE" text at the beginning
		
	
************************************************************************************************************************/

function modify_record($table,$data,$where,$front="0"){

	// $data must be an array...if it's not...bail
	//if (!is_array($data)) return;

			foreach(array_keys($data) as $field_name) {
				//$data[$field_name] = sc_mysql_escape($data[$field_name]);
				if ($front == 1) {
					$data[$field_name] = safecode($data[$field_name]);
				}
				
				// Scrub - not needed
				//$data[$field_name] = scrub($data[$field_name]);
				
				// Replace quotes with code
				if ($data[$field_name] != NULL) {
					$data[$field_name] = mysqli_real_escape_string($GLOBALS['con'],$data[$field_name]);
				}
				
				// if set string isn't set, set it....else append with a comma in between
				if (!$set_string) { 
					$set_string = "`$field_name` = '$data[$field_name]'";
				} else {
					$set_string = "$set_string, `$field_name` = '$data[$field_name]'";
				}
			}
			$query = "UPDATE $table SET $set_string WHERE $where";
			if (!mysqli_query($GLOBALS['con'],$query)) {
				echo "<b>Query Failed:</b> ".mysql_error()."<br /><br /><b>Query was:</b> ".$query;
				return;
			}
}



function delete_record($table, $rn) {

		$query = "DELETE FROM $table WHERE ID = $rn";
		//echo $query."<BR>";

		if (mysql_query($query)) {
		} else {
			print "Failed to delete record";
		}
}

function delete_record_secondary($table, $rn, $id) {

		$query = "DELETE FROM $table WHERE $id = $rn";
		//echo $query."<BR>";

		if (mysql_query($query)) {
		} else {
			print "Failed to delete record";
		}
}

/*
Paramaters:
	$table is table to get records from
	$sortby is equal to a string of the name of the field you would like to sort by - ie "Name"
	$order is the order you want to sort in and can be either (0 or "ASC") for "ASC" or (1 or "DESC") for "DESC"
	$hide_records is used by functions that should not display hidden records. set it to 1 to hide records that are set as hidden in Record_Definition table
	$key_type - set to MYSQL_ASSOC to get only associative keys (no numbers)
	$force_array - if set to 1 and only one row was returned, it will be returned as an array
	$key - if set to a column name, the value in that column will be the key in the first level of the array
	
*/

function get_records($table,$select,$where=0,$sortby=0,$order=0,$test=0,$limit=0,$hide_records=0,$key_type=MYSQL_BOTH,$force_array=1,$key=""){
	global $SC;
	
	if ($where) $where_string = "WHERE $where";
	if (!$select) $select = "*";
	if ($order==0 || $order=="ASC") $order_string = "ASC";
	if ($order==1 || $order=="DESC") $order_string = "DESC";
	if ($sortby) $sort_string = "ORDER BY $sortby $order_string";
	if ($limit) $limit_string = $limit;
	
	// below section is for hiding records when you are logged in as a non developer
	if ($hide_records) {
		// if doing a search, set the query string
		if ($where) {
			$search_string = "AND $where";
			$search_string = str_replace("record_number","$table.record_number",$search_string);
			$search_string = str_replace("Table_Name","$table.Table_Name",$search_string);
		}
		$select = str_replace(",",",$table.",$select);
		$select = "$table.$select";

		// set query
		$qry = "SELECT $select 
		FROM $table
		LEFT JOIN Record_Definition rd ON $table.record_number = rd.Record AND '$table' = rd.Table_Name
		WHERE ((
		rd.Table_Name = '$table' AND rd.Hide_Record != 1
		) OR rd.Record IS NULL OR rd.Table_Name IS NULL) $search_string $sort_string $limit_string";		
	} else {
		$qry = "SELECT $select FROM $table $where_string $sort_string $limit_string";
	}
	
	//if ($test) print "query is $qry<br>";

	// grab a md5 hash of the qry for reference later
	$hash = md5($qry);
	
	// check query cache in session for result of same qry statement
	if ($SC['qry_cache'][$hash]) {
		// if qry result was cached during this same page load, then just use that cached result,
		// instead of querying DB again
		if ($SC['qry_cache'][$hash]['load_time'] == $SC['load_time']) {
			$result = $SC['qry_cache'][$hash]['result'];
		}
	}
	
	// if here, then qry is new for this page load.
	if (!isset($result)) {
		$result = sc_query($qry,$key_type,$force_array,$test,$key);
		// store qry in cache for reuse only during this page load
		$SC['qry_cache'][$hash]['result'] = $result;
		$SC['qry_cache'][$hash]['load_time'] = $SC['load_time'];
	}
	
	return $result;
}

/*
Function sc_query - to query MySQL database and return array of data

Parameters:
$qry - the SQL query statement
$type - default is MYSQL_ASSOC which will return an associative array. Can set to MYSQL_BOTH or MYSQL_?
$force_array - by default, this function will only return an array when there is more than 1 row of data. Setting this to 1 will return an array even if it only contains 1 row
$test - prints the query to the browser

*/

// Run a query
function query ($qry,$test=0) {
	
	if ($test) { echo "Query:: $qry<br>"; }
	$q = mysqli_query ($GLOBALS['con'],$qry);
	return $q;
	
}

// Fetch associative array
function assoc($query) {
	$out = mysqli_fetch_assoc($query);
	return $out;
}

// Fetch row
function row($query) {
	$out = mysqli_fetch_row($query);
	return $out;
}

function sc_query($qry,$type=MYSQL_ASSOC,$force_array=0,$test=0,$key=''){
	global $SC;

	$SC['qry_count']++;
	
	//print "qry: $qry<br>\n";
	
	if (!$qry) return;

	if (!$test) print "Query is: $qry<br>";

	$result = mysqli_query ($GLOBALS['con'],$qry);
	//echo "error: ".$error;
	//if (!$error) {
		if (is_resource($result)) {
			while ($row = mysqli_fetch_assoc ($result, $type)) {
				// fix to remove slashes added when magic_quotes_runtime is enabled
				if(get_magic_quotes_runtime()) {
					foreach (array_keys($row) as $key) {
						$row[$key] = stripslashes($row[$key]);
					}
				}

				// if a field name was passed as $key, then use the value of that column as a key....
				if ($key) {
					$records[$row[$key]] = $row;
				} else {
					// use a numeric key
					$records[] = $row;
				}
			}
		}
		if (count($records) == 1 && !$force_array) {
			$records = $records[0]; // if only one row is returned, no need to return an array of rows, just a single row
			if (count(array_keys($records)) == 1) { // if only one key for this single row, just return the value - no array needed
			$keys = array_keys($records);
			$key = $keys[0];
			$records = $records[$key];
			}
		}
		if ($records) {
			return $records;
		}
	
	/*} else {
		sc_show_diag("
			<b>MySQL error:</b> $error<br><br>
			<b>Query was:</b> $qry<br>
		");
	/*}*/
}
?>

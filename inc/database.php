<?php

// DB Class


class Database {
	
	public $connection;
	
	function __construct() {
		$this->dbconnect();
	}
	
	public function dbconnect() {
		
		$this->connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		if($this->connection->connect_errno) {
			die("Database connection failed." . $this->connection->connect_error);
		}
		
	}
	
	
	// Query
	public function query($sql) {		
		$result = $this->connection->query($sql);
		$this->confirm_query($result);
		return $result;
	}
	
	
	// Confirm the query result
	private function confirm_query($result) {
		if (!$result) {
			die ("Query Failed: ".$this->connection->error);
		}
	}
	
	
	// Escape 
	public function escape_string($string) {
		$escaped_string = $this->connection->real_escape_string($string);
		return $escaped_string;
	}
	
	
	// Get insert ID
	public function insert_id() {
		return mysqli_insert_id($this->connection);
	}
			
}

// Instantiate
$database = new Database();


class DatabaseObjects {
	// Find all
	public static function find_all() {
		return static::query("SELECT * FROM ". static::$db_table );
	}
	
	// Find by ID
	public static function find_by_id($id,$fieldname) {
		global $database;
		$the_result_array = static::query("SELECT * FROM ". static::$db_table ." WHERE $fieldname = '$id' LIMIT 1 ");
		return !empty($the_result_array) ? array_shift($the_result_array) : false;
		
	}
	
	
	// Query
	public static function query($sql) {
		global $database;
		$out = $database->query($sql);
		// instantiate
		$obj = array();
		while ($row = mysqli_fetch_array($out)) {
			$obj[] = static::instantiation($row);
		}
				
		return $obj;
	}
	
	
	// Num rows
	public static function numrows($sql) {
		$out = mysqli_num_rows($sql);
	}
	
	
	// Method to instantiate the class.
	private static function instantiation($ubid) {
		
		$calling_class = get_called_class();
		$obj = new $calling_class;
	
		foreach ($ubid AS $attribute => $value) {
			$obj->$attribute = $value;
		}
		
		return $obj;
	}
	
	
	
	// Insert into DB
	public function create() {
		global $database;
		
		// get all the properties
		$properties = $this->clean_properties();
		
		$sql = "INSERT INTO ". static::$db_table ."(". implode(',', array_keys($properties)) .")";
		$sql .= " VALUES ('". implode("','", array_values($properties)) ."')";		
		
		
		// Run the query and return
		if ($database->query($sql)) {
			return true;
		} else {
			return false;
		}
		
	}
	
	
	// Check for duplicate data in a table (ABS)
	public function check_duplicate_data($sql) {
		$query = "SELECT * FROM " . static::$db_table . " WHERE ";
		$query .= $sql;
		if(!empty($this->query($query))) { 
			// Data already exists, fail
			return false; 
		} else { 
			// Data doesnt exist, ok to add
			return true;
		}
	}
	
	
	// Update (not complete, but not used either so...)
	public function update($idfield) {
		global $database;
		
		$properties = $this ->properties();
		$properties_pairs = array();
		
		foreach($properties AS $key => $value) {
			$properties_pairs[] = "{$key}='{$value}' ";
		}
		
		$sql = "UPDATE ".static::$db_table . " SET ";
		$sql .= implode(", ", $properties_pairs);
		$sql .= " WHERE $idfield = ". $database->escape_string($this->$idfield);
		// echo "SQL query: $sql<br>";
				
		$database->query($sql);
		//return (mysqli_affected_row($database->connection) == 1) ? true : false;
		
	}
	
	
	// Delete
	public function delete($idfield) {
		global $database;
		
		$sql = "DELETE FROM ". static::$db_table ." WHERE $idfield  = '".$database->escape_string($this->$idfield)."' ";		
		$database->query($sql);		
		return true;
	}
	
	
	protected function clean_properties() {
		global $database;
		
		$clean_properties = array();
		
		foreach ($this->properties() AS $key => $value) {
			$clean_properties[$key] = $database->escape_string($value);
		}
		return $clean_properties;
		
	}
	
	
	// abstration for the properties
	protected function properties() {
		
		$properties = array();
		foreach (static::$db_table_fields AS $db_field) {
			if (property_exists($this, $db_field)) {
				$properties[$db_field] = $this->$db_field;
			}
		}
		
		return $properties;
	}
	

}

// Instantiate the DB
$db = new DatabaseObjects();
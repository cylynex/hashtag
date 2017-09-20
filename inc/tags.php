<?php

class Tags extends DatabaseObjects {
	
	protected static $db_table = "tags";	
	protected static $db_table_fields = array('tag_id','tag','tag_category','tag_hub','tag_approved','tag_sm');
	
	public $tag_id;
	public $tag;
	public $tag_category;
	public $tag_hub;
	public $tag_approved;
	public $tag_sm;

	public function tag_poll($where) {
		
		global $database;
		$sql = "SELECT * FROM tags $where";
		$match = $this->query($sql);
		return $match;
				
	}
	
	public function tag_verify_unique() {
		$tag = $this->tag;
		$category = $this->tag_category;
		$sql = " tag = '$tag' AND tag_category = '$category' ";
		if ($out = $this->check_duplicate_data($sql)) { 
			return true;
		} else { 
			return false;
		}
				
	}
	


}

?>
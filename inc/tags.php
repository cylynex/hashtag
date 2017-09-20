<?php

class Tags extends DatabaseObjects {
	
	protected static $db_table = "tags";	
	protected static $db_table_fields = array('tag_id','tag','tag_category','tag_hub');
	
	public $tag_id;
	public $tag;
	public $tag_category;
	public $tag_hug;

	public function tag_poll() {
		
		global $database;
		
		$sql = "SELECT * FROM tags";
		$match = $this->query($sql);
		var_dump($match);
		
	}
	
	






}

?>
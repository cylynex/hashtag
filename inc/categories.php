<?php

class Categories extends DatabaseObjects {
	
	protected static $db_table = "categories";	
	protected static $db_table_fields = array('cat_id','category');
	
	public $cat_id;
	public $category;

	public function categories_selector() {
		
		global $database;
		$out = $this->query("SELECT * FROM categories");
		foreach($out AS $cat) {
			?><option value="<?php echo $cat->cat_id?>"><?php echo $cat->category;?></option><?php
		}
	}
	
	






}

?>
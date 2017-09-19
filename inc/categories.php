<?php

class Categories extends Database {
	
	public function categories_selector() {
		
		global $database;
		$out = $this->query("SELECT * FROM categories");
		foreach($out AS $cat) {
			?><option value="<?php echo $cat->cat_id?>"><?php echo $cat->category;?></option><?php
		}
	}
	
	






}

?>
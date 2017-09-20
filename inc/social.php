<?php

class Social extends DatabaseObjects {
	
	protected static $db_table = "social";	
	protected static $db_table_fields = array('social_id','social','social_icon');
	
	public $social_id;
	public $social;
	public $social_icon;
	
	
	public function categories_selector() {
		
		global $database;
		
		$out = $this->query("SELECT * FROM social");
		foreach($out AS $soc) {
			?><option value="<?php echo $soc->social_id?>"> <?php echo $soc->social;?></option><?php
		}
	}

}

?>
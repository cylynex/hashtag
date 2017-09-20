<?php

class Categories extends DatabaseObjects {
	
	protected static $db_table = "categories";	
	protected static $db_table_fields = array('cat_id','category');
	
	public $cat_id;
	public $category;

	public function categories_selector() {
		
		global $database;
		$out = $this->query("SELECT * FROM categories ORDER BY category ASC");
		foreach($out AS $cat) {
			?><option value="<?php echo $cat->cat_id?>"><?php echo $cat->category;?></option><?php
		}
	}
	
	
	// Category viewer
	public function category_list() {
		$out = $this->query("SELECT * FROM categories ORDER BY category ASC");
		
		?>
        <table class="table hover">
        <tr>
        	<th width="10%">ID</th>
            <th>Category</th>
        </tr>
        <tbody>
        
        <?php		
		foreach ($out AS $cat) {
			echo "<tr>";
				echo "<td>".$cat->cat_id."</td>";
				echo "<td>".$cat->category."</td>";
			echo "</tr>";
		}
		?>
        
        </tbody>
        </table>
        <?php
	}
	
	
	public function category_verify_unique() {
		$category = $this->category;
		$sql = " category = '$category' ";
		if ($out = $this->check_duplicate_data($sql)) { 
			return true;
		} else { 
			return false;
		}
				
	}
	
	






}

?>
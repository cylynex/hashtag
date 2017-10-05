<?php

class Photos extends DatabaseObjects {
	
	protected static $db_table = "photo_desc_data";	
	protected static $db_table_fields = array('photod_id','photod_type');
	
	public $photod_id;
	public $photod_type;
	
	
	public function photo_select() {
				
		global $database;
		$out = $this->query("SELECT * FROM photo_desc_data");
		
		foreach($out AS $photo) {
			?><option value="<?php echo $photo->photod_id?>"> <?php echo $photo->photod_type;?></option><?php
			
		}
		
	}
	
	
	// Category viewer
	public function photo_list() {
		$out = $this->query("SELECT * FROM social");
		
		?>
        <table class="table hover">
        <tr>
            <th width="10%"></th>
            <th>Social Network</th>
        </tr>
        <tbody>
        
        <?php		
		foreach ($out AS $social) {
			echo "<tr>";
				echo "<td><i class='fa fa-fw fa-2x ".$social->social_icon."'></i></td>";
				echo "<td>".$social->social."</td>";
			echo "</tr>";
		}
		?>
        
        </tbody>
        </table>
        <?php
	}

}

?>
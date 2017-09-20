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
	
	
	// Category viewer
	public function social_list() {
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
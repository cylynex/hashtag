<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                #tag
                <small>where the lil tags go</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Tag Finder
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    
    <?php /*
    <div class="row">
    	<div class="col-lg-4">
        
            <b>Categories</b><br>
            <?php
            $qo = $db->query("SELECT * FROM categories");
            
            foreach ($qo AS $tagcat) {
                echo $tagcat->category."<br>";
            }
			
			$allcats = Categories::find_all();
		
            ?>
            
            
            <br /><br />
            <!--INCLUDES: <?php echo INCLUDES_PATH; ?> <br />-->
            ROOT: <?php echo SITE_ROOT; ?>
            
        </div>
        
        <div class="col-lg-4">
        	<b>
        </div>
    </div>
	*/ ?>
    
    
    <form method="post" action="">
        <div class="row">
            <div class="col-sm-4">
            	<div class="form-group">
                	<?php $c = new Categories(); ?>
                    <label for="category1">Category 1 (Weight 60%)</label>
                    <select name="category1" id="category1" class="form-control" onchange="category_select('1');">
                    	<option default value="0">Select Category</option>
                    	<?php $c->categories_selector();?>
                    </select>
                    
                </div>
            </div>
            
            <div class="col-sm-4">
            	<div class="form-group">
                	<?php $c = new Categories(); ?>
                    <label for="category2">Category 2 (Weight 25%)</label>
                    <select name="category2" id="category2" class="form-control" onchange="category_select('2');">
                    	<option default value="0">Select Category</option>
                    	<?php $c->categories_selector();?>
                    </select>
                    
                </div>
            </div>
            
            <div class="col-sm-4">
            	<div class="form-group">
                	<?php $c = new Categories(); ?>
                    <label for="category3">Category 3 (Weight 15%)</label>
                    <select name="category3" id="category3" class="form-control" onchange="category_select('3');">
                    	<option default value="0">Select Category</option>
                    	<?php $c->categories_selector();?>
                    </select>
                    
                </div>
            </div>
        </div>
        
        <?php
		// Helper to add dummy test data
		/*
		$x = 1;
		while ($x < 9) {
			$tags = New Tags;
			$tags->tag = "SunriseHub".$x;
			$tags->tag_category = 1;
			$tags->tag_hub = 1;
			$tags->create();
			$x++;
		}
		*/
		?>
    
    </form>
    
    <div class="row">
    	<div class="col-sm-12">
        	<hr>
        </div>
    </div>
    <style>.result_tags { display:inline; } </style>
    <div class="row">
		<div class="col-sm-12">
        	<div id="result_tags1" class="result_tags"></div>
            <div id="result_tags2" class="result_tags"></div>
            <div id="result_tags3" class="result_tags"></div>
        </div>
    </div>
    
    <!--
    <form method="post" action="" enctype="multipart/form-data">
    <input type="hidden" name="updateuser" value="1">
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user->user_id?>">

    <div class="col-md-6 col-md-offset-3">
            
        <div class="form-group">
            <label for="">Username</label>
            <input type="text" name="username" class="form-control" id="username" value="<?php echo $user->username?>">
        </div>
                                
        <div class="form-group">
            <label for="">First Name</label>
            <input type="text" name="first_name" class="form-control" id="first_name" value="<?php echo $user->first_name?>">
        </div>
        
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" class="form-control" id="last_name" value="<?php echo $user->last_name?>">
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input type="text" name="password" class="form-control" id="password" value="<?php echo $user->password?>">
        </div>
        
        
        <a href="delete_user.php?id=<?php echo $user->user_id; ?>" class="btn btn-danger btn-lg ">Delete</a>                 
        <input type="submit" name="Update" value="Update" class="btn btn-primary btn-lg ">
        
    </div>
    

</form>
-->

</div>
<!-- /.container-fluid -->
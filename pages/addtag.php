<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                #tag
                <small>social media tag generator</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Add Tag
                </li>
            </ol>
        </div>
    </div>
    
    <form method="post" onsubmit="return add_new_tag();">
    	<input type="hidden" name="addtag" value="1">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
            	<div class="form-group">
                	<?php $c = new Categories(); ?>
                    <label for="Tag">Tag (Do not include #)</label>
					<input type="text" name="tag" id="tag" class="form-control">                    
                </div>
                <div class="form-group">
                	<?php $c = new Categories(); ?>
                    <label for="Tag">Is Hub</label>
					<input type="checkbox" name="tag_hub" id="tag_hub" class="form-control" value="1">
                </div>
                <div class="form-group">
                	<?php $c = new Categories(); ?>
                    <label for="tag_category">Category</label>
                    <select name="tag_category" id="tag_category" class="form-control">
                    	<option default value="0">Select Category</option>
                    	<?php $c->categories_selector();?>
                    </select>                    
                </div>
                <div class="form-group">
                	<?php $soc = new Social(); ?>
                    <label for="tag_sm">Social Media</label>
                    <select name="tag_sm" id="tag_sm" class="form-control">
                    	<option default value="0">Select Category</option>
                    	<?php $soc->categories_selector();?>
                    </select>                    
                </div>
                <input type="submit" value="Add Tag" class="btn btn-primary">
                
            </div>
            
        </div>
            
    </form>
    
	<?php status_box(); ?>
    
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
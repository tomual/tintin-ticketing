<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>Edit Role</h1>

	<form method="post">
		<input type="hidden" name="rid" value="<?php echo $role->rid ?>">
	    <div class="form-group">
	        <label for="">Role Label</label>
	        <input type="text" class="form-control" id="label" name="label" value="<?php echo $role->label ?>">
	    </div>
	    <div class="form-group">
	        <label for="">Ticket</label>
	        <select class="form-control" name="permission_ticket">
	        	<option value="5" <?php echo $role->permission_ticket == 5 ? 'selected' : ''?>>All</option>
	        	<option value="4" <?php echo $role->permission_ticket == 4 ? 'selected' : ''?>>Edit all tickets</option>
	        	<option value="3" <?php echo $role->permission_ticket == 3 ? 'selected' : ''?>>Create and edit own tickets</option>
	        	<option value="2" <?php echo $role->permission_ticket == 2 ? 'selected' : ''?>>Change status and comment</option>
	        	<option value="1" <?php echo $role->permission_ticket == 1 ? 'selected' : ''?>>View</option>
	        </select>
	    </div>
	    <div class="form-group">
	        <label for="">Category</label>
	        <select class="form-control" name="permission_category">
	        	<option value="3" <?php echo $role->permission_category == 3 ? 'selected' : ''?>>All</option>
	        	<option value="2" <?php echo $role->permission_category == 2 ? 'selected' : ''?>>Create and edit</option>
	        	<option value="1" <?php echo $role->permission_category == 1 ? 'selected' : ''?>>View</option>
	        </select>
	    </div>
	    <div class="form-group">
	        <label for="">Status</label>
	        <select class="form-control" name="permission_status">
	        	<option value="3" <?php echo $role->permission_status == 3 ? 'selected' : ''?>>All</option>
	        	<option value="2" <?php echo $role->permission_status == 2 ? 'selected' : ''?>>Create and edit</option>
	        	<option value="1" <?php echo $role->permission_status == 1 ? 'selected' : ''?>>View</option>
	        </select>
	    </div>
	    <div class="form-group">
	        <label for="">Users</label>
	        <select class="form-control" name="permission_user">
	        	<option value="3" <?php echo $role->permission_user == 3 ? 'selected' : ''?>>All</option>
	        	<option value="2" <?php echo $role->permission_user == 2 ? 'selected' : ''?>>Create and edit</option>
	        	<option value="1" <?php echo $role->permission_user == 1 ? 'selected' : ''?>>View</option>
	        </select>
	    </div>
	    <div class="form-group">
	        <label for="">Roles</label>
	        <select class="form-control" name="permission_role">
	        	<option value="3" <?php echo $role->permission_role == 3 ? 'selected' : ''?>>All</option>
	        	<option value="2" <?php echo $role->permission_role == 2 ? 'selected' : ''?>>Create and edit</option>
	        	<option value="1" <?php echo $role->permission_role == 1 ? 'selected' : ''?>>View</option>
	        </select>
	    </div>
	    <button type="submit" class="btn btn-primary">Edit</button>
	    <a href="/role/all/" class="btn btn-default">Back</a>
	</form>
</div>

<?php $this->load->view('footer') ?>
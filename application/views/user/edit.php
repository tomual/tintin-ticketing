<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>Edit User</h1>
	<form method="post">
		<input type="hidden" name="uid" value="<?php echo $user->uid ?>">
	    <div class="form-group">
	        <label for="">Username</label>
	        <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $user->username ?>">
	    </div>
	    <div class="form-group">
	        <label for="">E-mail</label>
	        <input type="text" class="form-control" name="email" placeholder="E-mail address" value="<?php echo $user->email ?>">
	    </div>
	    <div class="form-group">
	        <label for="">Password</label><br />
	        <div class="row">
		        <div class="col-xs-6"><input type="password" class="form-control" name="password"></div>
		        <div class="col-xs-6"><input type="password" class="form-control" name="password2"></div>
	        </div>
	    </div>
	    <?php if($this->roles_model->has_permission('user', 2)): ?>
	    <div class="form-group">
	        <label for="">Role</label>
	        <select class="form-control" name="role">
	        	<?php foreach($roles as $role): ?>
	        		<option value="<?php echo $role->rid ?>" <?php echo $role->rid = $user->role ? "selected" : ""?> ><?php echo $role->label ?></option>
	        	<?php endforeach ?>
	        </select>
	    </div>
		<?php endif ?>
	    <div class="form-group">
		    <button type="submit" class="btn btn-primary">Edit</button>
		    <a href="<?php echo base_url() ?>user/all/" class="btn btn-default">Back</a>
	    </div>
	</form>
</div>

<?php $this->load->view('footer') ?>
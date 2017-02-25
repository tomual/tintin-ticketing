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
	        <a href="/user/password/<?php echo $user->uid ?>" class="">Change Password</a>
	    </div>
	    <div class="form-group">
	        <label for="">Role</label>
	        <select class="form-control" name="role">
	        	<?php foreach($roles as $role): ?>
	        		<option value="<?php echo $role->rid ?>" <?php echo $role->rid = $user->role ? "selected" : ""?> ><?php echo $role->label ?></option>
	        	<?php endforeach ?>
	        </select>
	    </div>
	    <div class="form-group">
		    <button type="submit" class="btn btn-primary">Edit</button>
		    <a href="/user/all/" class="btn btn-default">Back</a>
	    </div>
	</form>
</div>

<?php $this->load->view('footer') ?>
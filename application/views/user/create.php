<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>Register User</h1>

	<?php if($this->session->flashdata('error')): ?>
		<div class="alert alert-danger" role="alert">
			<?php echo $this->session->flashdata('error') ?>
		</div>
	<?php endif ?>

	<form method="post">
	    <div class="form-group <?php if(form_error('username')) echo 'has-danger' ?>">
	        <label for="">Username</label>
	        <input type="text" class="form-control" name="username" value="<?php echo set_value('username') ?>">
	    	<?php echo form_error('username') ?>
	    </div>
	    <div class="form-group <?php if(form_error('email')) echo 'has-danger' ?>">
	        <label for="">Email</label>
	        <input type="email" class="form-control" name="email" value="<?php echo set_value('email') ?>">
	    	<?php echo form_error('email') ?>
	    </div>
	    <div class="form-group <?php if(form_error('password')) echo 'has-danger' ?>">
	        <label for="">Password</label>
	        <input type="password" class="form-control" name="password">
	    	<?php echo form_error('password') ?>
	    </div>
	    <div class="form-group <?php if(form_error('password2')) echo 'has-danger' ?>">
	        <label for="">Confirm Password</label>
	        <input type="password" class="form-control" name="password2">
	    	<?php echo form_error('password2') ?>
	    </div>
	    <div class="form-group <?php if(form_error('role')) echo 'has-danger' ?>">
	        <label for="">Role</label>
	        <select class="form-control" name="role">
	        	<?php foreach($roles as $role): ?>
	        		<option value="<?php echo $role->rid ?>" <?php echo set_select('role', $role->rid) ?> ><?php echo $role->label ?></option>
	        	<?php endforeach ?>
	        </select>
	    	<?php echo form_error('role') ?>
	    </div>
	    <button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>

<?php $this->load->view('footer') ?>
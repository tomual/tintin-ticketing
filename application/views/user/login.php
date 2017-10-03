<?php $this->load->view('header') ?>

<div class="col-sm-12">

	<div class="row">
	    <div class="col-lg-4 offset-lg-4">
			<h1>Log In</h1>
			<?php if($this->session->flashdata('error')): ?>
				<div class="alert alert-danger" role="alert">
					<?php echo $this->session->flashdata('error') ?>
				</div>
			<?php endif ?>
		</div>
		<form method="post">
		    <div class="form-group col-lg-4 offset-lg-4 <?php if(form_error('username')) echo 'has-danger' ?>">
		        <label for="">Username</label>
		        <input type="text" class="form-control" name="username" value="<?php echo set_value('username') ?>">
		        <?php echo form_error('username') ?>
		    </div>
		    <div class="form-group col-lg-4 offset-lg-4 <?php if(form_error('password')) echo 'has-danger' ?>">
		        <label for="">Password</label>
		        <input type="password" class="form-control" name="password" value="<?php echo set_value('password') ?>">
		        <?php echo form_error('password') ?>
		    </div>

		    <div class="form-group col-lg-4 offset-lg-4">
		    	<a href="<?php echo base_url() ?>forgotpassword">Forgot Password</a>
		    </div>
		    <div class="form-group col-lg-4 offset-lg-4">
		    	<button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</form>
	</div>
</div>

<?php $this->load->view('footer') ?>
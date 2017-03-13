<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>Reset Password</h1>
	<p>For account <b><?php echo $email ?></b></p>
	<form method="post">
	    <div class="form-group">
	        <label for="">Password</label>
	        <input type="password" class="form-control" name="password">
	    </div>
	    <div class="form-group">
	        <label for="">Confirm Password</label>
	        <input type="password" class="form-control" name="password2">
	    </div>
	    <button type="submit" class="btn btn-primary">Reset</button>
	</form>
</div>

<?php $this->load->view('footer') ?>
<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>Forgot Password</h1>

	<form method="post">
	    <div class="form-group">
	        <label for="">Email</label>
	        <input type="text" class="form-control" name="email">
	    </div>
	    <button type="submit" class="btn btn-primary">Send Reset Link</button>
	</form>
</div>

<?php $this->load->view('footer') ?>
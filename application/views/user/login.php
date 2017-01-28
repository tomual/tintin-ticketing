<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>Log In</h1>

	<form method="post">
	    <div class="form-group">
	        <label for="">Username</label>
	        <input type="text" class="form-control" name="username">
	    </div>
	    <div class="form-group">
	        <label for="">Password</label>
	        <input type="password" class="form-control" name="password">
	    </div>
	    <button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>

<?php $this->load->view('footer') ?>
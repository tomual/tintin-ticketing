<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>Reset Link Expired</h1>
	<p>Too much time has passed since the password reset link was requested. Please reset your password again.</p>
	<a href="<?php echo base_url() ?>forgotpassword" class="btn btn-primary">Reset Password</a>
</div>

<?php $this->load->view('footer') ?>
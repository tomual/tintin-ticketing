<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>System Settings</h1>
	<form method="post" action="/settings/edit/">
	    <div class="form-group">
	        <label for="">Custom Styling (CSS)</label>
	        <textarea class="form-control" name="css" rows="10"><?php echo $settings->css ?></textarea>
	    </div>
	    <button type="submit" class="btn btn-primary">Update</button>
	</form>
</div>

<?php $this->load->view('footer') ?>
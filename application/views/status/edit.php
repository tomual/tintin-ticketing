<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>Edit Status</h1>

	<form method="post">
		<input type="hidden" name="sid" value="<?php echo $status->sid ?>">
	    <div class="form-group">
	        <label for="">Status Label</label>
	        <input type="text" class="form-control" id="label" name="label" value="<?php echo $status->label ?>">
	    </div>
	    <div class="form-group">
	        <label for="">Description</label>
	        <input type="text" class="form-control" id="description" name="description" value="<?php echo $status->description ?>">
	    </div>
	    <div class="form-group">
	        <label for="">Place</label>
	        <input type="text" class="form-control" id="place" name="place" value="<?php echo $status->place ?>">
	    </div>
	    <button type="submit" class="btn btn-primary">Edit</button>
	    <a href="/status/all/" class="btn btn-default">Back</a>
	</form>
</div>

<?php $this->load->view('footer') ?>
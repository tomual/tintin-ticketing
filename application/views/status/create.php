<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>Create Status</h1>

	<form method="post">
	    <div class="form-group">
	        <label for="">Label</label>
	        <input type="text" class="form-control" id="label" name="label" placeholder="Status label">
	    </div>
	    <div class="form-group">
	        <label for="">Description</label>
	        <input type="text" class="form-control" id="description" name="description" placeholder="Status description">
	    </div>
	    <div class="form-group">
	        <label for="">Place</label>
	        <input type="text" class="form-control" id="place" name="place" placeholder="Status placement order">
	    </div>
	    <button type="submit" class="btn btn-primary">Create</button>
		<a href="/status/all/"><button type="button" class="btn btn-default">Back</button></a>
	</form>
</div>

<?php $this->load->view('footer') ?>
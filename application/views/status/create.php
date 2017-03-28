<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>Create Status</h1>

	<?php if($this->session->flashdata('error')): ?>
		<div class="alert alert-danger" role="alert">
			<?php echo $this->session->flashdata('error') ?>
		</div>
	<?php endif ?>

	<form method="post">
	    <div class="form-group <?php if(form_error('title')) echo 'has-danger' ?>">
	        <label for="">Label</label>
	        <input type="text" class="form-control" id="label" name="label" placeholder="Status label">
	    	<?php echo form_error('label') ?>
	    </div>
	    <div class="form-group <?php if(form_error('title')) echo 'has-danger' ?>">
	        <label for="">Description</label>
	        <input type="text" class="form-control" id="description" name="description" placeholder="Status description">
	    	<?php echo form_error('description') ?>
	    </div>
	    <div class="form-group <?php if(form_error('title')) echo 'has-danger' ?>">
	        <label for="">Place</label>
	        <input type="text" class="form-control" id="place" name="place" placeholder="Status placement order">
	    	<?php echo form_error('place') ?>
	    </div>
	    <button type="submit" class="btn btn-primary">Create</button>
		<a href="/status/all/"><button type="button" class="btn btn-default">Back</button></a>
	</form>
</div>

<?php $this->load->view('footer') ?>
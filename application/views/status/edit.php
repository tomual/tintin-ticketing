<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>Edit Status</h1>

	<?php if($this->session->flashdata('error')): ?>
		<div class="alert alert-danger" role="alert">
			<?php echo $this->session->flashdata('error') ?>
		</div>
	<?php endif ?>

	<form method="post">
		<input type="hidden" name="sid" value="<?php echo $status->sid ?>">
	    <div class="form-group <?php if(form_error('label')) echo 'has-danger' ?>">
	        <label for="">Status Label</label>
	        <input type="text" class="form-control" id="label" name="label" value="<?php echo $status->label ?>">
	    	<?php echo form_error('label') ?>
	    </div>
	    <div class="form-group <?php if(form_error('description')) echo 'has-danger' ?>">
	        <label for="">Description</label>
	        <input type="text" class="form-control" id="description" name="description" value="<?php echo $status->description ?>">
	    	<?php echo form_error('description') ?>
	    </div>
	    <div class="form-group <?php if(form_error('place')) echo 'has-danger' ?>">
	        <label for="">Place</label>
	        <select name="place" class="form-control">
	        <?php for($i = 1; $i <= $count; $i++): ?>
	        	<option value="<?php echo $i ?>" <?php echo $status->place == $i ? 'selected' : ''?>><?php echo $i ?></option>
	        <?php endfor ?>
	        </select>
	    	<?php echo form_error('place') ?>
	    </div>
	    <button type="submit" class="btn btn-primary">Edit</button>
	    <a href="/status/all/" class="btn btn-default">Back</a>
	</form>
</div>

<?php $this->load->view('footer') ?>
<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>System Settings</h1>
	<form method="post" action="/settings/edit/">
	    <div class="form-group">
	        <label for="">Custom Styling (CSS)</label>
	        <textarea class="form-control" name="css" rows="10"><?php echo $settings->css ?></textarea>
	    </div>

	    <div class="form-group <?php if(form_error('start_status')) echo 'has-danger' ?>">
	        <label for="start_status">Start Status</label>
	        <select class="form-control" id="start_status" name="start_status">
				<?php foreach($statuses as $status): ?>
					<option value="<?php echo $status->sid ?>" <?php if($settings->start_status == $status->sid) echo 'selected' ?>><?php echo $status->label ?></option>
				<?php endforeach ?>
	        </select>
	        <small class="form-text text-muted">When a ticket is created, it is given this status</small>
	        <?php echo form_error('start_status') ?>
	    </div>

	    <button type="submit" class="btn btn-primary">Update</button>
	</form>
</div>

<?php $this->load->view('footer') ?>
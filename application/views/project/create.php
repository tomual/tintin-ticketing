<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>Create Project</h1>

	<?php if($this->session->flashdata('error')): ?>
		<div class="alert alert-danger" role="alert">
			<?php echo $this->session->flashdata('error') ?>
		</div>
	<?php endif ?>

	<form method="post">
	    <div class="form-group <?php if(form_error('name')) echo 'has-danger' ?>">
	        <label for="">Project Name</label>
	        <input type="text" class="form-control" id="name" name="name" placeholder="Project name">
	        <?php echo form_error('name') ?>
	    </div>
	    <button type="submit" class="btn btn-primary">Create</button>
		<a href="<?php echo base_url() ?>project/all/"><button type="button" class="btn btn-default">Back</button></a>
	</form>
</div>

<?php $this->load->view('footer') ?>
<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>Create Category</h1>

	<?php if($this->session->flashdata('error')): ?>
		<div class="alert alert-danger" role="alert">
			<?php echo $this->session->flashdata('error') ?>
		</div>
	<?php endif ?>

	<form method="post">
	    <div class="form-group <?php if(form_error('title')) echo 'has-danger' ?>">
	        <label for="">Category Name</label>
	        <input type="text" class="form-control" id="name" name="name" placeholder="Category name">
	        <?php echo form_error('name') ?>
	    </div>
	    <button type="submit" class="btn btn-primary">Create</button>
		<a href="/category/all/"><button type="button" class="btn btn-default">Back</button></a>
	</form>
</div>

<?php $this->load->view('footer') ?>
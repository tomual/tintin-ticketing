<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>Edit Category</h1>

	<?php if($this->session->flashdata('error')): ?>
		<div class="alert alert-danger" role="alert">
			<?php echo $this->session->flashdata('error') ?>
		</div>
	<?php endif ?>

	<form method="post">
		<input type="hidden" name="cid" value="<?php echo $category->cid ?>">
	    <div class="form-group <?php if(form_error('name')) echo 'has-danger' ?>">
	        <label for="">Category Name</label>
	        <input type="text" class="form-control" id="name" name="name" placeholder="category name" value="<?php echo $category->name ?>">
	        <?php echo form_error('name') ?>
	    </div>
	    <button type="submit" class="btn btn-primary">Edit</button>
	    <a href="/category/all/" class="btn btn-default">Back</a>
	</form>
</div>

<?php $this->load->view('footer') ?>
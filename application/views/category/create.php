<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>Create Category</h1>

	<form method="post">
	    <div class="form-group">
	        <label for="">Category Name</label>
	        <input type="text" class="form-control" id="name" name="name" placeholder="Category name">
	    </div>
	    <button type="submit" class="btn btn-primary">Create</button>
		<a href="/category/all/"><button type="button" class="btn btn-default">Back</button></a>
	</form>
</div>

<?php $this->load->view('footer') ?>
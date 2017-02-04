<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>Edit Category</h1>

	<form method="post">
		<input type="hidden" name="cid" value="<?php echo $category->cid ?>">
	    <div class="form-group">
	        <label for="">Category Name</label>
	        <input type="text" class="form-control" id="name" name="name" placeholder="category name" value="<?php echo $category->name ?>">
	    </div>
	    <button type="submit" class="btn btn-primary">Edit</button>
	    <a href="/category/view/<?php echo $category->cid ?>" class="btn btn-default">Cancel</a>
	</form>
</div>

<?php $this->load->view('footer') ?>
<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>Create New Ticket</h1>

	<form method="post">
	    <div class="form-group">
	        <label for="">Ticket Title</label>
	        <input type="text" class="form-control" id="title" name="title" placeholder="Ticket title">
	    </div>
	    <div class="form-group">
	        <label for="">Ticket Description</label>
	        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
	    </div>
	    <div class="form-group">
	        <label for="category">Category</label>
	        <select class="form-control" id="category" name="category">
	            <option>Maintenance</option>
	            <option>Bug Fix</option>
	            <option>New Feature</option>
	        </select>
	    </div>
	    <button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>

<?php $this->load->view('footer') ?>
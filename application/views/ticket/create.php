<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>Create New Ticket</h1>

	<form>
	    <div class="form-group">
	        <label for="exampleInputEmail1">Ticket Title</label>
	        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
	    </div>
	    <div class="form-group">
	        <label for="exampleInputPassword1">Ticket Description</label>
	        <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
	    </div>
	    <div class="form-group">
	        <label for="exampleSelect1">Category</label>
	        <select class="form-control" id="exampleSelect1">
	            <option>1</option>
	            <option>2</option>
	            <option>3</option>
	            <option>4</option>
	            <option>5</option>
	        </select>
	    </div>
	    <button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>

<?php $this->load->view('footer') ?>
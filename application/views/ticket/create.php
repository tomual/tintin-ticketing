<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>Create New Ticket</h1>

	<?php if($this->session->flashdata('error')): ?>
		<div class="alert alert-danger" role="alert">
			<?php echo $this->session->flashdata('error') ?>
		</div>
	<?php endif ?>

	<form method="post">
	    <div class="form-group <?php if(form_error('title')) echo 'has-danger' ?>">
	        <label for="">Ticket Title</label>
	        <input type="text" class="form-control" id="title" name="title" placeholder="Ticket title" value="<?php echo set_value('title') ?>">
	        <?php echo form_error('title') ?>
	    </div>
	    <div class="form-group <?php if(form_error('description')) echo 'has-danger' ?>">
	        <label for="">Ticket Description</label>
	        <textarea class="form-control" id="description" name="description" rows="3"><?php echo set_value('description') ?></textarea>
		    <?php echo form_error('description') ?>
	    </div>
	    <div class="form-group <?php if(form_error('category')) echo 'has-danger' ?>">
	        <label for="category">Category</label>
	        <select class="form-control" id="category" name="category">
	        	<option value="">Select Category ...</option>
	        <?php foreach($categories as $category): ?>
	            <option value="<?php echo $category->cid ?>" <?php echo set_select('category', $category->cid) ?>><?php echo $category->name ?></option>
	        <?php endforeach ?>
	        </select>
	        <?php echo form_error('category') ?>
	    </div>
	    <button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>

<?php $this->load->view('footer') ?>
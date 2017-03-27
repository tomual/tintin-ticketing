<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>Edit Ticket</h1>

	<?php if($this->session->flashdata('error')): ?>
		<div class="alert alert-danger" role="alert">
			<?php echo $this->session->flashdata('error') ?>
		</div>
	<?php endif ?>

	<form method="post">
		<input type="hidden" name="tid" value="<?php echo $ticket->tid ?>">
	    <div class="form-group <?php if(form_error('title')) echo 'has-danger' ?>">
	        <label for="">Ticket Title</label>
	        <input type="text" class="form-control" id="title" name="title" placeholder="Ticket title" value="<?php echo $ticket->title ?>">
	        <?php echo form_error('title') ?>
	    </div>
	    <div class="form-group <?php if(form_error('description')) echo 'has-danger' ?>">
	        <label for="">Ticket Description</label>
	        <textarea class="form-control" id="description" name="description" rows="3"><?php echo $ticket->description ?></textarea>
	        <?php echo form_error('description') ?>
	    </div>
	    <div class="form-group <?php if(form_error('category')) echo 'has-danger' ?>">
	        <label for="category">Category</label>
	        <select class="form-control" id="category" name="category">
				<?php foreach($categories as $category): ?>
					<option value="<?php echo $category->cid ?>" <?php if($ticket->cid == $category->cid) echo 'selected' ?>><?php echo $category->name ?></option>
				<?php endforeach ?>
	        </select>
		    <?php echo form_error('category') ?>
	    </div>
	    <div class="form-group <?php if(form_error('status')) echo 'has-danger' ?>">
	        <label for="status">Status</label>
	        <select class="form-control" id="status" name="status">
				<?php foreach($statuses as $status): ?>
					<option value="<?php echo $status->sid ?>" <?php if($ticket->sid == $status->sid) echo 'selected' ?>><?php echo $status->label ?></option>
				<?php endforeach ?>
	        </select>
	        <?php echo form_error('status') ?>
	    </div>
	    <button type="submit" class="btn btn-primary">Edit</button>
	    <a href="/ticket/view/<?php echo $ticket->tid ?>" class="btn btn-default">Back</a>
	</form>
</div>

<?php $this->load->view('footer') ?>
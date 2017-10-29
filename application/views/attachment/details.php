<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>Attachment Information</h1>

	<form method="post">
		<?php foreach($attachments as $attachment): ?>
			<?php if(empty($attachment->title)): ?>
				<div class="row">
					<div class="col-md-4">
					<?php if($attachment->is_image == 'Y'): ?>
						<div class="attachment-preview" style="background-image:url('<?php echo base_url("/attachments/{$attachment->filename}") ?>')"></div>
					<?php else: ?>
						<div class="attachment-preview"><i class="fa fa-file-o" aria-hidden="true"></i></div>
					<?php endif ?>
					</div>
					<div class="col-md-8">
				        <input type="hidden" name="aids[]" value="<?php echo $attachment->aid ?>">
					    <div class="form-group">
					        <label for="">Attachment Name</label>
					        <input type="text" class="form-control" id="label" name="<?php echo $attachment->aid ?>-title" placeholder="<?php echo $attachment->filename ?>">
					    </div>
					    <div class="form-group">
					        <label for="">Description</label>
					        <input type="text" class="form-control" id="description" name="<?php echo $attachment->aid ?>-description">
					    </div>
					</div>
			    </div>
			<?php endif ?>
		<?php endforeach ?>
		<div class="row">
			<div class="col-md-4">
			</div>
			<div class="col-md-8">
		    	<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</div>
	</form>
</div>

<?php $this->load->view('footer') ?>
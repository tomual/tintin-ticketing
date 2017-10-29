<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1><?php echo $attachment->title ?></h1>

	<form method="post">
		<div class="row">
			<div class="col-md-12">
				<a href="<?php echo base_url("/attachments/{$attachment->filename}") ?>" target="_blank">
					<?php if($attachment->is_image == 'Y'): ?>
						<div class="attachment-full" style="background-image:url('<?php echo base_url("/attachments/{$attachment->filename}") ?>')"></div>
					<?php else: ?>
						<div class="attachment-full"><i class="fa fa-file-o" aria-hidden="true"></i></div>
					<?php endif ?>
				</a>
			</div>
			<div class="col-md-12">
				<p><?php echo $attachment->description ? $attachment->description : "No Description" ?></p>
			</div>
	    </div>
	</form>
	<a href="<?php echo base_url("ticket/view/{$attachment->tid}") ?>" class="btn btn-primary">Go to Ticket</a>
</div>

<?php $this->load->view('footer') ?>
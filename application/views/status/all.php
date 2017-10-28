<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>Statuses</h1>

	<table class="table">
		<thead>
			<tr>
				<th></th>
				<th>Label</th>
				<th>Description</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach( $statuses as $status ): ?>
				<tr id="<?php echo $status->sid ?>">
					<td></td>
					<td><?php echo $status->label ?></td>
					<td><?php echo $status->description ?></td>
					<td>
						<?php if($this->roles_model->has_permission('status', 2)): ?>
							<form method="post" action="<?php echo base_url() ?>/status/remove/<?php echo $status->sid ?>">
								<button type="button" class="btn btn-link status-move up"><i class="fa fa-caret-up" aria-hidden="true"></i></button>
								<button type="button" class="btn btn-link status-move down"><i class="fa fa-caret-down" aria-hidden="true"></i></button>
								<a href="<?php echo base_url() ?>status/edit/<?php echo $status->sid ?>"><button type="button" class="btn btn-link"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
								<button type="submit" class="btn btn-link" onclick="return confirm('Are you sure you want to delete the status?')"><i class="fa fa-times" aria-hidden="true"></i></button>
							</form>
						<?php endif ?>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>

	<a href="<?php echo base_url() ?>status/create/"><button class="btn btn-primary">New status</button></a>
</div>

<?php $this->load->view('footer') ?>
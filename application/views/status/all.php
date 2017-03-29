<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>Statuses</h1>

	<table class="table">
		<thead>
			<tr>
				<th>Place</th>
				<th>Label</th>
				<th>Description</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach( $statuses as $status ): ?>
				<tr>
					<td><?php echo $status->place ?></td>
					<td><?php echo $status->label ?></td>
					<td><?php echo $status->description ?></td>
					<td>
						<?php if($this->roles_model->has_permission('status', 2)): ?>
							<form method="post" action="/status/remove/<?php echo $status->sid ?>">
								<a href="/status/edit/<?php echo $status->sid ?>"><button type="button" class="btn btn-link"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
								<button type="submit" class="btn btn-link" onclick="return confirm('Are you sure you want to delete the status?')"><i class="fa fa-times" aria-hidden="true"></i></button>
							</form>
						<?php endif ?>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>

	<a href="/status/create/"><button class="btn btn-primary">New status</button></a>
</div>

<?php $this->load->view('footer') ?>
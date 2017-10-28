<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>Statuses</h1>

	<table class="table">
		<thead>
			<tr>
				<th>Role</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach( $roles as $role ): ?>
				<tr>
					<td><?php echo $role->label ?></td>

					<?php if($this->roles_model->has_permission('role', 2)): ?>
					<td>
						<form method="post" action="<?php echo base_url() ?>/role/remove/<?php echo $role->rid ?>">
							<a href="<?php echo base_url() ?>role/edit/<?php echo $role->rid ?>"><button type="button" class="btn btn-link"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
							<button type="submit" class="btn btn-link"><i class="fa fa-times" aria-hidden="true"></i></button>
						</form>
					</td>
					<?php endif ?>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>

	<a href="<?php echo base_url() ?>role/create/"><button class="btn btn-primary">New role</button></a>
</div>

<?php $this->load->view('footer') ?>
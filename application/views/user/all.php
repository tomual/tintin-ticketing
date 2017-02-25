<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>Users</h1>

	<table class="table">
		<thead>
			<tr>
				<th>Username</th>
				<th>Role</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach( $users as $user ): ?>
				<tr>
					<td><?php echo $user->username ?></td>
					<td><?php echo $user->label ?></td>

					<?php if($this->roles_model->has_permission('user', 2)): ?>
					<td>
						<form method="post" action="/user/remove/<?php echo $user->rid ?>">
							<a href="/user/edit/<?php echo $user->rid ?>"><button type="button" class="btn btn-link"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
							<button type="submit" class="btn btn-link"><i class="fa fa-times" aria-hidden="true"></i></button>
						</form>
					</td>
					<?php endif ?>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>

	<a href="/user/create/"><button class="btn btn-primary">New user</button></a>
</div>

<?php $this->load->view('footer') ?>
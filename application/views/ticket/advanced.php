<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>Advanced Search</h1>

	<div class="container advanced-search">
		<div class="form-group row">
			<label for="category" class="col-form-label">Add Search Criteria ...</label>
			<select class="form-control">
				<option value="status">Status</option>
				<option value="category">Category</option>
				<option value="user">User</option>
				<option value="created">Created</option>
			</select>

			<br>
			<form class="form-horizontal" method="post">
				<div class="form-group row">
					<label for="category" class="col-sm-2 col-form-label"><i class="fa fa-times" aria-hidden="true"></i> Category</label>
					<div class="col-sm-10">
						<select name="category" class="form-control">
							<option value="">Select ...</option>
							<?php foreach($categories as $category): ?>
								<option value="<?php echo $category->cid ?>" <?php if($this->input->post('category') == $category->cid) echo 'selected' ?>><?php echo $category->name ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label for="author" class="col-sm-2 col-form-label"><i class="fa fa-times" aria-hidden="true"></i> Users</label>
					<div class="col-sm-10">
						<select name="author" class="form-control">
							<option value="">Select ...</option>
							<?php foreach($users as $user): ?>
								<option value="<?php echo $user->uid ?>" <?php if($this->input->post('author') == $user->uid) echo 'selected' ?>><?php echo $user->username ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label for="status" class="col-sm-2 col-form-label"><i class="fa fa-times" aria-hidden="true"></i> Status</label>
					<div class="col-sm-10">
						<select name="status" class="form-control">
							<option value="">Select ...</option>
							<?php foreach($statuses as $status): ?>
								<option value="<?php echo $status->sid ?>" <?php if($this->input->post('status') == $status->sid) echo 'selected' ?>><?php echo $status->label ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>

				<input type="submit" class="btn btn-secondary">

			</form>
		</div>
	</div>
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Title</th>
				<th>Status</th>
				<th>Author</th>
				<th>Created</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach( $tickets as $ticket ): ?>
				<tr>
					<td><?php echo $ticket->tid ?></td>
					<td><a href="/ticket/view/<?php echo $ticket->tid ?>"><?php echo $ticket->title ?></a></td>
					<td><?php echo $ticket->label ?></td>
					<td><?php echo $ticket->username ?></td>
					<td><?php echo date('d/m/Y', strtotime($ticket->created)) ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>

<?php $this->load->view('footer') ?>
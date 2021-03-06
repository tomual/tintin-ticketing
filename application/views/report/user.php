<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>Tickets By User</h1>

	<form method="GET" class="form-inline">
		<div class="form-group-inline">
			<select name="user" class="form-control">
				<?php foreach($users as $user): ?>
					<option value="<?php echo $user->uid ?>" <?php if($this->input->get('user') == $user->uid) echo 'selected' ?>><?php echo $user->username ?></option>
				<?php endforeach ?>
			</select>
			<input type="submit" value="Refine" class="form-control btn btn-primary">
		</div>
	</form>
	<br>
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
			<?php if(!count($tickets)): ?>
				<tr>
					<td>There are no tickets matching that user.</td>
				</tr>
			<?php endif ?>
			<?php foreach( $tickets as $ticket ): ?>
				<tr>
					<td><?php echo $ticket->tid ?></td>
					<td><a href="<?php echo base_url() ?>ticket/view/<?php echo $ticket->tid ?>"><?php echo $ticket->title ?></a></td>
					<td><?php echo $ticket->label ?></td>
					<td><?php echo $ticket->username ?></td>
					<td><?php echo date('d/m/Y', strtotime($ticket->created)) ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>

<?php $this->load->view('footer') ?>
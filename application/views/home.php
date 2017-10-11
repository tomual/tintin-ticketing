<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>Tintin Ticketing System</h1>

	<p>Welcome to Tintin, an open source ticketing system.</p>

	<p>Use the navigation above to get started.</p>
	<h2>Summary</h2>
	<?php if(empty($summary)): ?>
		<p>There are currently no tickets. Click "New Ticket" above to create a ticket.</p>
	<?php else: ?>
			<table class="summary table table-bordered">
				<thead>
					<tr>
						<?php foreach($summary as $status): ?>
							<td><?php echo $status->label ?></td>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<tr>
						<?php foreach($summary as $status): ?>
							<td><?php echo $status->count ?></td>
						<?php endforeach ?>
					</tr>
				</tbody>
			</table>
	<?php endif ?>

	<h2>Recent Changes</h2>

	<table class="recent table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Title</th>
				<th>Status</th>
				<th>Author</th>
				<th>Modified</th>
			</tr>
		</thead>
		<tbody>
			<?php if(!count($recent)): ?>
				<tr>
					<td>There are no recently changed tickets.</td>
				</tr>
			<?php endif ?>
			<?php foreach( $recent as $ticket ): ?>
				<tr>
					<td><?php echo $ticket->tid ?></td>
					<td><a href="<?php echo base_url() ?>ticket/view/<?php echo $ticket->tid ?>"><?php echo $ticket->title ?></a></td>
					<td><?php echo $ticket->label ?></td>
					<td><?php echo $ticket->username ?></td>
					<td><?php echo timespan(strtotime($ticket->modified), time()) . ' ago' ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>

<?php $this->load->view('footer') ?>
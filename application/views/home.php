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
</div>

<?php $this->load->view('footer') ?>
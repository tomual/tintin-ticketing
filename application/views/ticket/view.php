<?php $this->load->view('header') ?>

<div class="col-sm-12 ticket">
	<h2>Ticket ID: <?php echo $ticket->tid ?></h2>
	<h1><?php echo $ticket->title ?></h1>

	<table class="table">
		<tr>
			<th width="100">Created</th>
			<td><?php echo date('d/m/Y h:mA', strtotime($ticket->created)) ?></td>
		</tr>
		<tr>
			<th>Author</th>
			<td><?php echo $ticket->name ?></td>
		</tr>
		<tr>
			<th>Category</th>
			<td><?php echo $ticket->label ?></td>
		</tr>
		<tr>
			<td colspan="2"><?php echo $ticket->description ?></td>
		</tr>
	</table>
</div>

<?php $this->load->view('footer') ?>
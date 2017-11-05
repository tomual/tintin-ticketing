<?php $this->load->view('header') ?>

<div class="col-sm-12 content">
	<h1><?php echo $title ?></h1>

	<p class="report-description"><?php echo $description ?></p>
	<br>

	<table class="table table-striped">
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
					<td><a href="<?php echo base_url() ?>ticket/view/<?php echo $ticket->tid ?>"><?php echo $ticket->title ?></a></td>
					<td><?php echo $ticket->label ?></td>
					<td><?php echo $ticket->username ?></td>
					<td><?php echo date('d/m/Y', strtotime($ticket->created)) ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
	
	<?php $this->load->view('ticket/pagination') ?>
</div>

<?php $this->load->view('footer') ?>
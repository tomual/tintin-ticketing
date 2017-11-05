<?php $this->load->view('header') ?>


<div class="col-sm-12 content">
	<h1>Kanban Board</h1>

	<div class="kanban-board">
		<?php foreach($kanban_tickets as $status => $tickets): ?>
			<div class="kanban-column" style="width: <?php echo 100 / count($kanban_tickets) - 1 ?>%">
				<div class="status-header"><?php echo $status ?></div>

				<?php foreach( $tickets as $ticket ): ?>
					<div class="kanban-ticket">
						<div class="id"><?php echo $ticket->tid ?></div>
						<div class="title"><a href="<?php echo base_url() ?>ticket/view/<?php echo $ticket->tid ?>"><?php echo $ticket->title ?></a></div>
						<div class="author"><?php echo $ticket->username ?></div>
						<div class="date"><?php echo date('d/m/Y', strtotime($ticket->created)) ?></div>
					</div>
				<?php endforeach ?>
			</div>
		<?php endforeach ?>
	</div>

</div>

<?php $this->load->view('footer') ?>
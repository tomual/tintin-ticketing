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
			<th width="100">Modified</th>
			<td><?php echo date('d/m/Y h:mA', strtotime($ticket->created)) ?></td>
		</tr>
		<tr>
			<th>Author</th>
			<td><?php echo $ticket->author ?></td>
		</tr>
		<tr>
			<th>Category</th>
			<td><?php echo $ticket->category ?></td>
		</tr>
		<tr>
			<th>Status</th>
			<td><?php echo $ticket->status ?></td>
		</tr>
		<tr>
			<td colspan="2"><?php echo $ticket->description ?></td>
		</tr>
	</table>

	<h2>Changes</h2>
	<table class="table">
		<?php foreach($versions as $version): ?>
				<tr>
					<td>
						<?php echo date('d/m/y h:mA', strtotime($version->created)) ?> by <?php echo $version->username ?><br />
						<?php foreach(json_decode($version->difference) as $key=>$value): ?>
							<b><?php echo $key ?></b> changed from <?php echo $value->before?> to <?php echo $value->after ?><br />
						<?php endforeach ?>
						<br />
						<?php echo !empty($version->comment) ? $version->comment : "<i>No Comment</i>" ?>
						<br />
						<br />
					</td>
				</tr>
		<?php endforeach ?>
	</table>

	<h2>Update</h2>
	<form method="post">
		<input type="hidden" name="tid" value="<?php echo $ticket->tid ?>">
	    <div class="form-group">
	        <label for="status">Status</label>
	        <select class="form-control" id="status" name="status">
				<?php foreach($statuses as $status): ?>
					<option value="<?php echo $status->sid ?>" <?php if($ticket->sid == $status->sid) echo 'selected' ?>><?php echo $status->label ?></option>
				<?php endforeach ?>
	        </select>
	    </div>
	    <div class="form-group">
	        <label for="">Comments</label>
	        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
	    </div>
	    <button type="submit" class="btn btn-primary">Update</button>
	</form>
</div>

<?php $this->load->view('footer') ?>
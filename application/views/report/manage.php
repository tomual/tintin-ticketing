<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>Reports</h1>

	<table class="table">
		<thead>
			<tr>
				<th></th>
				<th>Title</th>
				<th>Description</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach( $reports as $report ): ?>
				<tr id="<?php echo $report->rid ?>">
					<td></td>
					<td><?php echo $report->title ?></td>
					<td><?php echo $report->description ?></td>
					<td>
						<?php if($this->roles_model->has_permission('report', 2)): ?>
							<form method="post" action="<?php echo base_url() ?>/report/remove/<?php echo $report->rid ?>">
								<a href="<?php echo report_query_to_url($report->rid, $report->query) ?>"><button type="button" class="btn btn-link"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
								<button type="submit" class="btn btn-link" onclick="return confirm('Are you sure you want to delete the report?')"><i class="fa fa-times" aria-hidden="true"></i></button>
							</form>
						<?php endif ?>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>

	<a href="<?php echo base_url() ?>report/create/"><button class="btn btn-primary">New report</button></a>
</div>

<?php $this->load->view('footer') ?>
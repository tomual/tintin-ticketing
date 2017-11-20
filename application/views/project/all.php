<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>Projects</h1>

	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach( $projects as $project ): ?>
				<tr>
					<td><?php echo $project->pid ?></td>
					<td><?php echo $project->name ?></td>					
					<td>
						<?php if($this->roles_model->has_permission('project', 2)): ?>
							<form method="post" action="<?php echo base_url() ?>/project/remove/<?php echo $project->pid ?>">
								<a href="<?php echo base_url() ?>project/edit/<?php echo $project->pid ?>"><button type="button" class="btn btn-link"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
								<button type="submit" class="btn btn-link" onclick="return confirm('Are you sure you want to delete the project?')"><i class="fa fa-times" aria-hidden="true"></i></button>
							</form>
						<?php endif ?>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>

	<a href="<?php echo base_url() ?>project/create/"><button class="btn btn-primary">New Project</button></a>
</div>

<?php $this->load->view('footer') ?>
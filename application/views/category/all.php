<?php $this->load->view('header') ?>

<div class="col-sm-12">
	<h1>Categories</h1>

	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach( $categories as $category ): ?>
				<tr>
					<td><?php echo $category->cid ?></td>
					<td><?php echo $category->name ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>

<?php $this->load->view('footer') ?>
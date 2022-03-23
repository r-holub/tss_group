<table id="customers-table">
	<thead>
		<th>ID</th>
		<th>Number</th>
		<th>Name</th>
		<th>Last name</th>
		<th>Category</th>
		<th>Date</th>
		<th></th>
		<th></th>
	</thead>
	<tbody>
		<? foreach ($data['customers'] as $customer) { ?>
		<tr>
			<td>
				<input type="hidden" value="<?= $customer['customer_id'] ?>" name="customer_id">
				<?= $customer['customer_id'] ?>
			</td>
			<td><input type="tel" value="<?= $customer['number'] ?>" name="number"></td>
			<td><input type="text" value="<?= $customer['name'] ?>" name="name"></td>
			<td><input type="text" value="<?= $customer['last_name'] ?>" name="last_name"></td>
			<td>
				<? foreach ($data['categories'] as $category) { ?>
				<label>
					<input type="radio" value="<?= $category['category_id'] ?>" name="category_id" <?= $customer['category_id'] == $category['category_id'] ? 'checked="checked"' : '' ?>>
					<?= $category['name'] ?>
				</label>
				<? } ?>
			</td>
			<td>
				<?= $customer['date_created'] ?>
			</td>
			<td>
				<a role="button" class="save">Save changes</a>
			</td>
			<td>
				<a role="button" class="delete">Delete</a>
			</td>
		</tr>
		<? } ?>
	</tbody>
</table>
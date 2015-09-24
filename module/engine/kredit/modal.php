<form class="form-jenis" role="form">
	<div class="input-group">
		<input type="hidden" name="ac" value="jenis" class="ac-jenis">
		<input type="hidden" name="id" value="" class="id-jenis">
		<input type="text" class="form-control jenis-baru" required="required" name="new">
		<div class="input-group-btn btn-jenis">
			<button type="submit" class="btn btn-primary tambah-jenis">Add</button>
		</div>
	</div>
</form>
<table class="table table-hover">
	<thead>
		<tr>
			<th>Jenis</th>
			<th></th>
		</tr>
	</thead>
	<tbody class="jenis-item">
	</tbody>
</table>
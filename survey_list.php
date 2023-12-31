<?php include 'db_connect.php'; ?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary"
					href="./index.php?page=new_survey"><i class="fa fa-plus"></i> Add New Survey</a>
			</div>
		</div>
		<div class="table-responsive" style="padding:10px">
			<table class="table table-hover table-bordered" id="list">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="15%">
					<col width="15%">
					<col width="15%">
					<col width="15%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Survey Number</th>
						<th>Name</th>
						<th>Email</th>
						<th>Firm Name</th>
						<th>Contact</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$surveyor_id = $_SESSION['login_Surveyor_ID']; // Get surveyor_id from session
					$qry = $conn->query("SELECT * FROM rx_survey_data WHERE surveyor_id = '$surveyor_id'");
					while ($row = $qry->fetch_assoc()):
						?>
						<tr>
							<th class="text-center">
								<?php echo $i++ ?>
							</th>
							<td><b>
									<?php echo $row['survey_no'] ?>
								</b></td>
							<td><b>
									<?php echo $row['first_name'] . " " . $row['last_name'] ?>
								</b></td>
							<td><b>

									<?php echo $row['email_id'] ?>
								</b></td>
							<td><b>
									<?php echo $row['firm_name'] ?>
								</b></td>
							<td><b>
									<?php echo $row['contact_number_1'] ?>
								</b></td>
							<td class="text-center">
								<div class="btn-group">
									<a href="./index.php?page=edit_survey&id=<?php echo $row['survey_id'] ?>"
										class="btn btn-primary btn-flat">
										<i class="fas fa-edit"></i>
									</a>
									<a href="./index.php?page=view_survey&id=<?php echo $row['survey_id'] ?>"
										class="btn btn-info btn-flat">
										<i class="fas fa-eye"></i>
									</a>
									<!-- <button type="button" class="btn btn-danger btn-flat delete_survey" data-id="<?php echo $row['survey_id'] ?>">
										<i class="fas fa-trash"></i>
									</button> -->
								</div>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {
		$('#list').dataTable();
		$('.delete_survey').click(function () {
			_conf("Are you sure to delete this survey?", "delete_survey", [$(this).attr('data-id')]);
		});
	});

	function delete_survey($id) {
		start_load();
		$.ajax({
			url: 'ajax.php?action=delete_survey',
			method: 'POST',
			data: { id: $id },
			success: function (resp) {
				if (resp == 1) {
					alert_toast("Data successfully deleted", 'success');
					setTimeout(function () {
						location.reload();
					}, 1500);
				}
			}
		});
	}
</script>
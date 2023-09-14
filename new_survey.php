<?php
if (!isset($conn)) {
	include 'db_connect.php';
}

// Check if the 'mode' parameter is set to 'edit' in the URL
if (isset($mode) && $mode === 'edit') {
	// Check if the 'id' parameter is also set
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		// Fetch existing data from the database based on the $id
		$qry = $conn->query("SELECT * FROM rx_survey_data WHERE survey_id = $id");
		$row = $qry->fetch_assoc();

		// Assign data to variables for prefilling the form
		$survey_no = $row['survey_no'];
		$first_name = $row['first_name'];
		$middle_name = $row['middle_name'];
		$last_name = $row['last_name'];
		$education = $row['education'];
		$firm_name = $row['firm_name'];
		$address = $row['address'];
		$gps_coordinates = $row['gps_coordinates'];
		$contact_number_1 = $row['contact_number_1'];
		$contact_number_2 = $row['contact_number_2'];
		$email_id = $row['email_id'];
		$license_status = $row['license_status'];
		$lic_holder_name = $row['lic_holder_name'];
		$relation = $row['relation'];
		$validity = $row['validity'];
		$business_age = $row['business_age'];
		$total_investment = $row['total_investment'];
		$total_investment_inventory = $row['total_investment_inventory'];
		$avg_sale_per_day = $row['avg_sale_per_day'];
		$avg_expenses_per_day = $row['avg_expenses_per_day'];
		$inventory_rotation = $row['inventory_rotation'];
		$avg_shelf_life = $row['avg_shelf_life'];
		$max_stock_wait_days = $row['max_stock_wait_days'];
		$unsellable_stock_count = $row['unsellable_stock_count'];
		$unsellable_stock_cost = $row['unsellable_stock_cost'];
		$computer_at_shop = $row['computer_at_shop'];
		$internet_available = $row['internet_available'];
		$inventory_management_software = $row['inventory_management_software'];
		$shop_area = $row['shop_area'];
		$sale_dependency = $row['sale_dependency'];
		$hospitals_5km = $row['hospitals_5km'];
		$hospitals_list = $row['hospitals_list'];
		$distributors_per_month = $row['distributors_per_month'];
		$discount_range = $row['discount_range'];
		$conditions_for_discount = $row['conditions_for_discount'];
		$shop_open_time = $row['shop_open_time'];
		$shop_close_time = $row['shop_close_time'];
		$chemistImage = $row['chemist_photo'];
		$shopImage = $row['shop_photo'];
		print_r($row['chemist_photo']);
		print_r($shopImage);
		$button_text = 'Update'; // Change the button text to "Update"
		$form_action = 'update_survey'; // Change the form action to the update process
	}
} elseif (isset($mode) && $mode === 'view') {
	// Check if the 'id' parameter is also set
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		// Fetch existing data from the database based on the $id
		$qry = $conn->query("SELECT * FROM rx_survey_data WHERE survey_id = $id");
		$row = $qry->fetch_assoc();

		// Assign data to variables for prefilling the form
		$survey_no = $row['survey_no'];
		$first_name = $row['first_name'];
		$middle_name = $row['middle_name'];
		$last_name = $row['last_name'];
		$education = $row['education'];
		$firm_name = $row['firm_name'];
		$address = $row['address'];
		$gps_coordinates = $row['gps_coordinates'];
		$contact_number_1 = $row['contact_number_1'];
		$contact_number_2 = $row['contact_number_2'];
		$email_id = $row['email_id'];
		$license_status = $row['license_status'];
		$lic_holder_name = $row['lic_holder_name'];
		$relation = $row['relation'];
		$validity = $row['validity'];
		$business_age = $row['business_age'];
		$total_investment = $row['total_investment'];
		$total_investment_inventory = $row['total_investment_inventory'];
		$avg_sale_per_day = $row['avg_sale_per_day'];
		$avg_expenses_per_day = $row['avg_expenses_per_day'];
		$inventory_rotation = $row['inventory_rotation'];
		$avg_shelf_life = $row['avg_shelf_life'];
		$max_stock_wait_days = $row['max_stock_wait_days'];
		$unsellable_stock_count = $row['unsellable_stock_count'];
		$unsellable_stock_cost = $row['unsellable_stock_cost'];
		$computer_at_shop = $row['computer_at_shop'];
		$internet_available = $row['internet_available'];
		$inventory_management_software = $row['inventory_management_software'];
		$shop_area = $row['shop_area'];
		$sale_dependency = $row['sale_dependency'];
		$hospitals_5km = $row['hospitals_5km'];
		$hospitals_list = $row['hospitals_list'];
		$distributors_per_month = $row['distributors_per_month'];
		$discount_range = $row['discount_range'];
		$conditions_for_discount = $row['conditions_for_discount'];
		$shop_open_time = $row['shop_open_time'];
		$shop_close_time = $row['shop_close_time'];
		$chemistImage = $row['chemist_photo'];
		$shopImage = $row['shop_photo'];
		// print $chemistImage; and print $shopImage; are not working
		print_r($chemistImage);
		print_r($shopImage);
		// Disable input fields for viewing
		$input_disabled = 'disabled';
		$button_text = 'View'; // Button text for viewing data
	}
} else {
	$id = '';
	$first_name = 'Abdul';
	$middle_name = 'view only';
	$last_name = 'Majid';
	$education = 'Education';
	$firm_name = 'Firm';
	$address = '123 Street, City';
	$gps_coordinates = 'Latitude, Longitude';
	$contact_number_1 = '123-456-7890';
	$contact_number_2 = '987-654-3210';
	$email_id = 'email@example.com';
	$license_status = 'owned'; // Default to 'owned'
	$lic_holder_name = 'License Holder';
	$relation = 'Relation';
	$validity = '2023-09-13'; // Default date value
	$business_age = '5';
	$total_investment = '50000';
	$total_investment_inventory = '20000';
	$avg_sale_per_day = '1000';
	$avg_expenses_per_day = '500';
	$inventory_rotation = '10';
	$avg_shelf_life = '30';
	$max_stock_wait_days = '7';
	$unsellable_stock_count = '20';
	$unsellable_stock_cost = '100';
	$computer_at_shop = 'Yes'; // Default to 'Yes'
	$internet_available = 'Yes'; // Default to 'Yes'
	$inventory_management_software = 'Software';
	$shop_area = '2000';
	$sale_dependency = 'High'; // Default to 'High'
	$hospitals_5km = '5';
	$hospitals_list = 'Hospital 1, Hospital 2';
	$distributors_per_month = '10';
	$discount_range = '5-10%';
	$conditions_for_discount = 'None';
	$shop_open_time = '08:00';
	$shop_close_time = '20:00';

}
?>

<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<form id="manage_survey" enctype="multipart/form-data">
				<input type="hidden" name="survey_id" id="survey_id" value="<?php echo $id; ?>">
				<input type="hidden" name="survey_no" id="survey_no" value="<?php echo $survey_no; ?>">
				<div class="row">
					<div class="col-md-6 border-right">
						<div class="form-group">
							<label for="first_name" class="control-label">First Name</label>
							<input type="text" name="first_name" class="form-control form-control-sm" required
								value="<?php echo isset($first_name) ? $first_name : 'Abdul' ?>">
						</div>
						<div class="form-group">
							<label for="middle_name" class="control-label">Middle Name</label>
							<input type="text" name="middle_name" class="form-control form-control-sm"
								value="<?php echo isset($middle_name) ? $middle_name : 'Middle' ?>">
						</div>
						<div class="form-group">
							<label for="last_name" class="control-label">Last Name</label>
							<input type="text" name="last_name" class="form-control form-control-sm" required
								value="<?php echo isset($last_name) ? $last_name : 'Majid' ?>">
						</div>
						<div class="form-group">
							<label for="education" class="control-label">Education</label>
							<input type="text" name="education" class="form-control form-control-sm" required
								value="<?php echo isset($education) ? $education : 'Education' ?>">
						</div>
						<div class="form-group">
							<label for="firm_name" class="control-label">Firm Name</label>
							<input type="text" name="firm_name" class="form-control form-control-sm" required
								value="<?php echo isset($firm_name) ? $firm_name : 'Firm' ?>">
						</div>
						<div class="form-group">
							<label for="address" class="control-label">Address</label>
							<textarea name="address" id="address" cols="30" rows="4" class="form-control"
								required><?php echo isset($address) ? $address : '123 Street, City' ?></textarea>
						</div>
						<div class="form-group">
							<label for="gps_coordinates" class="control-label">GPS Coordinates</label>
							<input type="text" name="gps_coordinates" id="gps_coordinates"
								class="form-control form-control-sm" required
								value="<?php echo isset($gps_coordinates) ? $gps_coordinates : 'Latitude, Longitude' ?>">
							<button type="button" class="btn custom-btn" onclick="findLocation()">Find Your
								Location</button>
						</div>
						<div class="form-group">
							<label for="contact_number_1" class="control-label">Contact Number 1</label>
							<input type="text" name="contact_number_1" class="form-control form-control-sm" required
								value="<?php echo isset($contact_number_1) ? $contact_number_1 : '123-456-7890' ?>">
						</div>
						<div class="form-group">
							<label for="contact_number_2" class="control-label">Contact Number 2</label>
							<input type="text" name="contact_number_2" class="form-control form-control-sm"
								value="<?php echo isset($contact_number_2) ? $contact_number_2 : '987-654-3210' ?>">
						</div>
						<div class="form-group">
							<label for="email_id" class="control-label">Email ID</label>
							<input type="email" name="email_id" class="form-control form-control-sm" required
								value="<?php echo isset($email_id) ? $email_id : 'email@example.com' ?>">
						</div>
						<div class="form-group">
							<label for="license_status" class="control-label">License Status</label>
							<select name="license_status" class="form-control form-control-sm" required>
								<option value="owned" <?php echo (isset($license_status) && $license_status == 'owned') ? 'selected' : ''; ?>>Owned</option>
								<option value="rented" <?php echo (isset($license_status) && $license_status == 'rented') ? 'selected' : ''; ?>>Rented</option>
							</select>
						</div>
						<div class="form-group">
							<label for="lic_holder_name" class="control-label">License Holder Name</label>
							<input type="text" name="lic_holder_name" class="form-control form-control-sm"
								value="<?php echo isset($lic_holder_name) ? $lic_holder_name : 'License Holder' ?>">
						</div>
						<div class="form-group">
							<label for="relation" class="control-label">Relation</label>
							<input type="text" name="relation" class="form-control form-control-sm"
								value="<?php echo isset($relation) ? $relation : 'Relation' ?>">
						</div>
						<div class="form-group">
							<label for="validity" class="control-label">Validity</label>
							<input type="date" name="validity" class="form-control form-control-sm" required
								value="<?php echo isset($validity) ? $validity : '2023-09-13' ?>">
						</div>
						<!-- Add input fields for other columns here -->
						<div class="form-group">
							<label for="business_age" class="control-label">Business Age</label>
							<input type="text" name="business_age" class="form-control form-control-sm"
								value="<?php echo isset($business_age) ? $business_age : '5' ?>">
						</div>
						<div class="form-group">
							<label for="total_investment" class="control-label">Total Investment</label>
							<input type="text" name="total_investment" class="form-control form-control-sm"
								value="<?php echo isset($total_investment) ? $total_investment : '50000' ?>">
						</div>
						<div class="form-group">
							<label for="total_investment_inventory" class="control-label">Total Investment
								Inventory</label>
							<input type="text" name="total_investment_inventory" class="form-control form-control-sm"
								value="<?php echo isset($total_investment_inventory) ? $total_investment_inventory : '20000' ?>">
						</div>
						<div class="form-group">
							<label for="avg_sale_per_day" class="control-label">Average Sale per Day</label>
							<input type="text" name="avg_sale_per_day" class="form-control form-control-sm"
								value="<?php echo isset($avg_sale_per_day) ? $avg_sale_per_day : '1000' ?>">
						</div>
						<div class="form-group">
							<label for="avg_expenses_per_day" class="control-label">Average Expenses per Day</label>
							<input type="text" name="avg_expenses_per_day" class="form-control form-control-sm"
								value="<?php echo isset($avg_expenses_per_day) ? $avg_expenses_per_day : '500' ?>">
						</div>
						<div class="form-group">
							<label for="inventory_rotation" class="control-label">Inventory Rotation</label>
							<input type="text" name="inventory_rotation" class="form-control form-control-sm"
								value="<?php echo isset($inventory_rotation) ? $inventory_rotation : '10' ?>">
						</div>
						<div class="form-group">
							<label for="avg_shelf_life" class="control-label">Average Shelf Life</label>
							<input type="text" name="avg_shelf_life" class="form-control form-control-sm"
								value="<?php echo isset($avg_shelf_life) ? $avg_shelf_life : '30' ?>">
						</div>
						<div class="form-group">
							<label for="max_stock_wait_days" class="control-label">Max Stock Wait Days</label>
							<input type="text" name="max_stock_wait_days" class="form-control form-control-sm"
								value="<?php echo isset($max_stock_wait_days) ? $max_stock_wait_days : '7' ?>">
						</div>
						<div class="form-group">
							<label for="unsellable_stock_count" class="control-label">Unsellable Stock Count</label>
							<input type="text" name="unsellable_stock_count" class="form-control form-control-sm"
								value="<?php echo isset($unsellable_stock_count) ? $unsellable_stock_count : '20' ?>">
						</div>
						<div class="form-group">
							<label for="unsellable_stock_cost" class="control-label">Unsellable Stock Cost</label>
							<input type="text" name="unsellable_stock_cost" class="form-control form-control-sm"
								value="<?php echo isset($unsellable_stock_cost) ? $unsellable_stock_cost : '100' ?>">
						</div>
						<div class="form-group">
							<label for="computer_at_shop" class="control-label">Computer at Shop</label>
							<input type="text" name="computer_at_shop" class="form-control form-control-sm"
								value="<?php echo isset($computer_at_shop) ? $computer_at_shop : 'Yes' ?>">
						</div>
						<div class="form-group">
							<label for="internet_available" class="control-label">Internet Available</label>
							<input type="text" name="internet_available" class="form-control form-control-sm"
								value="<?php echo isset($internet_available) ? $internet_available : 'Yes' ?>">
						</div>
						<div class="form-group">
							<label for="inventory_management_software" class="control-label">Inventory Management
								Software</label>
							<input type="text" name="inventory_management_software" class="form-control form-control-sm"
								value="<?php echo isset($inventory_management_software) ? $inventory_management_software : 'Software' ?>">
						</div>
						<div class="form-group">
							<label for="shop_area" class="control-label">Shop Area</label>
							<input type="text" name="shop_area" class="form-control form-control-sm"
								value="<?php echo isset($shop_area) ? $shop_area : '2000' ?>">
						</div>
						<div class="form-group">
							<label for="sale_dependency" class="control-label">Sale Dependency</label>
							<input type="text" name="sale_dependency" class="form-control form-control-sm"
								value="<?php echo isset($sale_dependency) ? $sale_dependency : 'High' ?>">
						</div>
						<div class="form-group">
							<label for="hospitals_5km" class="control-label">Hospitals Within 5km</label>
							<input type="text" name="hospitals_5km" class="form-control form-control-sm"
								value="<?php echo isset($hospitals_5km) ? $hospitals_5km : '5' ?>">
						</div>
						<div class="form-group">
							<label for="hospitals_list" class="control-label">List of Hospitals</label>
							<input type="text" name="hospitals_list" class="form-control form-control-sm"
								value="<?php echo isset($hospitals_list) ? $hospitals_list : 'Hospital 1, Hospital 2' ?>">
						</div>
						<div class="form-group">
							<label for="distributors_per_month" class="control-label">Distributors Per Month</label>
							<input type="text" name="distributors_per_month" class="form-control form-control-sm"
								value="<?php echo isset($distributors_per_month) ? $distributors_per_month : '10' ?>">
						</div>
						<div class="form-group">
							<label for="discount_range" class="control-label">Discount Range</label>
							<input type="text" name="discount_range" class="form-control form-control-sm"
								value="<?php echo isset($discount_range) ? $discount_range : '5-10%' ?>">
						</div>
						<div class="form-group">
							<label for="conditions_for_discount" class="control-label">Conditions for Discount</label>
							<input type="text" name="conditions_for_discount" class="form-control form-control-sm"
								value="<?php echo isset($conditions_for_discount) ? $conditions_for_discount : 'None' ?>">
						</div>

					</div>
					<div class="col-md-6">

						<div class="form-group">
							<label for="chemist_photo" class="control-label">Chemist Photo</label>
							<div class="custom-file">
								<?php if ($mode !== 'view') { // Check if not in view mode ?>
									<input type="file" class="custom-file-input" id="chemist_photo" name="chemist_photo"
										accept="image/*" onchange="displayImage(this, 'chemist_image_preview')">
								<?php } ?>
								<label class="custom-file-label" for="chemist_photo">
									<i class="fas fa-image" style="font-size: 1.5rem;"></i> Upload Image
								</label>
							</div>
							<img id="chemist_image_preview" src="<?php echo $chemistImage; ?>"
								alt="Uploaded Chemist Photo"
								style="max-width: 180px; max-height: 180px; margin-top:10px; <?php echo ($mode === 'view' || $mode == 'edit') ? '' : 'display: none;'; ?>">
						</div>

						<div class="form-group">
							<label for="shop_photo" class="control-label">Shop Photo</label>
							<div class="custom-file">
								<?php if ($mode !== 'view') { // Check if not in view mode ?>
									<input type="file" class="custom-file-input" id="shop_photo" name="shop_photo"
										accept="image/*" onchange="displayImage(this, 'shop_image_preview')">
								<?php } ?>
								<label class="custom-file-label" for="shop_photo">
									<i class="fas fa-image" style="font-size: 1.5rem;"></i> Upload Image
								</label>
							</div>
							<img id="shop_image_preview" src="<?php echo $shopImage; ?>" alt="Uploaded Shop Photo"
								style="max-width: 180px; max-height: 180px; margin-top:10px; <?php echo ($mode === 'view' || $mode == 'edit') ? '' : 'display: none;'; ?>">
						</div>

						<div class="form-group">
							<label for="shop_open_time" class="control-label">Shop Open Time</label>
							<input type="time" name="shop_open_time" class="form-control form-control-sm" required
								value="<?php echo isset($shop_open_time) ? $shop_open_time : '08:00' ?>">
						</div>
						<div class="form-group">
							<label for="shop_close_time" class="control-label">Shop Close Time</label>
							<input type="time" name="shop_close_time" class="form-control form-control-sm" required
								value="<?php echo isset($shop_close_time) ? $shop_close_time : '20:00' ?>">
						</div>
						<!-- Add input fields for other columns here -->
					</div>
					<hr>
					<div class="col-lg-12 text-right justify-content-center d-flex">
						<!-- <button class="btn btn-primary mr-2">Save</button> -->
						<?php if ($mode !== 'view') { ?>
							<!-- Only display the button for editing and adding new data -->
							<button class="btn btn-primary mr-2" type="submit">
								<?php echo $button_text ?>
							</button>
						<?php } ?>
						<button class="btn btn-secondary" type="button"
							onclick="location.href = 'index.php?page=survey_list'">Cancel</button>
					</div>

				</div>
			</form>

		</div>
	</div>
</div>
<script>

	function findLocation() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(showPosition);
		} else {
			alert("Geolocation is not supported by this browser.");
		}
	}

	function showPosition(position) {
		document.getElementById('gps_coordinates').value = position.coords.latitude + ", " + position.coords.longitude;
	}
	$('#manage_survey').submit(function (e) {
		e.preventDefault();
		$('input').removeClass("border-danger");
		start_load();
		$('#msg').html('');

		var action = 'save_survey'; // Default action for adding new data

		<?php
		// Check if the 'mode' parameter is set to 'edit' in the URL
		if (isset($mode) && $mode === 'edit') {
			// If in edit mode, change the action to 'survey_edit'
			echo "action = 'survey_edit';";
		}
		?>

		$.ajax({
			url: 'ajax.php?action=' + action,
			data: new FormData($(this)[0]),
			cache: false,
			contentType: false,
			processData: false,
			method: 'POST',
			type: 'POST',
			success: function (resp) {
				console.log(resp);
				resp = JSON.parse(resp); // Parse the JSON response
				console.log(resp);
				if (resp.status === "success") {
					end_load();
					alert_toast(resp.message, "success");

					setTimeout(function () {
						location.href = 'index.php?page=survey_list';
					}, 1500)


				} else {
					console.error("Error: " + resp.message); // Log the error message to the console
					alert_toast('Error saving data. ' + resp.message, "error");
					end_load();
				}
			},
			error: function (xhr, status, error) {
				console.error("XHR status: " + status + ", Error: " + error); // Log the error details to the console
				alert_toast('Error2: ' + error, "error");
				end_load();
			}
		});
	});

	$('#chemist_photo').change(function (event) {
		displayImage(event, 'chemist_image_preview');
		if ('<?php echo $mode; ?>' === 'view') {
			// Disable the file input in view mode
			$('#chemist_photo').prop('disabled', true);
		}
	});

	// Display uploaded image for shop photo
	$('#shop_photo').change(function (event) {
		displayImage(event, 'shop_image_preview');
		if ('<?php echo $mode; ?>' === 'view') {
			// Disable the file input in view mode
			$('#shop_photo').prop('disabled', true);
		}
	});

	function displayImage(input, previewId) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				var preview = document.getElementById(previewId);
				preview.src = e.target.result;
				preview.style.display = 'block';
			}

			reader.readAsDataURL(input.files[0]);
		}
	}


</script>
<style>
	.custom-btn {
		background-color: #008cba;
		border: none;
		color: white;
		padding: 5px 10px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 14px;

		margin: 5px 0;
		border-radius: 5px;
		/* Rounded corners */
		box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);

	}

	.custom-btn:hover {
		background-color: #006899;
		color: white !important;
	}
</style>
<?php
if (!isset($conn)) {
	include 'db_connect.php';
}
?>
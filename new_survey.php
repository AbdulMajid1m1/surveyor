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

		$button_text = 'Update (अपडेट करें)'; // Button text for updating data 
		$form_action = 'update_survey'; // Change the form action to the update process
		$disabled = ''; // Enable input fields for editing
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

		// Disable input fields for viewing
		$input_disabled = 'disabled';
		$button_text = 'View'; // Button text for viewing data
		$disabled = 'disabled'; // Disable input fields for viewing
	}
} else {
	$id = '';
	$mode = '';
	$first_name = '';
	$middle_name = '';
	$last_name = '';
	$education = '';
	$firm_name = '';
	$address = '';
	$gps_coordinates = '';
	$contact_number_1 = '';
	$contact_number_2 = '';
	$email_id = '';
	$license_status = 'owned'; // Default to 'owned'
	$lic_holder_name = '';
	$relation = '';
	$validity = ''; // Default date value
	$business_age = '';
	$total_investment = '';
	$total_investment_inventory = '';
	$avg_sale_per_day = '';
	$avg_expenses_per_day = '';
	$inventory_rotation = '';
	$avg_shelf_life = '';
	$max_stock_wait_days = '';
	$unsellable_stock_count = '';
	$unsellable_stock_cost = '';
	$computer_at_shop = ''; // Default to 'Yes'
	$internet_available = ''; // Default to 'Yes'
	$inventory_management_software = '';
	$shop_area = '';
	$sale_dependency = ''; // Default to 'High'
	$hospitals_5km = '';
	$hospitals_list = '';
	$distributors_per_month = '';
	$discount_range = '';
	$conditions_for_discount = '';
	$shop_open_time = '';
	$shop_close_time = '';
	$chemistImage = '';
	$shopImage = '';
	$button_text = 'Save (सहेजें)'; // Button text for saving data
	$disabled = ''; // Enable input fields for editing

}
?>

<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<form id="manage_survey" enctype="multipart/form-data">
				<input type="hidden" name="survey_id" id="survey_id" value="<?php echo $id; ?>" <?php echo $disabled; ?>>
				<input type="hidden" name="survey_no" id="survey_no" value="<?php echo $survey_no; ?>" <?php echo $disabled; ?>>
				<div class="row">
					<div class="col-md-6 border-right">
						<div class="form-group">
							<label for="first_name" class="control-label">First Name (पहला नाम)</label>
							<input type="text" name="first_name" class="form-control form-control-sm" required
								value="<?php echo isset($first_name) ? $first_name : 'Abdul' ?>" <?php echo $disabled; ?>>
						</div>
						<div class="form-group">
							<label for="middle_name" class="control-label">Middle Name (मध्य नाम)</label>
							<input type="text" name="middle_name" class="form-control form-control-sm"
								value="<?php echo isset($middle_name) ? $middle_name : 'Middle' ?>" <?php echo $disabled; ?>>
						</div>
						<div class="form-group">
							<label for="last_name" class="control-label">Last Name (आखिरी नाम)</label>
							<input type="text" name="last_name" class="form-control form-control-sm" required
								value="<?php echo isset($last_name) ? $last_name : '' ?>" <?php echo $disabled; ?>>
						</div>
						<div class="form-group">
							<label for="education" class="control-label">Education (शिक्षा)</label>
							<input type="text" name="education" class="form-control form-control-sm" required
								value="<?php echo isset($education) ? $education : '' ?>" <?php echo $disabled; ?>>
						</div>
						<div class="form-group">
							<label for="firm_name" class="control-label">Firm Name (फर्म का नाम)</label>
							<input type="text" name="firm_name" class="form-control form-control-sm" required
								value="<?php echo isset($firm_name) ? $firm_name : '' ?>" <?php echo $disabled; ?>>
						</div>
						<div class="form-group">
							<label for="address" class="control-label">Address (पता)</label>
							<textarea name="address" id="address" cols="30" rows="4" class="form-control" required <?php echo $disabled; ?>><?php echo isset($address) ? $address : '' ?></textarea>
						</div>
						<div class="form-group">
							<label for="gps_coordinates" class="control-label">GPS Coordinates (जीपीएस
								निर्देशांक)</label>
							<input type="text" name="gps_coordinates" id="gps_coordinates"
								class="form-control form-control-sm" required placeholder="Latitude, Longitude"
								value="<?php echo isset($gps_coordinates) ? $gps_coordinates : '' ?>" <?php echo $disabled; ?>>
							<button type="button" class="btn custom-btn" onclick="findLocation()">Find Your
								Location (अपना स्थान ढूंढें)</button>
						</div>
						<div class="form-group">
							<label for="contact_number_1" class="control-label">Contact Number 1 (संपर्क नंबर 1)</label>
							<input type="text" name="contact_number_1" class="form-control form-control-sm" required
								value="<?php echo isset($contact_number_1) ? $contact_number_1 : '123-456-7890' ?>"
								<?php echo $disabled; ?>>
						</div>
						<div class="form-group">
							<label for="contact_number_2" class="control-label">Contact Number 2 (संपर्क नंबर 2)</label>
							<input type="text" name="contact_number_2" class="form-control form-control-sm"
								value="<?php echo isset($contact_number_2) ? $contact_number_2 : '987-654-3210' ?>"
								<?php echo $disabled; ?>>
						</div>
						<div class="form-group">
							<label for="email_id" class="control-label">Email ID (ईमेल आईडी)</label>
							<input type="email" name="email_id" class="form-control form-control-sm" required
								value="<?php echo isset($email_id) ? $email_id : 'email@example.com' ?>" <?php echo $disabled; ?>>
						</div>
						<div class="form-group">
							<label for="license_status" class="control-label">License Status (लाइसेंस की स्थिति)</label>
							<select name="license_status" class="form-control form-control-sm" id="license_status"
								required <?php echo $disabled; ?>>
								<option value="owned" <?php echo (isset($license_status) && $license_status == 'owned') ? 'selected' : ''; ?>>Owned</option>
								<option value="rented" <?php echo (isset($license_status) && $license_status == 'rented') ? 'selected' : ''; ?>>Rented</option>
							</select>
						</div>
						<div class="form-group" id="lic_holder_name_group"
							style="<?php echo (isset($license_status) && $license_status == 'rented') ? 'display: block;' : 'display: none;'; ?>">
							<label for="lic_holder_name" class="control-label">License Holder Name (लाइसेंस धारक का
								नाम)</label>
							<input type="text" name="lic_holder_name" id="lic_holder_name"
								class="form-control form-control-sm"
								value="<?php echo isset($lic_holder_name) ? $lic_holder_name : '' ?>" <?php echo ($license_status == 'rented') ? 'required' : ''; ?> <?php echo $disabled; ?>>
						</div>


						<div class="form-group">
							<label for="relation" class="control-label">Relation (संबंध)</label>
							<input type="text" name="relation" class="form-control form-control-sm"
								value="<?php echo isset($relation) ? $relation : 'Relation' ?>" <?php echo $disabled; ?>>
						</div>
						<div class="form-group">
							<label for="validity" class="control-label">Validity (मान्यता)</label>
							<input type="date" name="validity" class="form-control form-control-sm" required <?php echo $disabled; ?> value="<?php echo isset($validity) ? $validity : '2023-09-13' ?>">
						</div>
						<!-- Add input fields for other columns here -->
						<div class="form-group">
							<label for="business_age" class="control-label">Business Age (व्यापार की आयु)</label>
							<input type="text" name="business_age" class="form-control form-control-sm" <?php echo $disabled; ?> value="<?php echo isset($business_age) ? $business_age : '' ?>">
						</div>
						<div class="form-group">
							<label for="total_investment" class="control-label">Total Investment (कुल निवेश)</label>
							<input type="text" name="total_investment" class="form-control form-control-sm" <?php echo $disabled; ?> value="<?php echo isset($total_investment) ? $total_investment : '' ?>">
						</div>
						<div class="form-group">
							<label for="total_investment_inventory" class="control-label">Total Investment
								Inventory (कुल निवेश सूची)</label>
							<input type="text" name="total_investment_inventory" class="form-control form-control-sm"
								value="<?php echo isset($total_investment_inventory) ? $total_investment_inventory : '' ?>"
								<?php echo $disabled; ?>>
						</div>
						<div class="form-group">
							<label for="avg_sale_per_day" class="control-label">Average Sale per Day (दिन भर में औसत
								बिक्री)</label>
							<input type="text" name="avg_sale_per_day" class="form-control form-control-sm"
								value="<?php echo isset($avg_sale_per_day) ? $avg_sale_per_day : '' ?>" <?php echo $disabled; ?>>
						</div>
						<div class="form-group">
							<label for="avg_expenses_per_day" class="control-label">Average Expenses per Day (दिन भर की
								औसत व्यय)</label>
							<input type="text" name="avg_expenses_per_day" class="form-control form-control-sm"
								value="<?php echo isset($avg_expenses_per_day) ? $avg_expenses_per_day : '' ?>" <?php echo $disabled; ?>>
						</div>
						<div class="form-group">
							<label for="inventory_rotation" class="control-label">Inventory Rotation (सूची
								परिसंचारण)</label>
							<input type="text" name="inventory_rotation" class="form-control form-control-sm"
								value="<?php echo isset($inventory_rotation) ? $inventory_rotation : '' ?>" <?php echo $disabled; ?>>
						</div>
						<div class="form-group">
							<label for="avg_shelf_life" class="control-label">Average Shelf Life (औसत शेल्फ
								जीवन)</label>
							<input type="text" name="avg_shelf_life" class="form-control form-control-sm"
								value="<?php echo isset($avg_shelf_life) ? $avg_shelf_life : '' ?>" <?php echo $disabled; ?>>
						</div>
						<div class="form-group">
							<label for="max_stock_wait_days" class="control-label">Max Stock Wait Days (अधिकतम स्टॉक
								प्रतीक्षा दिन)</label>
							<input type="text" name="max_stock_wait_days" class="form-control form-control-sm"
								value="<?php echo isset($max_stock_wait_days) ? $max_stock_wait_days : '' ?>" <?php echo $disabled; ?>>
						</div>
						<div class="form-group">
							<label for="unsellable_stock_count" class="control-label">Unsellable Stock Count (बेचने
								योग्य स्टॉक की गणना)</label>
							<input type="text" name="unsellable_stock_count" class="form-control form-control-sm"
								value="<?php echo isset($unsellable_stock_count) ? $unsellable_stock_count : '' ?>"
								<?php echo $disabled; ?>>
						</div>
						<div class="form-group">
							<label for="unsellable_stock_cost" class="control-label">Unsellable Stock Cost (बेचने योग्य
								स्टॉक की लागत)</label>
							<input type="text" name="unsellable_stock_cost" class="form-control form-control-sm"
								value="<?php echo isset($unsellable_stock_cost) ? $unsellable_stock_cost : '' ?>" <?php echo $disabled; ?>>
						</div>
						<div class="form-group">
							<label for="computer_at_shop" class="control-label">Computer at Shop (दुकान पर
								कंप्यूटर)</label>
							<input type="text" name="computer_at_shop" class="form-control form-control-sm"
								value="<?php echo isset($computer_at_shop) ? $computer_at_shop : '' ?>" <?php echo $disabled; ?>>
						</div>
						<div class="form-group">
							<label for="internet_available" class="control-label">Internet Available (इंटरनेट
								उपलब्ध)</label>
							<input type="text" name="internet_available" class="form-control form-control-sm"
								value="<?php echo isset($internet_available) ? $internet_available : '' ?>" <?php echo $disabled; ?>>
						</div>
						<div class="form-group">
							<label for="inventory_management_software" class="control-label">Inventory Management
								Software (सूची प्रबंधन सॉफ़्टवेयर)</label>
							<input type="text" name="inventory_management_software" class="form-control form-control-sm"
								value="<?php echo isset($inventory_management_software) ? $inventory_management_software : '' ?>"
								<?php echo $disabled; ?>>
						</div>
						<div class="form-group">
							<label for="shop_area" class="control-label">Shop Area (दुकान का क्षेत्र)</label>
							<input type="text" name="shop_area" class="form-control form-control-sm"
								value="<?php echo isset($shop_area) ? $shop_area : '' ?>" <?php echo $disabled; ?>>
						</div>
						<div class="form-group">
							<label for="sale_dependency" class="control-label">Sale Dependency (बिक्री की
								आश्रितता)</label>
							<input type="text" name="sale_dependency" class="form-control form-control-sm"
								value="<?php echo isset($sale_dependency) ? $sale_dependency : '' ?>" <?php echo $disabled; ?>>
						</div>
						<div class="form-group">
							<label for="hospitals_5km" class="control-label">Hospitals Within 5km (5km के भीतर
								अस्पताल)</label>
							<input type="text" name="hospitals_5km" class="form-control form-control-sm"
								value="<?php echo isset($hospitals_5km) ? $hospitals_5km : '' ?>" <?php echo $disabled; ?>>
						</div>
						<div class="form-group">
							<label for="hospitals_list" class="control-label">List of Hospitals (अस्पतालों की
								सूची)</label>
							<input type="text" name="hospitals_list" class="form-control form-control-sm"
								value="<?php echo isset($hospitals_list) ? $hospitals_list : '' ?>" <?php echo $disabled; ?>>
						</div>
						<div class="form-group">
							<label for="distributors_per_month" class="control-label">Distributors Per Month (प्रति माह
								वितरक)</label>
							<input type="text" name="distributors_per_month" class="form-control form-control-sm"
								value="<?php echo isset($distributors_per_month) ? $distributors_per_month : '' ?>"
								<?php echo $disabled; ?>>
						</div>
						<div class="form-group">
							<label for="discount_range" class="control-label">Discount Range (छूट की सीमा)</label>
							<input type="text" name="discount_range" class="form-control form-control-sm"
								value="<?php echo isset($discount_range) ? $discount_range : '' ?>" <?php echo $disabled; ?>>
						</div>
						<div class="form-group">
							<label for="conditions_for_discount" class="control-label">Conditions for Discount (छूट की
								शर्तें)</label>
							<input type="text" name="conditions_for_discount" class="form-control form-control-sm"
								value="<?php echo isset($conditions_for_discount) ? $conditions_for_discount : '' ?>"
								<?php echo $disabled; ?>>
						</div>

					</div>
					<div class="col-md-6">

						<div class="form-group">
							<label for="chemist_photo" class="control-label">Chemist Photo (रसायनशाला का फ़ोटो)</label>
							<div class="custom-file">
								<?php if ($mode !== 'view') { // Check if not in view mode ?>
									<input type="file" class="custom-file-input" id="chemist_photo" name="chemist_photo"
										accept="image/*" onchange="displayImage(this, 'chemist_image_preview')">
								<?php } ?>
								<?php if ($mode !== 'view') { // Check if not in view mode ?>
									<label class="custom-file-label" for="chemist_photo">
										<i class="fas fa-image" style="font-size: 1.5rem;"></i> Upload Chemist Photo
									</label>
								<?php } ?>
							</div>
							<img id="chemist_image_preview" src="<?php echo $chemistImage; ?>"
								alt="Uploaded Chemist Photo"
								style="max-width: 180px; max-height: 180px; margin-top:10px; <?php echo ($mode === 'view' || $mode == 'edit') ? '' : 'display: none;'; ?>">
						</div>

						<div class="form-group">
							<label for="shop_photo" class="control-label">Shop Photo (दुकान का फ़ोटो)</label>
							<div class="custom-file">
								<?php if ($mode !== 'view') { // Check if not in view mode ?>
									<input type="file" class="custom-file-input" id="shop_photo" name="shop_photo"
										accept="image/*" onchange="displayImage(this, 'shop_image_preview')">
								<?php } ?>
								<?php if ($mode !== 'view') { // Check if not in view mode ?>
									<label class="custom-file-label" for="shop_photo">
										<i class="fas fa-image" style="font-size: 1.5rem;"></i> Upload Shop Photo
									</label>
								<?php } ?>
							</div>
							<img id="shop_image_preview" src="<?php echo $shopImage; ?>" alt="Uploaded Shop Photo"
								style="max-width: 180px; max-height: 180px; margin-top:10px; <?php echo ($mode === 'view' || $mode == 'edit') ? '' : 'display: none;'; ?>">
						</div>

						<div class="form-group">
							<label for="shop_open_time" class="control-label">Shop Open Time (दुकान खुलने का
								समय)</label>
							<input type="time" name="shop_open_time" class="form-control form-control-sm" required
								value="<?php echo isset($shop_open_time) ? $shop_open_time : '' ?>" <?php echo $disabled; ?>>
						</div>
						<div class="form-group">
							<label for="shop_close_time" class="control-label">Shop Close Time (दुकान बंद होने का
								समय)</label>
							<input type="time" name="shop_close_time" class="form-control form-control-sm" required
								value="<?php echo isset($shop_close_time) ? $shop_close_time : '' ?>" <?php echo $disabled; ?>>
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
							onclick="location.href = 'index.php?page=survey_list'">Back</button>
					</div>

				</div>
			</form>

		</div>
	</div>
</div>
<script>
	document.getElementById("license_status").addEventListener("change", function () {
		var selectedValue = this.value;
		var licHolderNameGroup = document.getElementById("lic_holder_name_group");

		// Show or hide the license holder name field based on the selected value
		if (selectedValue === "rented") {
			licHolderNameGroup.style.display = "block";
		} else {
			licHolderNameGroup.style.display = "none";
		}
	});

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
		if ('<?php echo $mode; ?>' !== 'edit' && '<?php echo $mode; ?>' !== 'view') {
			if ($('#chemist_photo').val() == '' || $('#shop_photo').val() == '') {
				alert_toast("Both Chemist Photo and Shop Photo are required.", "error");
				return false;
			}
		}
		if ($('#license_status').val() == 'rented') {
			if ($('#lic_holder_name').val() == '') {

				alert_toast("License Holder Name is required.", "error");
				return false;
			}
		}

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
	.card {
		background-color: #f8cbad;
		box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;


	}

	.form-group {
		padding-right: 10% !important;
	}

	/* // media query for mobile */
	@media (max-width: 768px) {
		.form-group {
			padding-right: 0% !important;
		}
	}

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
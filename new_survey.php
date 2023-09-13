<?php
if (!isset($conn)) {
	include 'db_connect.php';
}
?>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<form action="" id="manage_survey" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
				<div class="row">
					<div class="col-md-6 border-right">
						<div class="form-group">
							<label for="first_name" class="control-label">First Name</label>
							<input type="text" name="first_name" class="form-control form-control-sm" required
								value="<?php echo isset($first_name) ? $first_name : '' ?>">
						</div>
						<div class="form-group">
							<label for="middle_name" class="control-label">Middle Name</label>
							<input type="text" name="middle_name" class="form-control form-control-sm"
								value="<?php echo isset($middle_name) ? $middle_name : '' ?>">
						</div>
						<div class="form-group">
							<label for="last_name" class="control-label">Last Name</label>
							<input type="text" name="last_name" class="form-control form-control-sm" required
								value="<?php echo isset($last_name) ? $last_name : '' ?>">
						</div>
						<div class="form-group">
							<label for="education" class="control-label">Education</label>
							<input type="text" name="education" class="form-control form-control-sm" required
								value="<?php echo isset($education) ? $education : '' ?>">
						</div>
						<div class="form-group">
							<label for="firm_name" class="control-label">Firm Name</label>
							<input type="text" name="firm_name" class="form-control form-control-sm" required
								value="<?php echo isset($firm_name) ? $firm_name : '' ?>">
						</div>
						<div class="form-group">
							<label for="address" class="control-label">Address</label>
							<textarea name="address" id="address" cols="30" rows="4" class="form-control"
								required><?php echo isset($address) ? $address : '' ?></textarea>
						</div>
						<div class="form-group">
							<label for="gps_coordinates" class="control-label">GPS Coordinates</label>
							<input type="text" name="gps_coordinates" class="form-control form-control-sm" required
								value="<?php echo isset($gps_coordinates) ? $gps_coordinates : '' ?>">
						</div>
						<div class="form-group">
							<label for="contact_number_1" class="control-label">Contact Number 1</label>
							<input type="text" name="contact_number_1" class="form-control form-control-sm" required
								value="<?php echo isset($contact_number_1) ? $contact_number_1 : '' ?>">
						</div>
						<div class="form-group">
							<label for="contact_number_2" class="control-label">Contact Number 2</label>
							<input type="text" name="contact_number_2" class="form-control form-control-sm"
								value="<?php echo isset($contact_number_2) ? $contact_number_2 : '' ?>">
						</div>
						<div class="form-group">
							<label for="email_id" class="control-label">Email ID</label>
							<input type="email" name="email_id" class="form-control form-control-sm" required
								value="<?php echo isset($email_id) ? $email_id : '' ?>">
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
								value="<?php echo isset($lic_holder_name) ? $lic_holder_name : '' ?>">
						</div>
						<div class="form-group">
							<label for="relation" class="control-label">Relation</label>
							<input type="text" name="relation" class="form-control form-control-sm"
								value="<?php echo isset($relation) ? $relation : '' ?>">
						</div>
						<div class="form-group">
							<label for="validity" class="control-label">Validity</label>
							<input type="date" name="validity" class="form-control form-control-sm" required
								value="<?php echo isset($validity) ? $validity : '' ?>">
						</div>
						<!-- Add input fields for other columns here -->
						<div class="form-group">
							<label for="business_age" class="control-label">Business Age</label>
							<input type="text" name="business_age" class="form-control form-control-sm"
								value="<?php echo isset($business_age) ? $business_age : '' ?>">
						</div>
						<div class="form-group">
							<label for="total_investment" class="control-label">Total Investment</label>
							<input type="text" name="total_investment" class="form-control form-control-sm"
								value="<?php echo isset($total_investment) ? $total_investment : '' ?>">
						</div>
						<div class="form-group">
							<label for="total_investment_inventory" class="control-label">Total Investment
								Inventory</label>
							<input type="text" name="total_investment_inventory" class="form-control form-control-sm"
								value="<?php echo isset($total_investment_inventory) ? $total_investment_inventory : '' ?>">
						</div>
						<div class="form-group">
							<label for="avg_sale_per_day" class="control-label">Average Sale per Day</label>
							<input type="text" name="avg_sale_per_day" class="form-control form-control-sm"
								value="<?php echo isset($avg_sale_per_day) ? $avg_sale_per_day : '' ?>">
						</div>
						<div class="form-group">
							<label for="avg_expenses_per_day" class="control-label">Average Expenses per Day</label>
							<input type="text" name="avg_expenses_per_day" class="form-control form-control-sm"
								value="<?php echo isset($avg_expenses_per_day) ? $avg_expenses_per_day : '' ?>">
						</div>
						<div class="form-group">
							<label for="inventory_rotation" class="control-label">Inventory Rotation</label>
							<input type="text" name="inventory_rotation" class="form-control form-control-sm"
								value="<?php echo isset($inventory_rotation) ? $inventory_rotation : '' ?>">
						</div>
						<div class="form-group">
							<label for="avg_shelf_life" class="control-label">Average Shelf Life</label>
							<input type="text" name="avg_shelf_life" class="form-control form-control-sm"
								value="<?php echo isset($avg_shelf_life) ? $avg_shelf_life : '' ?>">
						</div>
						<div class="form-group">
							<label for="max_stock_wait_days" class="control-label">Max Stock Wait Days</label>
							<input type="text" name="max_stock_wait_days" class="form-control form-control-sm"
								value="<?php echo isset($max_stock_wait_days) ? $max_stock_wait_days : '' ?>">
						</div>
						<div class="form-group">
							<label for="unsellable_stock_count" class="control-label">Unsellable Stock Count</label>
							<input type="text" name="unsellable_stock_count" class="form-control form-control-sm"
								value="<?php echo isset($unsellable_stock_count) ? $unsellable_stock_count : '' ?>">
						</div>
						<div class="form-group">
							<label for="unsellable_stock_cost" class="control-label">Unsellable Stock Cost</label>
							<input type="text" name="unsellable_stock_cost" class="form-control form-control-sm"
								value="<?php echo isset($unsellable_stock_cost) ? $unsellable_stock_cost : '' ?>">
						</div>
						<div class="form-group">
							<label for="computer_at_shop" class="control-label">Computer at Shop</label>
							<input type="text" name="computer_at_shop" class="form-control form-control-sm"
								value="<?php echo isset($computer_at_shop) ? $computer_at_shop : '' ?>">
						</div>
						<div class="form-group">
							<label for="internet_available" class="control-label">Internet Available</label>
							<input type="text" name="internet_available" class="form-control form-control-sm"
								value="<?php echo isset($internet_available) ? $internet_available : '' ?>">
						</div>
						<div class="form-group">
							<label for="inventory_management_software" class="control-label">Inventory Management
								Software</label>
							<input type="text" name="inventory_management_software" class="form-control form-control-sm"
								value="<?php echo isset($inventory_management_software) ? $inventory_management_software : '' ?>">
						</div>
						<div class="form-group">
							<label for="shop_area" class="control-label">Shop Area</label>
							<input type="text" name="shop_area" class="form-control form-control-sm"
								value="<?php echo isset($shop_area) ? $shop_area : '' ?>">
						</div>
						<div class="form-group">
							<label for="sale_dependency" class="control-label">Sale Dependency</label>
							<input type="text" name="sale_dependency" class="form-control form-control-sm"
								value="<?php echo isset($sale_dependency) ? $sale_dependency : '' ?>">
						</div>
						<div class="form-group">
							<label for="hospitals_5km" class="control-label">Hospitals Within 5km</label>
							<input type="text" name="hospitals_5km" class="form-control form-control-sm"
								value="<?php echo isset($hospitals_5km) ? $hospitals_5km : '' ?>">
						</div>
						<div class="form-group">
							<label for="hospitals_list" class="control-label">List of Hospitals</label>
							<input type="text" name="hospitals_list" class="form-control form-control-sm"
								value="<?php echo isset($hospitals_list) ? $hospitals_list : '' ?>">
						</div>
						<div class="form-group">
							<label for="distributors_per_month" class="control-label">Distributors Per Month</label>
							<input type="text" name="distributors_per_month" class="form-control form-control-sm"
								value="<?php echo isset($distributors_per_month) ? $distributors_per_month : '' ?>">
						</div>
						<div class="form-group">
							<label for="discount_range" class="control-label">Discount Range</label>
							<input type="text" name="discount_range" class="form-control form-control-sm"
								value="<?php echo isset($discount_range) ? $discount_range : '' ?>">
						</div>
						<div class="form-group">
							<label for="conditions_for_discount" class="control-label">Conditions for Discount</label>
							<input type="text" name="conditions_for_discount" class="form-control form-control-sm"
								value="<?php echo isset($conditions_for_discount) ? $conditions_for_discount : '' ?>">
						</div>
						<div class="form-group">
							<label for="created_at" class="control-label">Created At</label>
							<input type="text" name="created_at" class="form-control form-control-sm"
								value="<?php echo isset($created_at) ? $created_at : '' ?>">
						</div>
					</div>
					<div class="col-md-6">




						<div class="form-group">
							<label for="chemist_photo" class="control-label">Chemist Photo</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="chemist_photo" name="chemist_photo"
									accept="image/*" onchange="displayImage(this, 'chemist_image_preview')">
								<label class="custom-file-label" for="chemist_photo">
									<i class="fas fa-image" style="font-size: 1.5rem;"></i> Upload Image
								</label>
							</div>
							<img id="chemist_image_preview" src="" alt="Uploaded Chemist Photo"
								style="max-width: 100px; max-height: 100px; display: none;">
						</div>
						<div class="form-group">
							<label for="shop_photo" class="control-label">Shop Photo</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="shop_photo" name="shop_photo"
									accept="image/*" onchange="displayImage(this, 'shop_image_preview')">
								<label class="custom-file-label" for="shop_photo">
									<i class="fas fa-image" style="font-size: 1.5rem;"></i> Upload Image
								</label>
							</div>
							<img id="shop_image_preview" src="" alt="Uploaded Shop Photo"
								style="max-width: 100px; max-height: 100px; display: none;">
						</div>
						<div class="form-group">
							<label for="shop_open_time" class="control-label">Shop Open Time</label>
							<input type="time" name="shop_open_time" class="form-control form-control-sm" required
								value="<?php echo isset($shop_open_time) ? $shop_open_time : '' ?>">
						</div>
						<div class="form-group">
							<label for="shop_close_time" class="control-label">Shop Close Time</label>
							<input type="time" name="shop_close_time" class="form-control form-control-sm" required
								value="<?php echo isset($shop_close_time) ? $shop_close_time : '' ?>">
						</div>
						<!-- Add input fields for other columns here -->






					</div>
					<hr>
					<div class="col-lg-12 text-right justify-content-center d-flex">
						<button class="btn btn-primary mr-2">Save</button>
						<button class="btn btn-secondary" type="button"
							onclick="location.href = 'index.php?page=survey_list'">Cancel</button>
					</div>
			</form>
		</div>
	</div>
</div>
<script>
	$('#manage_survey').submit(function (e) {
		e.preventDefault()
		$('input').removeClass("border-danger")
		start_load()
		$('#msg').html('')
		$.ajax({
			url: 'ajax.php?action=save_survey',
			data: new FormData($(this)[0]),
			cache: false,
			contentType: false,
			processData: false,
			method: 'POST',
			type: 'POST',
			success: function (resp) {
				if (resp == 1) {
					alert_toast('Data successfully saved.', "success");
					setTimeout(function () {
						location.replace('index.php?page=survey_list')
					}, 1500)
				}
			}
		})
	})

	// Display uploaded image for chemist photo
	$('#chemist_photo').change(function (event) {
		displayImage(event, 'preview_chemist');
	});

	// Display uploaded image for shop photo
	$('#shop_photo').change(function (event) {
		displayImage(event, 'preview_shop');
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
<?php
if (!isset($conn)) {
	include 'db_connect.php';
}
?>
<?php
ob_start();
include('./db_connect.php');
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();
if ($action == 'login') {
	$login = $crud->login();
	if ($login)
		echo $login;
}

if ($action == 'logout') {
	$logout = $crud->logout();
	// if($logout)
	// 	echo $logout;
}
if ($action == 'profile_completion') {
	// $profile_completion = $crud->profileCompletion();


		// Capture all form data
		$surveyor_id = $_POST['surveyor_id'];
		$first_name = $_POST['first_name'];
		$middle_name = $_POST['middle_name'];
		$last_name = $_POST['last_name'];
		$pan_card_number = $_POST['pan_card_number'];
		$aadhar_card_number = $_POST['aadhar_card_number'];
		$mobile_number = $_POST['mobile_number'];
		$driving_license_number = $_POST['driving_license_number'];
		$status = $_POST['status'];
		$email_id = $_POST['email_id'];
		$village = $_POST['village'];
		$tehsil = $_POST['tehsil'];
		$city = $_POST['city'];
		$district = $_POST['district'];
		$state = $_POST['state'];
		$country = $_POST['country'];
		$count_of_surveys = $_POST['count_of_surveys'];
		$password = $_POST['password'];
		$pin_code = $_POST['pin_code'];

		// Handle the file upload
		if (isset($_FILES['photo'])) {
			$errors = array();
			$file_name = $surveyor_id . '_' . $_FILES['photo']['name'];
			$file_size = $_FILES['photo']['size'];
			$file_tmp = $_FILES['photo']['tmp_name'];
			$file_type = $_FILES['photo']['type'];
			$file_ext = strtolower(end(explode('.', $_FILES['photo']['name'])));

			$expensions = array("jpeg", "jpg", "png");

			if (in_array($file_ext, $expensions) === false) {
				$errors[] = "extension not allowed, please choose a JPEG or PNG file.";
			}

			if ($file_size > 2097152) {
				$errors[] = 'File size must be less than 2 MB';
			}

			if (empty($errors) == true) {
				move_uploaded_file($file_tmp, "./Images/Profile_images/" . $file_name);
				$photo_path = "./Images/Profile_images/" . $file_name;
			} else {
				print_r($errors);
			}
		}

		// Construct SQL query to insert data into the database
		$sql = "INSERT INTO users (
					Surveyor_ID, 
					First_Name, 
					Middle_Name, 
					Last_Name, 
					PAN_Card_Number, 
					Aadhar_Card_Number, 
					Mobile_Number, 
					Driving_License_Number, 
					Status, 
					Email_ID, 
					Village, 
					Tehsil, 
					City, 
					District, 
					State, 
					Country, 
					Count_of_Surveys, 
					Password, 
					PIN_Code, 
					Link_to_Photo
				) VALUES (
					'$surveyor_id', 
					'$first_name', 
					'$middle_name', 
					'$last_name', 
					'$pan_card_number', 
					'$aadhar_card_number', 
					'$mobile_number', 
					'$driving_license_number', 
					'$status', 
					'$email_id', 
					'$village', 
					'$tehsil', 
					'$city', 
					'$district', 
					'$state', 
					'$country', 
					'$count_of_surveys', 
					'$password', 
					'$pin_code', 
					'$photo_path'
				)";

		// Execute the query
		if (mysqli_query($conn, $sql)) {
			echo "1";
		} else {
			echo "An error occurred: " . mysqli_error($conn);
		}
	
}



if ($action == 'save_user') {
	$save = $crud->save_user();
	if ($save)
		echo $save;
}
if ($action == 'save_page_img') {
	$save = $crud->save_page_img();
	if ($save)
		echo $save;
}
if ($action == 'delete_user') {
	$save = $crud->delete_user();
	if ($save)
		echo $save;
}
if ($action == "save_survey") {
	$save = $crud->save_survey();
	if ($save)
		echo $save;
}
if ($action == "delete_survey") {
	$delete = $crud->delete_survey();
	if ($delete)
		echo $delete;
}
if ($action == "save_question") {
	$save = $crud->save_question();
	if ($save)
		echo $save;
}
if ($action == "delete_question") {
	$delsete = $crud->delete_question();
	if ($delsete)
		echo $delsete;
}

if ($action == "action_update_qsort") {
	$save = $crud->action_update_qsort();
	if ($save)
		echo $save;
}
if ($action == "save_answer") {
	$save = $crud->save_answer();
	if ($save)
		echo $save;
}
if ($action == "update_user") {
	$save = $crud->update_user();
	if ($save)
		echo $save;
}

ob_end_flush();
?>
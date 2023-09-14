<?php
session_start();
// ini_set('display_errors', 1);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Action
{
	private $db;

	public function __construct()
	{
		ob_start();
		include 'db_connect.php';

		$this->db = $conn;
	}
	function __destruct()
	{
		$this->db->close();
		ob_end_flush();
	}

	function login()
	{
		extract($_POST);
		$qry = $this->db->query("SELECT * FROM users where Mobile_Number = '" . $login_mobile_number . "' and password = '" . md5($login_password) . "' ");
		if ($qry->num_rows > 0) {
			foreach ($qry->fetch_array() as $key => $value) {
				if ($key != 'Password' && !is_numeric($key))
					$_SESSION['login_' . $key] = $value;
			}
			return 1;
		} else {
			return 3;
		}
	}
	function logout()
	{
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}


	function profileCompletion($conn, $filesArray, $postArray)
	{
		// $profile_completion = $crud->profileCompletion();
		$surveyor_id = $_SESSION['login_Surveyor_ID'];

		if (empty($surveyor_id)) {
			echo "Surveyor ID is not set in the session";
			exit;
		}

		$target_dir = "./Images/Profile_images/";
		$file_extension = pathinfo($filesArray["photo"]["name"], PATHINFO_EXTENSION);
		$target_file = $target_dir . $surveyor_id . '.' . $file_extension;

		if (move_uploaded_file($filesArray["photo"]["tmp_name"], $target_file)) {

			// Get all other form fields
			$aadhar_card_number = $postArray['aadhar_card_number'];
			$pan_card_number = $postArray['pan_card_number'];
			$driving_license_number = $postArray['driving_license_number'];
			$email_id = $postArray['email_id'];
			$village = $postArray['village'];
			$tehsil = $postArray['tehsil'];
			$city = $postArray['city'];
			$district = $postArray['district'];
			$state = $postArray['state'];
			$country = $postArray['country'];

			// Prepare and bind
			$stmt = $conn->prepare("UPDATE users SET Aadhar_Card_Number = ?, PAN_Card_Number = ?, Driving_License_Number = ?, Email_ID = ?, Village = ?, Tehsil = ?, City = ?, District = ?, State = ?, Country = ?, Link_to_Photo = ? WHERE Surveyor_ID = ?");
			$stmt->bind_param("ssssssssssss", $aadhar_card_number, $pan_card_number, $driving_license_number, $email_id, $village, $tehsil, $city, $district, $state, $country, $target_file, $surveyor_id);

			// Execute the statement
			if ($stmt->execute()) {
				// Update the session data with the newly saved values
				$_SESSION['login_Aadhar_Card_Number'] = $aadhar_card_number;
				$_SESSION['login_PAN_Card_Number'] = $pan_card_number;
				$_SESSION['login_Driving_License_Number'] = $driving_license_number;
				$_SESSION['login_Email_ID'] = $email_id;
				$_SESSION['login_Village'] = $village;
				$_SESSION['login_Tehsil'] = $tehsil;
				$_SESSION['login_City'] = $city;
				$_SESSION['login_District'] = $district;
				$_SESSION['login_State'] = $state;
				$_SESSION['login_Country'] = $country;
				$_SESSION['login_Link_to_Photo'] = $target_file;

				echo json_encode(["status" => "success", "message" => "Data updated successfully"]);
			} else {
				echo json_encode(["status" => "error", "message" => "Error updating data: " . $stmt->error]);
			}
		} else {
			echo json_encode(["status" => "error", "message" => "Error uploading File "]);
		}
	}


	function saveSurvey($conn, $filesArray, $postArray)
	{
		$target_dir = "./Images/Survay_images/";

		// Get the latest survey number from the rx_survey_data table
		$result = mysqli_query($conn, "SELECT COUNT(*) AS count FROM rx_survey_data");
		$row = mysqli_fetch_assoc($result);
		$count = $row['count'] + 1;
		$survey_no = "SUR" . str_pad($count, 4, '0', STR_PAD_LEFT);

		$file_extension1 = pathinfo($filesArray["chemist_photo"]["name"], PATHINFO_EXTENSION);
		$file_extension2 = pathinfo($filesArray["shop_photo"]["name"], PATHINFO_EXTENSION);
		$target_file_chemist = $target_dir . $survey_no . "_chemist_photo." . $file_extension1;
		$target_file_shop = $target_dir . $survey_no . "_shop_photo." . $file_extension2;

		if (
			move_uploaded_file($filesArray["chemist_photo"]["tmp_name"], $target_file_chemist) &&
			move_uploaded_file($filesArray["shop_photo"]["tmp_name"], $target_file_shop)
		) {

			// Get other form data
			$chemist_photo_path = $target_file_chemist;
			$shop_photo_path = $target_file_shop;
			$surveyor_id = $_SESSION['login_Surveyor_ID'];
			$first_name = $postArray['first_name'];
			$middle_name = $postArray['middle_name'];
			$last_name = $postArray['last_name'];
			$education = $postArray['education'];
			$firm_name = $postArray['firm_name'];
			$address = $postArray['address'];
			$gps_coordinates = $postArray['gps_coordinates'];
			$contact_number_1 = $postArray['contact_number_1'];
			$contact_number_2 = $postArray['contact_number_2'];
			$email_id = $postArray['email_id'];
			$license_status = $postArray['license_status'];
			$lic_holder_name = $postArray['lic_holder_name'];
			$relation = $postArray['relation'];
			$validity = $postArray['validity'];
			$shop_open_time = $postArray['shop_open_time'];
			$shop_close_time = $postArray['shop_close_time'];
			$business_age = $postArray['business_age'];
			$total_investment = $postArray['total_investment'];
			$total_investment_inventory = $postArray['total_investment_inventory'];
			$avg_sale_per_day = $postArray['avg_sale_per_day'];
			$avg_expenses_per_day = $postArray['avg_expenses_per_day'];
			$inventory_rotation = $postArray['inventory_rotation'];
			$avg_shelf_life = $postArray['avg_shelf_life'];
			$max_stock_wait_days = $postArray['max_stock_wait_days'];
			$unsellable_stock_count = $postArray['unsellable_stock_count'];
			$unsellable_stock_cost = $postArray['unsellable_stock_cost'];
			$computer_at_shop = $postArray['computer_at_shop'];
			$internet_available = $postArray['internet_available'];
			$inventory_management_software = $postArray['inventory_management_software'];
			$shop_area = $postArray['shop_area'];
			$sale_dependency = $postArray['sale_dependency'];
			$hospitals_5km = $postArray['hospitals_5km'];
			$hospitals_list = $postArray['hospitals_list'];
			$distributors_per_month = $postArray['distributors_per_month'];
			$discount_range = $postArray['discount_range'];
			$conditions_for_discount = $postArray['conditions_for_discount'];

			$stmt = $conn->prepare("INSERT INTO rx_survey_data (surveyor_id, survey_no, shop_photo,chemist_photo, first_name, middle_name, last_name, education, firm_name, address, gps_coordinates, contact_number_1, contact_number_2, email_id, license_status, lic_holder_name, relation, validity, shop_open_time, shop_close_time, business_age, total_investment, total_investment_inventory, avg_sale_per_day, avg_expenses_per_day, inventory_rotation, avg_shelf_life, max_stock_wait_days, unsellable_stock_count, unsellable_stock_cost, computer_at_shop, internet_available, inventory_management_software, shop_area, sale_dependency, hospitals_5km, hospitals_list, distributors_per_month, discount_range, conditions_for_discount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

			if ($stmt === false) {
				echo json_encode(["status" => "error", "message" => "Statement preparation failed: " . $conn->error]);
			}

			$stmt->bind_param("ssssssssssssssssssssssssssssssssssssssss", $surveyor_id, $survey_no, $shop_photo_path, $chemist_photo_path, $first_name, $middle_name, $last_name, $education, $firm_name, $address, $gps_coordinates, $contact_number_1, $contact_number_2, $email_id, $license_status, $lic_holder_name, $relation, $validity, $shop_open_time, $shop_close_time, $business_age, $total_investment, $total_investment_inventory, $avg_sale_per_day, $avg_expenses_per_day, $inventory_rotation, $avg_shelf_life, $max_stock_wait_days, $unsellable_stock_count, $unsellable_stock_cost, $computer_at_shop, $internet_available, $inventory_management_software, $shop_area, $sale_dependency, $hospitals_5km, $hospitals_list, $distributors_per_month, $discount_range, $conditions_for_discount);
			if ($stmt->execute()) {
				echo json_encode(["status" => "success", "message" => "Data inserted successfully"]);
			} else {
				echo json_encode(["status" => "error", "message" => "Error executing statement: " . $stmt->error]);
			}
		} else {
			echo json_encode(["status" => "error", "message" => "Error uploading files: Check files 'chemist_photo' and 'shop_photo'"]);
		}
	}
	function editSurvey($conn, $filesArray, $postArray)
	{
		$survey_id = $postArray['survey_id'];
		$survey_no = $postArray['survey_no'];

		$chemist_photo_path = "";
		$shop_photo_path = "";
		$target_file_chemist = "";
		$target_file_shop = "";

		// Check if the chemist photo is included in the form
		if (isset($filesArray["chemist_photo"]) && !empty($filesArray["chemist_photo"]["name"])) {
			// Delete the old chemist photo, if it exists
			$sql = "SELECT chemist_photo FROM rx_survey_data WHERE survey_id = '$survey_id'";
			$result = mysqli_query($conn, $sql);
			if ($result && mysqli_num_rows($result) > 0) {
				$row = mysqli_fetch_assoc($result);
				$old_chemist_photo_path = $row['chemist_photo'];
				if (!empty($old_chemist_photo_path)) {
					// Delete the old chemist photo file
					if (file_exists($old_chemist_photo_path)) {
						unlink($old_chemist_photo_path);
					}
				}
			}

			// Move the uploaded chemist photo to the directory
			$file_extension1 = pathinfo($filesArray["chemist_photo"]["name"], PATHINFO_EXTENSION);
			$target_file_chemist = "./Images/Survay_images/" . $survey_no . "_chemist_photo." . $file_extension1;
			if (move_uploaded_file($filesArray["chemist_photo"]["tmp_name"], $target_file_chemist)) {
				$chemist_photo_path = $target_file_chemist; // Update the chemist photo path
			} else {
				echo json_encode(["status" => "error", "message" => "Error uploading chemist photo"]);
				return;
			}
		} else {
			// If the chemist photo is not included in the form, retrieve its existing path from the database
			$sql = "SELECT chemist_photo FROM rx_survey_data WHERE survey_id = '$survey_id'";
			$result = mysqli_query($conn, $sql);
			if ($result && mysqli_num_rows($result) > 0) {
				$row = mysqli_fetch_assoc($result);
				$chemist_photo_path = $row['chemist_photo'];
			}
		}

		// Check if the shop photo is included in the form
		if (isset($filesArray["shop_photo"]) && !empty($filesArray["shop_photo"]["name"])) {
			// Delete the old shop photo, if it exists
			$sql = "SELECT shop_photo FROM rx_survey_data WHERE survey_id = '$survey_id'";
			$result = mysqli_query($conn, $sql);
			if ($result && mysqli_num_rows($result) > 0) {
				$row = mysqli_fetch_assoc($result);
				$old_shop_photo_path = $row['shop_photo'];
				if (!empty($old_shop_photo_path)) {
					// Delete the old shop photo file
					if (file_exists($old_shop_photo_path)) {
						unlink($old_shop_photo_path);
					}
				}
			}

			// Move the uploaded shop photo to the directory
			$file_extension2 = pathinfo($filesArray["shop_photo"]["name"], PATHINFO_EXTENSION);
			$target_file_shop = "./Images/Survay_images/" . $survey_no . "_shop_photo." . $file_extension2;
			if (move_uploaded_file($filesArray["shop_photo"]["tmp_name"], $target_file_shop)) {
				$shop_photo_path = $target_file_shop; // Update the shop photo path
			} else {
				echo json_encode(["status" => "error", "message" => "Error uploading shop photo"]);
				return;
			}
		} else {
			// If the shop photo is not included in the form, retrieve its existing path from the database
			$sql = "SELECT shop_photo FROM rx_survey_data WHERE survey_id = '$survey_id'";
			$result = mysqli_query($conn, $sql);
			if ($result && mysqli_num_rows($result) > 0) {
				$row = mysqli_fetch_assoc($result);
				$shop_photo_path = $row['shop_photo'];
			}
		}

		// $chemist_photo_path = $target_file_chemist;
		// $shop_photo_path = $target_file_shop;
		$surveyor_id = $_SESSION['login_Surveyor_ID'];
		$first_name = $postArray['first_name'];
		$middle_name = $postArray['middle_name'];
		$last_name = $postArray['last_name'];
		$education = $postArray['education'];
		$firm_name = $postArray['firm_name'];
		$address = $postArray['address'];
		$gps_coordinates = $postArray['gps_coordinates'];
		$contact_number_1 = $postArray['contact_number_1'];
		$contact_number_2 = $postArray['contact_number_2'];
		$email_id = $postArray['email_id'];
		$license_status = $postArray['license_status'];
		$lic_holder_name = $postArray['lic_holder_name'];
		$relation = $postArray['relation'];
		$validity = $postArray['validity'];
		$shop_open_time = $postArray['shop_open_time'];
		$shop_close_time = $postArray['shop_close_time'];
		$business_age = $postArray['business_age'];
		$total_investment = $postArray['total_investment'];
		$total_investment_inventory = $postArray['total_investment_inventory'];
		$avg_sale_per_day = $postArray['avg_sale_per_day'];
		$avg_expenses_per_day = $postArray['avg_expenses_per_day'];
		$inventory_rotation = $postArray['inventory_rotation'];
		$avg_shelf_life = $postArray['avg_shelf_life'];
		$max_stock_wait_days = $postArray['max_stock_wait_days'];
		$unsellable_stock_count = $postArray['unsellable_stock_count'];
		$unsellable_stock_cost = $postArray['unsellable_stock_cost'];
		$computer_at_shop = $postArray['computer_at_shop'];
		$internet_available = $postArray['internet_available'];
		$inventory_management_software = $postArray['inventory_management_software'];
		$shop_area = $postArray['shop_area'];
		$sale_dependency = $postArray['sale_dependency'];
		$hospitals_5km = $postArray['hospitals_5km'];
		$hospitals_list = $postArray['hospitals_list'];
		$distributors_per_month = $postArray['distributors_per_month'];
		$discount_range = $postArray['discount_range'];
		$conditions_for_discount = $postArray['conditions_for_discount'];

		// Construct the SQL query to update the survey data
		$sql = "UPDATE rx_survey_data SET 
				first_name = '$first_name',
				middle_name = '$middle_name',
				last_name = '$last_name',
				education = '$education',
				firm_name = '$firm_name',
				address = '$address',
				gps_coordinates = '$gps_coordinates',
				contact_number_1 = '$contact_number_1',
				contact_number_2 = '$contact_number_2',
				email_id = '$email_id',
				license_status = '$license_status',
				lic_holder_name = '$lic_holder_name',
				relation = '$relation',
				validity = '$validity',
				shop_open_time = '$shop_open_time',
				shop_close_time = '$shop_close_time',
				business_age = '$business_age',
				total_investment = '$total_investment',
				total_investment_inventory = '$total_investment_inventory',
				avg_sale_per_day = '$avg_sale_per_day',
				avg_expenses_per_day = '$avg_expenses_per_day',
				inventory_rotation = '$inventory_rotation',
				avg_shelf_life = '$avg_shelf_life',
				max_stock_wait_days = '$max_stock_wait_days',
				unsellable_stock_count = '$unsellable_stock_count',
				unsellable_stock_cost = '$unsellable_stock_cost',
				computer_at_shop = '$computer_at_shop',
				internet_available = '$internet_available',
				inventory_management_software = '$inventory_management_software',
				shop_area = '$shop_area',
				sale_dependency = '$sale_dependency',
				hospitals_5km = '$hospitals_5km',
				hospitals_list = '$hospitals_list',
				distributors_per_month = '$distributors_per_month',
				discount_range = '$discount_range',
				conditions_for_discount = '$conditions_for_discount',
				chemist_photo = '$chemist_photo_path',
				shop_photo = '$shop_photo_path'
				WHERE survey_id = '$survey_id'";

		if (mysqli_query($conn, $sql)) {
			echo json_encode(["status" => "success", "message" => "Survey updated successfully"]);
		} else {
			echo json_encode(["status" => "error", "message" => "Error updating survey: " . mysqli_error($conn)]);
		}
	}





	// 	function editSurvey($conn, $filesArray, $postArray)
// {
//     $target_dir = "./Images/Survay_images/";

	//     // Get the survey number from the form or session, replace this with your logic
//     $survey_no = $_SESSION['survey_no'];

	//     $file_extension1 = pathinfo($filesArray["chemist_photo"]["name"], PATHINFO_EXTENSION);
//     $file_extension2 = pathinfo($filesArray["shop_photo"]["name"], PATHINFO_EXTENSION);
//     $target_file_chemist = $target_dir . $survey_no . "_chemist_photo." . $file_extension1;
//     $target_file_shop = $target_dir . $survey_no . "_shop_photo." . $file_extension2;

	//     if (
//         move_uploaded_file($filesArray["chemist_photo"]["tmp_name"], $target_file_chemist) &&
//         move_uploaded_file($filesArray["shop_photo"]["tmp_name"], $target_file_shop)
//     ) {
//         // Get other form data
//         $chemist_photo_path = $target_file_chemist;
//         $shop_photo_path = $target_file_shop;
//         $surveyor_id = $_SESSION['login_Surveyor_ID'];
//         $first_name = $postArray['first_name'];
//         $middle_name = $postArray['middle_name'];
//         $last_name = $postArray['last_name'];
//         $education = $postArray['education'];
//         // Add the rest of your form fields here...

	//         // Construct the UPDATE query
//         $sql = "UPDATE rx_survey_data SET 
//             shop_photo = ?,
//             chemist_photo = ?,
//             first_name = ?,
//             middle_name = ?,
//             last_name = ?,
//             education = ?,
//             firm_name = ?,
//             address = ?,
//             gps_coordinates = ?,
//             contact_number_1 = ?,
//             contact_number_2 = ?,
//             email_id = ?,
//             license_status = ?,
//             lic_holder_name = ?,
//             relation = ?,
//             validity = ?,
//             shop_open_time = ?,
//             shop_close_time = ?,
//             business_age = ?,
//             total_investment = ?,
//             total_investment_inventory = ?,
//             avg_sale_per_day = ?,
//             avg_expenses_per_day = ?,
//             inventory_rotation = ?,
//             avg_shelf_life = ?,
//             max_stock_wait_days = ?,
//             unsellable_stock_count = ?,
//             unsellable_stock_cost = ?,
//             computer_at_shop = ?,
//             internet_available = ?,
//             inventory_management_software = ?,
//             shop_area = ?,
//             sale_dependency = ?,
//             hospitals_5km = ?,
//             hospitals_list = ?,
//             distributors_per_month = ?,
//             discount_range = ?,
//             conditions_for_discount = ?
//             WHERE survey_no = ?";

	//         $stmt = $conn->prepare($sql);

	//         if ($stmt === false) {
//             echo json_encode(["status" => "error", "message" => "Statement preparation failed: " . $conn->error]);
//         }

	//         // Dynamically bind parameters
//         $params = [&$stmt, ""];
//         $types = "";
//         foreach ($postArray as $key => $value) {
//             $types .= "s"; // Assume all values are strings, you may need to modify this logic for other data types
//             $params[] = &$postArray[$key];
//         }
//         $types .= "s"; // Add "s" for the survey_no parameter
//         $params[] = &$survey_no;

	//         $params[1] = &$types; // Set the type string as the second parameter

	//         // Call the bind_param function with a dynamic number of arguments
//         call_user_func_array('mysqli_stmt_bind_param', $params);

	//         if ($stmt->execute()) {
//             echo json_encode(["status" => "success", "message" => "Data updated successfully"]);
//         } else {
//             echo json_encode(["status" => "error", "message" => "Error executing statement: " . $stmt->error]);
//         }
//     } else {
//         echo json_encode(["status" => "error", "message" => "Error uploading files: Check files 'chemist_photo' and 'shop_photo'"]);
//     }
// }




	function save_user()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'cpass')) && !is_numeric($k)) {
				if ($k == 'password')
					$v = md5($v);
				if (empty($data)) {
					$data .= " $k='$v' ";
				} else {
					$data .= ", $k='$v' ";
				}
			}
		}
		$check = $this->db->query("SELECT * FROM users where email ='$email' " . (!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if ($check > 0) {
			return 2;
			exit;
		}
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO users set $data");
		} else {
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if ($save) {
			return 1;
		}
	}
	function update_user()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'cpass', 'table')) && !is_numeric($k)) {
				if ($k == 'password')
					$v = md5($v);
				if (empty($data)) {
					$data .= " $k='$v' ";
				} else {
					$data .= ", $k='$v' ";
				}
			}
		}
		$check = $this->db->query("SELECT * FROM users where email ='$email' " . (!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if ($check > 0) {
			return 2;
			exit;
		}
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO users set $data");
		} else {
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if ($save) {
			foreach ($_POST as $key => $value) {
				if ($key != 'password' && !is_numeric($key))
					$_SESSION['login_' . $key] = $value;
			}
			return 1;
		}
	}
	function delete_user()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM users where id = " . $id);
		if ($delete)
			return 1;
	}
	function save_page_img()
	{
		extract($_POST);
		if ($_FILES['img']['tmp_name'] != '') {
			$fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'], 'assets/uploads/' . $fname);
			if ($move) {
				$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https' ? 'https' : 'http';
				$hostName = $_SERVER['HTTP_HOST'];
				$path = explode('/', $_SERVER['PHP_SELF']);
				$currentPath = '/' . $path[1];
				// $pathInfo = pathinfo($currentPath); 

				return json_encode(array('link' => $protocol . '://' . $hostName . $currentPath . '/admin/assets/uploads/' . $fname));

			}
		}
	}


	function delete_survey()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM rx_survey_data where sruvey_id = " . $id);
		if ($delete) {
			return 1;
		}
	}

	function save_question()
	{
		extract($_POST);
		$data = " survey_id=$sid ";
		$data .= ", question='$question' ";
		$data .= ", type='$type' ";
		if ($type != 'textfield_s') {
			$arr = array();
			foreach ($label as $k => $v) {
				$i = 0;
				while ($i == 0) {
					$k = substr(str_shuffle(str_repeat($x = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(5 / strlen($x)))), 1, 5);
					if (!isset($arr[$k]))
						$i = 1;
				}
				$arr[$k] = $v;
			}
			$data .= ", frm_option='" . json_encode($arr) . "' ";
		} else {
			$data .= ", frm_option='' ";
		}
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO questions set $data");
		} else {
			$save = $this->db->query("UPDATE questions set $data where id = $id");
		}

		if ($save)
			return 1;
	}
	function delete_question()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM questions where id = " . $id);
		if ($delete) {
			return 1;
		}
	}
	function action_update_qsort()
	{
		extract($_POST);
		$i = 0;
		foreach ($qid as $k => $v) {
			$i++;
			$update[] = $this->db->query("UPDATE questions set order_by = $i where id = $v");
		}
		if (isset($update))
			return 1;
	}
	function save_answer()
	{
		extract($_POST);
		foreach ($qid as $k => $v) {
			$data = " survey_id=$survey_id ";
			$data .= ", question_id='$qid[$k]' ";
			$data .= ", user_id='{$_SESSION['surveyor_id']}' ";
			if ($type[$k] == 'check_opt') {
				$data .= ", answer='[" . implode("],[", $answer[$k]) . "]' ";
			} else {
				$data .= ", answer='$answer[$k]' ";
			}
			$save[] = $this->db->query("INSERT INTO answers set $data");
		}


		if (isset($save))
			return 1;
	}
	function delete_comment()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM comments where id = " . $id);
		if ($delete) {
			return 1;
		}
	}
}
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
			$pin_code = $postArray['pin_code'];

			// Prepare and bind
			$stmt = $conn->prepare("UPDATE users SET Aadhar_Card_Number = ?, PAN_Card_Number = ?, Driving_License_Number = ?, Email_ID = ?, Village = ?, Tehsil = ?, City = ?, District = ?, State = ?, Country = ?, PIN_Code = ?, Link_to_Photo = ? WHERE Surveyor_ID = ?");
			$stmt->bind_param("sssssssssssss", $aadhar_card_number, $pan_card_number, $driving_license_number, $email_id, $village, $tehsil, $city, $district, $state, $country, $pin_code, $target_file, $surveyor_id);

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
				$_SESSION['login_PIN_Code'] = $pin_code;
				$_SESSION['login_Link_to_Photo'] = $target_file;

				echo "Data updated successfully";
			} else {
				echo "Error updating data: " . $stmt->error;
			}
		} else {
			echo "Error uploading file";
		}
	}




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

	function save_survey()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id')) && !is_numeric($k)) {
				if (empty($data)) {
					$data .= " $k='$v' ";
				} else {
					$data .= ", $k='$v' ";
				}
			}
		}
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO survey_set set $data");
		} else {
			$save = $this->db->query("UPDATE survey_set set $data where id = $id");
		}

		if ($save)
			return 1;
	}
	function delete_survey()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM survey_set where id = " . $id);
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
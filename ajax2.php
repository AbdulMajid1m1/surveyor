<?php


error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require __DIR__ . '/vendor/autoload.php';
include('./db_connect.php');




function generateRandomOTP($length = 6)
{
	return rand(pow(10, $length - 1), pow(10, $length) - 1);
}

// $response = [];
$response = array();

if (isset($_POST['action'])) {
	$action = $_POST['action'];
	unset($_POST['action']);

	if ($action == 'save') {
		$first_name = $_POST['first_name'];
		$middle_name = $_POST['middle_name'];
		$last_name = $_POST['last_name'];
		// append +91 to mobile number
		$mobile_number = "+92" . $_POST['mobile_number'];
		// call phoneAuth function in firebase.js


		$result = mysqli_query($conn, "SELECT COUNT(*) AS count FROM users");
		$row = mysqli_fetch_assoc($result);
		$count = $row['count'] + 1;
		$surveyor_id = "EXE" . str_pad($count, 4, '0', STR_PAD_LEFT);

		$result = mysqli_query($conn, "SELECT * FROM users WHERE Mobile_Number='$mobile_number'");
		if (mysqli_num_rows($result) == 0) {
			$query = "INSERT INTO users (Surveyor_ID, First_Name, Middle_Name, Last_Name, Mobile_Number, Status) VALUES ('$surveyor_id', '$first_name', '$middle_name', '$last_name', '$mobile_number', 0)";
			if (mysqli_query($conn, $query)) {
				$otp = generateRandomOTP();
				$update_query = "UPDATE users SET PIN_Code='$otp' WHERE Surveyor_ID='$surveyor_id'";
				mysqli_query($conn, $update_query);

				// sms api here

				// Save the mobile number in a session
				$_SESSION['pending_mobile_number'] = $mobile_number;

				$response = ['status' => 'success', 'message' => 'OTP is generated and sent to your mobile number.', 'otp_active' => true, 'surveyor_id' => $surveyor_id];
			} else {
				$response = ['status' => 'error', 'message' => "Error: " . $query . "<br>" . mysqli_error($conn)];
			}
		} else {
			// Check if the user has verified the OTP or not
			$user = mysqli_fetch_assoc($result);
			if ($user['Status'] == 0) {
				// Update the existing record with the new data
				$query = "UPDATE users SET First_Name='$first_name', Middle_Name='$middle_name', Last_Name='$last_name' WHERE Mobile_Number='$mobile_number'";
				if (mysqli_query($conn, $query)) {
					$otp = generateRandomOTP();
					$update_query = "UPDATE users SET PIN_Code='$otp' WHERE Surveyor_ID='$user[Surveyor_ID]'";
					mysqli_query($conn, $update_query);



					// Save the mobile number in a session
					$_SESSION['pending_mobile_number'] = $mobile_number;

					$response = ['status' => 'success', 'message' => 'OTP is generated and sent to your mobile number.', 'otp_active' => true, 'surveyor_id' => $user['Surveyor_ID']];
				} else {
					$response = ['status' => 'error', 'message' => "Error updating existing user: " . mysqli_error($conn)];
				}
			} else {
				$response = ['status' => 'error', 'message' => "Mobile number already exists and OTP is verified!"];
			}
		}
		echo json_encode($response);
		exit;
	}

	if ($action == 'verify_otp') {
		$surveyor_id = $_POST['surveyor_id'];

		$update_query = "UPDATE users SET Status=1 WHERE Surveyor_ID='$surveyor_id'";
		mysqli_query($conn, $update_query);

		$result = mysqli_query($conn, "SELECT * FROM users WHERE Surveyor_ID='$surveyor_id'");
		// save surveyor_id in session
		$_SESSION['surveyor_id'] = $surveyor_id;
		// save all user details in session
		$row = mysqli_fetch_assoc($result);
		foreach ($row as $key => $value) {
			if ($key != 'Password' && !is_numeric($key))
				$_SESSION['login_' . $key] = $value;
		}
		$response = ['status' => 'verified', 'message' => 'OTP verified successfully'];

		echo json_encode($response);
		exit;
	}
	// create action to save password
	if ($action == 'save_password') {
		$surveyor_id = $_POST['surveyor_id'];
		$password = $_POST['signup_password'];

		// Update the existing record with the new data

		$query = "UPDATE users SET Password=md5('$password') WHERE Surveyor_ID='$surveyor_id'";
		if (mysqli_query($conn, $query)) {
			$response = ['status' => 'password_saved', 'message' => 'Password saved successfully. Redirecting...'];
		} else {
			$response = ['status' => 'error', 'message' => "Error updating existing user: " . mysqli_error($conn)];
		}
		echo json_encode($response);
		exit;
	}
}
?>
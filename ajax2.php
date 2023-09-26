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

$response = [];

if (isset($_POST['action'])) {
	$action = $_POST['action'];
	unset($_POST['action']);

	if ($action == 'save') {
		$first_name = $_POST['first_name'];
		$middle_name = $_POST['middle_name'];
		$last_name = $_POST['last_name'];
		// append +91 to mobile number
		$mobile_number = "+91" . $_POST['mobile_number'];


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

				$response = ['status' => 'success', 'message' => 'OTP is generated and sent to your mobile number.' . $otp, 'otp_active' => true, 'surveyor_id' => $surveyor_id];
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
		$entered_otp = $_POST['otp'];
		$surveyor_id = $_POST['surveyor_id'];

		$result = mysqli_query($conn, "SELECT * FROM users WHERE Surveyor_ID='$surveyor_id' AND PIN_Code='$entered_otp'");
		if (mysqli_num_rows($result) == 1) {
			$update_query = "UPDATE users SET Status=1 WHERE Surveyor_ID='$surveyor_id'";
			mysqli_query($conn, $update_query);

			// save surveyor_id in session
			$_SESSION['surveyor_id'] = $surveyor_id;
			// save all user details in session
			$row = mysqli_fetch_assoc($result);
			foreach ($row as $key => $value) {
				if ($key != 'Password' && !is_numeric($key))
					$_SESSION['login_' . $key] = $value;
			}
			$response = ['status' => 'verified', 'message' => 'OTP verified successfully'];
		} else {
			$response = ['status' => 'error', 'message' => 'Wrong OTP!', 'otp_active' => true, 'surveyor_id' => $surveyor_id];
		}
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




<div class="main-container">
	<div class="card-header">
		<div class="logo-container">
			<img src="assets/dist/img/rxFinder.jpeg" alt="RxFinder Logo">
		</div>
		<p class="main-login-text">
			Come and Join Our Survey Team
		</p>
		<div style="margin-bottom: 20px;"></div>
		<ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
			<li class="nav-item" role="presentation">
				<button class="nav-link active" id="pills-login-tab" data-bs-toggle="pill" data-bs-target="#pills-login"
					type="button" role="tab" aria-controls="pills-login" aria-selected="true">Login</button>
			</li>
			<li class="nav-item" role="presentation" style="margin-left: 10px;">
				<button class="nav-link" id="pills-signup-tab" data-bs-toggle="pill" data-bs-target="#pills-signup"
					type="button" role="tab" aria-controls="pills-signup" aria-selected="false">Signup</button>
			</li>
		</ul>
	</div>
	<div class="tab-content" id="pills-tabContent">
		<div class="tab-pane fade section signup-section" id="pills-signup" role="tabpanel"
			aria-labelledby="pills-signup-tab">
			<form id="user_form">
				<!-- Your existing form fields go here -->
				<div class="form-group">
					<label for="first_name">First Name (पहला नाम)</label>
					<input type="text" id="first_name" name="first_name" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="middle_name">Middle Name (मध्य नाम)</label>
					<input type="text" id="middle_name" name="middle_name" class="form-control">
				</div>
				<div class="form-group">
					<label for="last_name">Last Name (आखिरी नाम)</label>
					<input type="text" id="last_name" name="last_name" class="form-control" required>
				</div>

				<div class="form-group">
					<label for="mobile_number">Mobile Number (मोबाइल नंबर) </label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"
								style="background-color: white; border-right: none; padding-right: 5px;"><img
									src="assets/dist/img/indiaFlag.png" alt="India Flag" width="20" height="20"
									style="object-fit: contain;"></span>
							<span class="input-group-text"
								style="background-color: white; border-left: none; padding-left:1px;">+91</span>
						</div>
						<input type="text" id="mobile_number" name="mobile_number" class="form-control" required
							placeholder="Enter 10 digit mobile number" pattern="[0-9]{10}" oninput="validateInput(this)"
							maxlength="10">
					</div>
				</div>
				<!-- Add a button to trigger OTP verification -->
				<button type="button" id="send_otp_button" class="btn btn-primary btn-block">Send OTP (ओटीपी
					भेजें)</button>

				<div id="otp_section" style="display: none;">
					<div class="form-group">
						<label for="otp">Enter OTP (ओटीपी दर्ज करें)</label>
						<input type="text" id="otp" name="otp" class="form-control" required>
					</div>
					<input type="hidden" name="surveyor_id" id="surveyor_id">
					<button type="button" id="verify_otp_button" class="btn btn-secondary btn-block">Verify OTP
						(ओटीपी सत्यापित करें)</button>
				</div>

				<!-- Add a password field and submit button -->
				<div id="password_section" style="display: none;">
					<div class="form-group">
						<label for="signup_password">Password (पासवर्ड)</label>
						<input type="password" id="signup_password" name="signup_password" class="form-control"
							required>
					</div>
					<button type="button" id="submit_password_button" class="btn btn-primary btn-block">Submit Password
						(पासवर्ड सबमिट करें)</button>
				</div>

				<div id="error_message" class="alert alert-danger" style="display: none;"></div>
			</form>
		</div>
		<div class="tab-pane fade show active section login-section" id="pills-login" role="tabpanel"
			aria-labelledby="pills-login-tab">
			<form id="login_form">
				<!-- <div class="form-group">
						<label for="login_mobile_number">Mobile Number (मोबाइल नंबर)</label>
						<input type="text" id="login_mobile_number" name="login_mobile_number" class="form-control"
							required>
					</div> -->
				<div class="form-group">
					<label for="login_mobile_number">Mobile Number (मोबाइल नंबर)</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"
								style="background-color: white; border-right: none; padding-right: 5px;"><img
									src="assets/dist/img/indiaFlag.png" alt="India Flag" width="20" height="20"
									style="object-fit: contain;"></span>
							<span class="input-group-text"
								style="background-color: white; border-left: none; padding-left:1px;">+91</span>
						</div>

						<input type="text" id="login_mobile_number" name="login_mobile_number" class="form-control"
							placeholder="Enter 10 digit mobile number" pattern="[0-9]{10}" oninput="validateInput(this)"
							maxlength="10" required>
					</div>
				</div>

				<div class="form-group">
					<label for="login_password">Password (पासवर्ड)</label>
					<input type="password" id="login_password" name="login_password" class="form-control" required>
				</div>
				<button type="submit" id="login_button" class="btn btn-primary btn-block">Login (लॉग इन)</button>
			</form>
		</div>
	</div>
</div>
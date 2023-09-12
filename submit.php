<?php
session_start();
include('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $surveyor_id = $_SESSION['login_Surveyor_ID']; // Assuming 'Surveyor_ID' is the session variable name

    if(empty($surveyor_id)) {
        echo "Surveyor ID is not set in the session";
        exit;
    }

    $target_dir = "./Images/Profile_images/";
    $file_extension = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
    $target_file = $target_dir . $surveyor_id . '.' . $file_extension;

    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {

        // Get all other form fields
        $aadhar_card_number = $_POST['aadhar_card_number'];
        $pan_card_number = $_POST['pan_card_number'];
        $driving_license_number = $_POST['driving_license_number'];
        $email_id = $_POST['email_id'];
        $village = $_POST['village'];
        $tehsil = $_POST['tehsil'];
        $city = $_POST['city'];
        $district = $_POST['district'];
        $state = $_POST['state'];
        $country = $_POST['country'];
        $pin_code = $_POST['pin_code'];

        // Prepare and bind
        $stmt = $conn->prepare("UPDATE users SET Aadhar_Card_Number = ?, PAN_Card_Number = ?, Driving_License_Number = ?, Email_ID = ?, Village = ?, Tehsil = ?, City = ?, District = ?, State = ?, Country = ?, PIN_Code = ?, Link_to_Photo = ? WHERE Surveyor_ID = ?");
        $stmt->bind_param("sssssssssssss", $aadhar_card_number, $pan_card_number, $driving_license_number, $email_id, $village, $tehsil, $city, $district, $state, $country, $pin_code, $target_file, $surveyor_id);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Data updated successfully";
        } else {
            echo "Error updating data: " . $stmt->error;
        }
    } else {
        echo "Error uploading file";
    }
}
?>

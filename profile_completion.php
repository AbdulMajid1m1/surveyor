<?php


// Check if the URL contains the specified action
if (isset($_GET['action']) && $_GET['action'] === 'profile_information') {
    // Fetch data from session
    $aadhar_card_number = $_SESSION['login_Aadhar_Card_Number'];
    $pan_card_number = $_SESSION['login_PAN_Card_Number'];
    $driving_license_number = $_SESSION['login_Driving_License_Number'];
    $email_id = $_SESSION['login_Email_ID'];
    $village = $_SESSION['login_Village'];
    $tehsil = $_SESSION['login_Tehsil'];
    $city = $_SESSION['login_City'];
    $district = $_SESSION['login_District'];
    $state = $_SESSION['login_State'];
    $country = $_SESSION['login_Country'];
    $image = $_SESSION['login_Link_to_Photo'];
    // Disable editing of fields
    $disabled = 'disabled';
    $readOnly = true;
    // Hide submit button
    $submitButtonStyle = 'display: none;';
    // Show back button
    $backButtonStyle = '';

} else {
    // Initialize variables for empty form fields
    $aadhar_card_number = '';
    $pan_card_number = '';
    $driving_license_number = '';
    $email_id = '';
    $village = '';
    $tehsil = '';
    $city = '';
    $district = '';
    $state = '';
    $country = '';
    // Enable editing of fields
    $disabled = '';
    $readOnly = false;
    // Show submit button
    $submitButtonStyle = '';
    // Hide back button
    $backButtonStyle = 'display: none;';
}
?>

<?php
include('session_time_check.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Profile Completion</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <?php include('./header.php'); ?>
</head>

<body>
    <!-- Content Header (Page header) -->
    <div class="content-header" style="padding-top: 20px; padding-bottom:20px;">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profile Completion</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right"> <!-- Added a new column for the button and set it to align-right -->
                    <!-- Back Button -->
                    <button type="button" class="btn btn-secondary" style="<?php echo $backButtonStyle; ?>"
                        onclick="goBack()">Back</button>
                </div>
            </div><!-- /.row -->
            <hr class="border-primary">
        </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <!-- if read only is false then show text other wise not -->



                    <!-- <div class="card-header">Complete Your Profile (Note: Details once filled cannot be edited later) -->

                    <?php if ($readOnly == false) { ?>
                        <div class="card-header">Complete Your Profile (Note: Details once filled cannot be edited later)

                        <?php } else { ?>
                            <div class="card-header">
                                <?php echo $_SESSION['login_First_Name'] . " " . $_SESSION['login_Last_Name'] ?> Profile
                                Details
                            <?php } ?>

                        </div>
                        <div class="card-body">

                            <form id="profile_form" enctype="multipart/form-data" onsubmit="handleSubmit(event)">
                                <?php if ($readOnly == false) { ?>
                                    <div class="form-group">
                                        <label for="photo">Photo (The photo will be saved with the 'surveyor ID')*</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="photo" name="photo" required
                                                onchange="displayImage(event)">
                                            <label class="custom-file-label" for="photo">
                                                <i class="fas fa-upload" style="font-size: 1.5rem;"></i>
                                            </label>
                                        </div>
                                        <img id="preview" src="" alt="Uploaded Image"
                                            style="display:none; width:100px; height:100px; margin-top:10px;" />
                                    </div>

                                <?php } else { ?>


                                    <!-- show iamge using src  $image -->

                                    <img id="preview" src="<?php echo $image; ?>" alt="Uploaded Image"
                                        style="display:block; width:100px; height:100px; margin-top:10px;" />

                                <?php } ?>




                                <!-- Aadhar Card Number (12 digits) -->
                                <div class="form-group">
                                    <label>Aadhar Card Number (12 digits)*</label>
                                    <input type="text" name="aadhar_card_number" class="form-control"
                                        title="Please enter a valid Aadhar card number" required
                                        value="<?php echo $aadhar_card_number; ?>" <?php echo $disabled; ?>>
                                </div>

                                <!-- PAN Card Number (should be 10 characters long) -->
                                <div class="form-group">
                                    <label>PAN Card Number (should be 10 characters long)*</label>
                                    <input type="text" name="pan_card_number" class="form-control"
                                        title="Please enter a valid PAN card number" required
                                        value="<?php echo $pan_card_number; ?>" <?php echo $disabled; ?>>
                                </div>

                                <div class="form-group">
                                    <label>Driving License Number*</label>
                                    <input type="text" name="driving_license_number" class="form-control" required
                                        value="<?php echo $driving_license_number; ?>" <?php echo $disabled; ?>>

                                </div>

                                <div class="form-group">
                                    <label>Email ID*</label>
                                    <input type="email" name="email_id" class="form-control" required
                                        value="<?php echo $email_id; ?>" <?php echo $disabled; ?>>
                                </div>

                                <div class="form-group">
                                    <label>Village*</label>
                                    <input type="text" name="village" class="form-control" required
                                        value="<?php echo $village; ?>" <?php echo $disabled; ?>>
                                </div>

                                <div class="form-group">
                                    <label>Tehsil*</label>
                                    <input type="text" name="tehsil" class="form-control" required
                                        value="<?php echo $tehsil; ?>" <?php echo $disabled; ?>>
                                </div>

                                <div class="form-group">
                                    <label>City*</label>
                                    <input type="text" name="city" class="form-control" required
                                        value="<?php echo $city; ?>" <?php echo $disabled; ?>>
                                </div>

                                <div class="form-group">
                                    <label>District*</label>
                                    <input type="text" name="district" class="form-control" required
                                        value="<?php echo $district; ?>" <?php echo $disabled; ?>>
                                </div>

                                <div class="form-group">
                                    <label>State*</label>
                                    <input type="text" name="state" class="form-control" required
                                        value="<?php echo $state; ?>" <?php echo $disabled; ?>>
                                </div>

                                <div class="form-group">
                                    <label>Country*</label>
                                    <input type="text" name="country" class="form-control" required
                                        value="<?php echo $country; ?>" <?php echo $disabled; ?>>
                                </div>




                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary"
                                    style="<?php echo $submitButtonStyle; ?>">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

        <script>
            // JavaScript function to navigate back
            function goBack() {
                window.history.back();
            }

            function handleSubmit(event) {
                event.preventDefault();
                start_load();
                var formData = new FormData(document.getElementById('profile_form'));
                $.ajax({
                    // url: 'submit.php',
                    url: 'ajax.php?action=profile_completion',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        response = JSON.parse(response);
                        console.log(response);

                        if (response.status === "success") {
                            end_load();
                            toastr.success(response.message);
                            setTimeout(function () {
                                window.location.href = 'index.php?page=home';
                            }, 1000);
                        } else {
                            end_load();
                            toastr.error(response.message);
                        }
                    },
                    error: function () {
                        end_load();
                        toastr.error('Error saving data');
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }

            function displayImage(event) {
                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('preview');
                    output.src = reader.result;
                    output.style.display = 'block';
                };
                reader.readAsDataURL(event.target.files[0]);
            }
        </script>

        <style>
            .btn-file {
                position: relative;
                overflow: hidden;
            }

            .btn-file input[type=file] {
                position: absolute;
                top: 0;
                right: 0;
                min-width: 100%;
                min-height: 100%;
                font-size: 100px;
                text-align: right;
                filter: alpha(opacity=0);
                opacity: 0;
                background: red;
                cursor: inherit;
                display: block;
            }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <?php include 'footer.php' ?>
</body>

</html>
<?php
include('session_time_check.php');
?>
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


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Profile Details</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <?php include('./header.php'); ?>
</head>


<body>
    <!-- Content Header (Page header) -->
    <div class="content-header profile-header" style="padding-top: 20px; padding-bottom: 20px;">
        <div class="container-fluid">
            <div class="parent-component">
                <div class="left">
                    <h1 class="m-0">Profile Details</h1>
                </div>
                <div class="right text-right"> <!-- Added a new column for the image on the right -->
                    <img src="assets/dist/img/rxFinder.jpeg" alt="RxFinder Logo" class="img-responsive">
                </div>
            </div>
            <hr class="border-primary">
        </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->

    <div class="container">
        <div class="inner-container row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <!-- if read only is false then show text other wise not -->



                    <!-- <div class="card-header">Complete Your Profile (Note: Details once filled cannot be edited later) -->

                    <?php if ($readOnly == false) { ?>
                        <div class="card-header">Complete Your Profile (Note: Details once filled cannot be edited later)

                        <?php } else { ?>
                            <div class="card-header">
                                <?php echo $_SESSION['login_First_Name'] . " " . $_SESSION['login_Last_Name'] ?> Profile

                            <?php } ?>

                        </div>
                        <div class="card-body">

                            <form id="profile_form" enctype="multipart/form-data" onsubmit="handleSubmit(event)">
                                <?php if ($readOnly == false) { ?>
                                    <div class="form-group">
                                        <label for="photo">Profile Picture (प्रोफ़ाइल तस्वीर)*</label>
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
                                    <!-- show image using src  $image -->
                                    <img id="preview" src="<?php echo $image; ?>" alt="Uploaded Image"
                                        style="display:block; width:100px; height:100px; margin-top:10px;" />
                                <?php } ?>

                                <div class="form-group">
                                    <label>Aadhar Card Number (आधार कार्ड नंबर)*</label>
                                    <input type="text" name="aadhar_card_number" class="form-control"
                                        title="Please enter a valid Aadhar card number" required
                                        value="<?php echo $aadhar_card_number; ?>" <?php echo $disabled; ?>>
                                </div>

                                <div class="form-group">
                                    <label>PAN Card Number (पैन कार्ड नंबर)*</label>
                                    <input type="text" name="pan_card_number" class="form-control"
                                        title="Please enter a valid PAN card number" required
                                        value="<?php echo $pan_card_number; ?>" <?php echo $disabled; ?>>
                                </div>

                                <div class="form-group">
                                    <label>Driving License Number (ड्राइविंग लाइसेंस नंबर)*</label>
                                    <input type="text" name="driving_license_number" class="form-control" required
                                        value="<?php echo $driving_license_number; ?>" <?php echo $disabled; ?>>
                                </div>

                                <div class="form-group">
                                    <label>Email ID (ईमेल ID)*</label>
                                    <input type="email" name="email_id" class="form-control" required
                                        value="<?php echo $email_id; ?>" <?php echo $disabled; ?>>
                                </div>

                                <div class="form-group">
                                    <label>Village (गाँव)*</label>
                                    <input type="text" name="village" class="form-control" required
                                        value="<?php echo $village; ?>" <?php echo $disabled; ?>>
                                </div>

                                <div class="form-group">
                                    <label>Tehsil (तहसील)*</label>
                                    <input type="text" name="tehsil" class="form-control" required
                                        value="<?php echo $tehsil; ?>" <?php echo $disabled; ?>>
                                </div>

                                <div class="form-group">
                                    <label>City (शहर)*</label>
                                    <input type="text" name="city" class="form-control" required
                                        value="<?php echo $city; ?>" <?php echo $disabled; ?>>
                                </div>

                                <div class="form-group">
                                    <label>District (जिला)*</label>
                                    <input type="text" name="district" class="form-control" required
                                        value="<?php echo $district; ?>" <?php echo $disabled; ?>>
                                </div>

                                <div class="form-group">
                                    <label>State (राज्य)*</label>
                                    <input type="text" name="state" class="form-control" required
                                        value="<?php echo $state; ?>" <?php echo $disabled; ?>>
                                </div>

                                <div class="form-group">
                                    <label>Country (देश)*</label>
                                    <input type="text" name="country" class="form-control" required
                                        value="<?php echo $country; ?>" <?php echo $disabled; ?>>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary"
                                    style="<?php echo $submitButtonStyle; ?>">Submit (जमा करें)</button>

                            </form>

                        </div>
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
        /* body {
            background-color: #f8cbad;
        } */


        .card {
            background-color: #f8cbad;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;

        }

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

        .parent-component {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /*  media query  */
        @media (max-width: 500px) {
            body {
                background-color: #f8cbad;
            }

            .parent-component {
                display: flex;
                flex-direction: flex-start;
                justify-content: flex-start;
                align-items: center;
                gap: 10px;
            }

            .left {
                display: none;
            }

            .profile-header {
                padding: 0 !important;
                padding-top: 10px !important;
                padding-left: 1.25rem !important;
            }

            .card {
                background-color: #f8cbad;
                box-shadow: none;

            }


        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <?php include 'footer.php' ?>
</body>

</html>
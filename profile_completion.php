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
            </div><!-- /.row -->
            <hr class="border-primary">
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Complete Your Profile (Note: Details once filled cannot be edited later)
                    </div>
                    <div class="card-body">
                        <form id="profile_form" enctype="multipart/form-data" onsubmit="handleSubmit(event)">
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


                            <div class="form-group">
                                <label>Aadhar Card Number (12 digits)*

                                    <!-- pattern="\d{12}" -->
                                </label>
                                <input type="text" name="aadhar_card_number" class="form-control"
                                    title="Please enter a valid Aadhar card number" required >
                            </div>

                            <div class="form-group">
                                <label>PAN Card Number (should be 10 characters long)*

                                </label>
                                <!-- pattern="[A-Z]{5}\d{4}[A-Z]{1}"  -->
                                <input type="text" name="pan_card_number" class="form-control"
                                    title="Please enter a valid PAN card number" required >
                            </div>

                            <div class="form-group">
                                <label>Driving License Number*</label>
                                <input type="text" name="driving_license_number" class="form-control" required
                                    >
                            </div>

                            <div class="form-group">
                                <label>Email ID*</label>
                                <input type="email" name="email_id" class="form-control" required
                                    >
                            </div>

                            <div class="form-group">
                                <label>Village*</label>
                                <input type="text" name="village" class="form-control" required >
                            </div>

                            <div class="form-group">
                                <label>Tehsil*</label>
                                <input type="text" name="tehsil" class="form-control" required >
                            </div>

                            <div class="form-group">
                                <label>City*</label>
                                <input type="text" name="city" class="form-control" required >
                            </div>

                            <div class="form-group">
                                <label>District*</label>
                                <input type="text" name="district" class="form-control" required >
                            </div>

                            <div class="form-group">
                                <label>State*</label>
                                <input type="text" name="state" class="form-control" required >
                            </div>

                            <div class="form-group">
                                <label>Country*</label>
                                <input type="text" name="country" class="form-control" required >
                            </div>

                            <div class="form-group">
                                <label>PIN Code

                                </label>
                                <input type="text" name="pin_code" class="form-control" pattern="\d{6}" 
                                    title="Please enter a valid PIN code" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
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
        function handleSubmit(event) {
            event.preventDefault();
            var formData = new FormData(document.getElementById('profile_form'));
            $.ajax({
                url: 'submit.php',
                type: 'POST',
                data: formData,
                success: function (response) {
                    toastr.success(response);
                },
                error: function (response) {
                    toastr.error('Error saving data');
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }

        function displayPhoto(event) {
            var imgPreview = document.getElementById('imgPreview');
            imgPreview.style.display = "block";
            imgPreview.src = URL.createObjectURL(event.target.files[0]);
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


</body>

</html>
<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title>Surveyor Signup Page</title>
	<?php include('./header.php'); ?>
	<style>
		body {
			background-color: #f8f9fa;
			width: 100%;
			height: 100vh;
			display: flex;
			justify-content: center;
			align-items: center;
			transition: all 0.3s;
		}

		.main-container {
			max-width: 400px;
			width: 100%;
			background: #fff;
			border-radius: 10px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			overflow: hidden;
			padding: 20px;
		}

		.card-header {
			text-align: center;
			font-size: 24px;
			font-weight: bold;
			color: #343a40;
			margin-bottom: 20px;
		}

		.form-group {
			margin-bottom: 15px;
		}

		.form-group label {
			color: #343a40;
		}

		.btn {
			background-color: #007bff;
			color: #fff;
			border: none;
		}

		.btn:hover {
			background-color: #0056b3;
		}

		.back-to-top {
			position: fixed;
			bottom: 20px;
			right: 20px;
			color: #343a40;
		}

		.section {
			display: none;
		}

		.section.active {
			display: block;
		}

		.login-section input,
		.signup-section input {
			width: 100%;
			padding: 8px;
			margin: 10px 0;
			box-sizing: border-box;
		}

		.nav-item .nav-link {
			padding: 10px 16px;
			/* Adjust as needed */
			font-size: 14px;
			/* Adjust as needed */
			text-align: center;
		}
	</style>
</head>

<body>
	<div class="main-container">
		<div class="card-header" style="text-align: center;">
			Online Survey System
			<div style="margin-bottom: 20px;"></div>
			<ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
				<li class="nav-item" role="presentation" style="margin-right: 10px;">
					<button class="nav-link active" id="pills-signup-tab" data-bs-toggle="pill"
						data-bs-target="#pills-signup" type="button" role="tab" aria-controls="pills-signup"
						aria-selected="true"
						style="background-color: #007bff; border-radius: 5px; border: none; transition: all 0.3s;">
						Signup
					</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="pills-login-tab" data-bs-toggle="pill" data-bs-target="#pills-login"
						type="button" role="tab" aria-controls="pills-login" aria-selected="false"
						style="background-color: transparent; border-radius: 5px; border: none; transition: all 0.3s;">
						Login
					</button>
				</li>
			</ul>
		</div>
		<div class="tab-content" id="pills-tabContent">
			<div class="tab-pane fade show active section signup-section" id="pills-signup" role="tabpanel"
				aria-labelledby="pills-signup-tab">
				<form id="user_form">
					<div class="form-group">
						<label for="first_name">First Name</label>
						<input type="text" id="first_name" name="first_name" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="middle_name">Middle Name</label>
						<input type="text" id="middle_name" name="middle_name" class="form-control">
					</div>
					<div class="form-group">
						<label for="last_name">Last Name</label>
						<input type="text" id="last_name" name="last_name" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="mobile_number">Mobile Number</label>
						<input type="text" id="mobile_number" name="mobile_number" class="form-control" required>
					</div>
					<input type="hidden" name="action" value="save">
					<button type="button" id="save_button" class="btn btn-primary btn-block">Save</button>

					<div id="otp_section" style="display: none;">
						<div class="form-group">
							<label for="otp">Enter OTP</label>
							<input type="text" id="otp" name="otp" class="form-control" required>
						</div>
						<input type="hidden" name="surveyor_id" id="surveyor_id">
						<button type="button" id="verify_otp_button" class="btn btn-secondary btn-block">Verify
							OTP</button>
					</div>

					<div id="error_message" class="alert alert-danger" style="display: none;"></div>
				</form>
			</div>
			<div class="tab-pane fade section login-section" id="pills-login" role="tabpanel"
				aria-labelledby="pills-login-tab">
				<form id="login_form">
					<div class="form-group">
						<label for="login_mobile_number">Mobile Number</label>
						<input type="text" id="login_mobile_number" name="login_mobile_number" class="form-control"
							required>
					</div>
					<div class="form-group">
						<label for="login_password">Password</label>
						<input type="password" id="login_password" name="login_password" class="form-control" required>
					</div>
					<button type="button" id="login_button" class="btn btn-primary btn-block">Login</button>
				</form>
			</div>
		</div>
	</div>
	<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

	<script>
		$(document).ready(function () {
			$('#pills-tab button').on('click', function () {
				var target = $(this).data('bs-target');
				$('.section').removeClass('active');
				$(target).addClass('active show');
			});
			$('#save_button').on('click', function () {
				// check if first_name and mobile_number is not empty then show tostr message and return
				if ($('#first_name').val() === '' || $('#mobile_number').val() === '') {
					toastr.error('First Name and Mobile Number are required!');
					return;
				}
				$('input[name="action"]').val('save');
				ajaxFormSubmit('save');
			});

			$('#verify_otp_button').on('click', function () {
				$('input[name="action"]').val('verify_otp');
				ajaxFormSubmit('verify_otp');
			});

			function ajaxFormSubmit(action) {
				$.ajax({
					url: 'ajax2.php',
					type: 'POST',
					data: $('#user_form').serialize(),
					dataType: 'json',
					success: function (response) {
						if (response.status === 'error') {
							toastr.error(response.message);
							if (response.otp_active) {
								$('#otp_section').show();
								$('#surveyor_id').val(response.surveyor_id);
							}
						} else if (response.status === 'success') {
							toastr.success(response.message);
							$('#otp_section').show();
							$('#surveyor_id').val(response.surveyor_id);
						} else if (response.status === 'verified') {
							toastr.success(response.message);
							setTimeout(function () {
								window.location.href = 'index.php';
							}, 1500);
						}
					},
					error: function (jqXHR, textStatus, errorThrown) {
						toastr.error('An error occurred: ' + textStatus + ' - ' + errorThrown);
					}
				});
			}

		});
	</script>
</body>

</html>
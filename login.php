<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title>Surveyor Signup Page</title>
	<?php include('./header.php'); ?>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
	<style>
		body {
			background-color: #f8cbad;
			width: 100%;
			height: 100vh;
			display: flex;
			justify-content: center;
			align-items: center;
			min-height: 100vh;
		}

		.main-container {
			max-width: 800px;
			width: 100%;
			background: #fff;
			border-radius: 10px;
			box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
			background-color: #f8cbad;
			overflow: hidden;
			padding: 20px;
			transition: all 0.3s;
		}

		.card-header {
			text-align: center;
			font-size: 24px;
			font-weight: bold;
			color: #343a40;
			margin-bottom: 20px;
		}

		.nav-pills .nav-link {
			border-radius: 5px;
			transition: all 0.3s ease-in-out;
			border: 1px solid #007bff;
			color: #007bff;
			padding: 2px 10px;

			/* decrease font size 	 */
			font-size: 1.5rem;
		}

		.nav-pills .nav-link.active {
			background-color: #007bff;
			/* This is similar to btn-primary */
			color: white;
			/* This is similar to btn-primary */
			box-shadow: 0 4px 6px -1px rgba(0, 106, 194, 0.25), 0 2px 4px -1px rgba(0, 106, 194, 0.3);
		}


		.nav-pills .nav-link:not(.active):hover {
			background-color: #f8f9fa;
		}

		@media (max-width: 350px) {
			.nav-pills .nav-link {
				font-size: 1rem;
			}
		}

		@media (max-width: 500px) {

			.main-container {
				height: 100dvh;
				overflow-y: scroll;
				padding top: 5px;
				box-shadow: none;

			}
		}
	</style>
</head>

<body>

	<div class="main-container">
		<div class="card-header">
			Come and Join Our Survey Team
			<div style="margin-bottom: 20px;"></div>
			<ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
				<li class="nav-item" role="presentation" style="margin-right: 10px;">
					<button class="nav-link active" id="pills-signup-tab" data-bs-toggle="pill"
						data-bs-target="#pills-signup" type="button" role="tab" aria-controls="pills-signup"
						aria-selected="true">Signup</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="pills-login-tab" data-bs-toggle="pill" data-bs-target="#pills-login"
						type="button" role="tab" aria-controls="pills-login" aria-selected="false">Login</button>
				</li>
			</ul>
		</div>

		<div class="tab-content" id="pills-tabContent">
			<div class="tab-pane fade show active section signup-section" id="pills-signup" role="tabpanel"
				aria-labelledby="pills-signup-tab">
				<form id="user_form">
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
						<label for="mobile_number">Mobile Number (मोबाइल नंबर)</label>
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
								pattern="[0-9]{10}" oninput="validateInput(this)" maxlength="10">
						</div>
					</div>


					<div class="form-group">
						<label for="signup_password">Password (पासवर्ड)</label>
						<input type="password" id="signup_password" name="signup_password" class="form-control"
							required>
					</div>
					<input type="hidden" name="action" value="save">
					<button type="button" id="save_button" class="btn btn-primary btn-block">Save (सेव करें)</button>

					<div id="otp_section" style="display: none;">
						<div class="form-group">
							<label for="otp">Enter OTP (ओटीपी दर्ज करें)</label>
							<input type="text" id="otp" name="otp" class="form-control" required>
						</div>
						<input type="hidden" name="surveyor_id" id="surveyor_id">
						<button type="button" id="verify_otp_button" class="btn btn-secondary btn-block">Verify OTP
							(ओटीपी सत्यापित करें)</button>
					</div>

					<div id="error_message" class="alert alert-danger" style="display: none;"></div>
				</form>

			</div>
			<div class="tab-pane fade section login-section" id="pills-login" role="tabpanel"
				aria-labelledby="pills-login-tab">
				<form id="login_form">

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
								pattern="[0-9]{10}" oninput="validateInput(this)" maxlength="10" required>
						</div>
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
	<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

	<script>
		function isNumberKey(evt) {
			var charCode = (evt.which) ? evt.which : event.keyCode
			if (charCode > 31 && (charCode < 48 || charCode > 57))
				return false;
			return true;
		}
		function validateInput(input) {
			input.value = input.value.replace(/[^0-9]/g, '');
		}
		$('#login_form').submit(function (e) {
			e.preventDefault()
			start_load();
			$('#login-form button[type="button"]').attr('disabled', true).html('Logging in...');
			if ($(this).find('.alert-danger').length > 0)
				$(this).find('.alert-danger').remove();
			$.ajax({
				url: 'ajax.php?action=login',
				method: 'POST',
				data: $(this).serialize(),
				error: err => {
					console.log(err)
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

				},
				success: function (resp) {
					if (resp == 1) {
						end_load();
						location.href = 'index.php?page=home';
					} else {
						end_load();
						// $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
						// use toastr to show error message
						toastr.error('Username or password is incorrect.');

						$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
					}
				}
			})
		})
		$('.number').on('input', function () {
			var val = $(this).val()
			val = val.replace(/[^0-9 \,]/, '');
			$(this).val(val)
		})
		$(document).ready(function () {
			$('#pills-tab button').on('click', function () {
				var target = $(this).data('bs-target');
				$('.section').removeClass('active');
				$(target).addClass('active show');

				// Remove active class from all nav-links
				$('.nav-link').removeClass('active');
				// Add active class to the clicked nav-link
				$(this).addClass('active');
			});
			$('#save_button').on('click', function () {
				// check if first_name and mobile_number is not empty then show tostr message and return
				if ($('#first_name').val() === '') {
					toastr.error('First name is required!');
					return;
				}
				if ($('#mobile_number').val() === '') {
					toastr.error('Mobile number is required!');
					return;
				}
				if ($('#signup_password').val() === '') {
					toastr.error('Password is required!');
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
				start_load();
				$.ajax({
					url: 'ajax2.php',
					type: 'POST',
					data: $('#user_form').serialize(),
					dataType: 'json',
					success: function (response) {
						if (response.status === 'error') {
							end_load();
							toastr.error(response.message);
							if (response.otp_active) {
								$('#otp_section').show();
								$('#surveyor_id').val(response.surveyor_id);
							}
						} else if (response.status === 'success') {
							end_load();
							toastr.success(response.message);
							// hide the save button
							$('#save_button').hide();
							$('#otp_section').show();
							$('#surveyor_id').val(response.surveyor_id);
						} else if (response.status === 'verified') {
							end_load();
							toastr.success(response.message);
							setTimeout(function () {
								window.location.href = 'index.php';
							}, 1000);
						}
					},
					error: function (jqXHR, textStatus, errorThrown) {
						console.log(textStatus, errorThrown);
						end_load();
						if (textStatus === 'parsererror') {
							try {
								end_load();
								var responseText = jqXHR.responseText;
								if (responseText && responseText.startsWith('<')) {
									// This means the response is probably an HTML error page
									toastr.error('An error occurred: Invalid Response from Server');
									console.error('An error occurred: the response is not valid JSON: ', responseText);
								} else {

									toastr.error('An error occurred: ' + textStatus + ' - ' + errorThrown);
								}
							} catch (e) {

								toastr.error('An error occurred: Unknown Error');
								console.error('An unexpected error occurred:', e);
							}
						} else {

							toastr.error('An error occurred: ' + textStatus + ' - ' + errorThrown);
						}
					}

				});
			}

		});
	</script>
	<?php include 'footer.php' ?>
</body>

</html>
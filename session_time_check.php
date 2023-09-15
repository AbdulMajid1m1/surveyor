<?php
session_start();

// Set the session timeout to 20 minutes
$timeout = 1200;

// Check for timeout
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout)) {
    // Last request was more than 20 minutes ago
    session_unset(); // Unset session variables
    session_destroy(); // Destroy session
    header('Location: login.php'); // Redirect to login page
    exit();
}

// Update last activity time stamp
$_SESSION['LAST_ACTIVITY'] = time();
?>
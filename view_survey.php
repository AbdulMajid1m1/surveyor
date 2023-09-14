<?php include 'db_connect.php' ?>
<?php
include 'db_connect.php';
$mode = 'view';
if (isset($_GET['id'])) {
	$id = $_GET['id'];
}

include 'new_survey.php';
?>
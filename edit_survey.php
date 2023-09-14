<?php
include 'db_connect.php';
$mode = 'edit';
if (isset($_GET['id'])) {
	$id = $_GET['id'];
}

include 'new_survey.php';
?>
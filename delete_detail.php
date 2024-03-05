<?php
// delete_detail.php

// Assuming you have included dbconnect.php and necessary session handling


    include 'dbconnect.php';
    include 'server.php';

	if (!isset($_SESSION['cust_id'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
    }
    else{ //Continue to current page
        header( 'Content-Type: text/html; charset=utf-8' );
    }

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['cust_name']);
		header("location: login.php");
    }



if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Perform deletion of detail with $id from the database
    // Redirect back to the page where details are displayed
}
?>

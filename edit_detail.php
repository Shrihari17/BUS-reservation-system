<?php
// edit_detail.php

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
    // Fetch the detail from the database based on $id
    // Populate the form fields with the fetched data
    // Update the detail in the database on form submission
}
?>
<!-- Your HTML form for editing details -->

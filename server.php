
<?php
include 'dbconnect.php';

$errors = array();

// Check if the form is submitted
if (isset($_POST['confirm_booking'])) {
    // Retrieve form data
    $selected_route_id = mysqli_real_escape_string($db, $_POST['selected_route_id']);
    $selected_seat = mysqli_real_escape_string($db, $_POST['selected_seat']);
    $journey_date = mysqli_real_escape_string($db, $_POST['journey_date']);
    $booking_date = mysqli_real_escape_string($db, $_POST['booking_date']);
    $selected_no_of_seat = mysqli_real_escape_string($db, $_POST['selected_no_of_seat']);
    $route_rent = mysqli_real_escape_string($db, $_POST['route_rent']);
    $total_rent = mysqli_real_escape_string($db, $_POST['total_rent']);
    $customer_id = mysqli_real_escape_string($db, $_POST['customer_id']);
    $cust_fullname = mysqli_real_escape_string($db, $_POST['cust_fullname']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $address = mysqli_real_escape_string($db, $_POST['address']);
    $contact_no = mysqli_real_escape_string($db, $_POST['contact_no']);
    $payment_method = mysqli_real_escape_string($db, $_POST['payment_method']);
    $current_phone_no = mysqli_real_escape_string($db, $_POST['current_phone_no']);
    $bus_type = mysqli_real_escape_string($db, $_POST['bus_type']);

    // Validation code here (if needed)

    // Insert data into the payments table
    $query = "INSERT INTO payments (customer_id, owner_name, trans_type, total_rent, current_phone_no) 
              VALUES ('$customer_id', '$cust_fullname', '$payment_method', '$total_rent', '$current_phone_no')";

    if (mysqli_query($db, $query)) {
        // Payment entry successful
        // Proceed to insert into book_detail table
        $query1 = "INSERT INTO book_detail (route_id, journey_date, booking_date, rent, bus_type, choice, customer_id) 
                   VALUES ('$selected_route_id', '$journey_date', '$booking_date', '$route_rent', '$bus_type', '$selected_seat', '$customer_id')";

        if (mysqli_query($db, $query1)) {
            // Booking successful
            // Redirect to myticket.php or any other success page
            $_SESSION['booking_success'] = "Thank you for booking a seat";
            $_SESSION['booking_date'] = $booking_date;
            $_SESSION['selected_seat'] = $selected_seat;
            $_SESSION['total_rent'] = $total_rent;
            header("Location: myticket.php");
            exit();
        } else {
            // Handle error if book_detail insertion fails
            $errormsg = "Error inserting into book_detail: " . mysqli_error($db);
        }
    } else {
        // Handle error if payment insertion fails
        $errormsg = "Error inserting into payments: " . mysqli_error($db);
    }
}

// Your other code for registration and login goes here...
?>

<?
// Insert data into the bookings table
$query = "INSERT INTO bookings (route_id, seat_number, journey_date, booking_date, number_of_seats, route_rent, total_rent, customer_id, customer_name, email, address, contact_no, payment_method, current_phone_no, bus_type) 
          VALUES ('$selected_route_id', '$selected_seat', '$journey_date', '$booking_date', '$selected_no_of_seat', '$route_rent', '$total_rent', '$customer_id', '$customer_id', '$email', '$address', '$contact_no', '$payment_method', '$current_phone_no', '$bus_type')";

if (mysqli_query($db, $query)) {
    // Booking successful
    // Redirect to booking_success.php
    header("Location: booking_success.php");
    exit();
} else {
    // Handle error if insertion fails
    echo "Error: " . $query . "<br>" . mysqli_error($db);
}
?>













<?php
include 'dbconnect.php';

$errors = array();

// Check if the form is submitted
if (isset($_POST['confirm_booking'])) {
    // Retrieve form data
    $selected_route_id = mysqli_real_escape_string($db, $_POST['selected_route_id']);
    $selected_seat = mysqli_real_escape_string($db, $_POST['selected_seat']);
    $journey_date = mysqli_real_escape_string($db, $_POST['journey_date']);
    $booking_date = mysqli_real_escape_string($db, $_POST['booking_date']);
    $selected_no_of_seat = mysqli_real_escape_string($db, $_POST['selected_no_of_seat']);
    $route_rent = mysqli_real_escape_string($db, $_POST['route_rent']);
    $total_rent = mysqli_real_escape_string($db, $_POST['total_rent']);
    $customer_id = mysqli_real_escape_string($db, $_POST['customer_id']);
    $cust_fullname = mysqli_real_escape_string($db, $_POST['cust_fullname']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $address = mysqli_real_escape_string($db, $_POST['address']);
    $contact_no = mysqli_real_escape_string($db, $_POST['contact_no']);
    $payment_method = mysqli_real_escape_string($db, $_POST['payment_method']);
    $current_phone_no = mysqli_real_escape_string($db, $_POST['current_phone_no']);
    $bus_type = mysqli_real_escape_string($db, $_POST['bus_type']);

    // Validation code here (if needed)

    // Insert data into the payments table
    $query = "INSERT INTO payments (customer_id, owner_name, trans_type, total_rent, current_phone_no) 
              VALUES ('$customer_id', '$cust_fullname', '$payment_method', '$total_rent', '$current_phone_no')";

    if (mysqli_query($db, $query)) {
        // Payment entry successful
        // Proceed to insert into book_detail table
        $query1 = "INSERT INTO book_detail (route_id, journey_date, booking_date, rent, bus_type, choice, customer_id) 
                   VALUES ('$selected_route_id', '$journey_date', '$booking_date', '$route_rent', '$bus_type', '$selected_seat', '$customer_id')";

        if (mysqli_query($db, $query1)) {
            // Booking successful
            // Redirect to myticket.php or any other success page
            $_SESSION['booking_success'] = "Thank you for booking a seat";
            $_SESSION['booking_date'] = $booking_date;
            $_SESSION['selected_seat'] = $selected_seat;
            $_SESSION['total_rent'] = $total_rent;
            header("Location: myticket.php");
            exit();
        } else {
            // Handle error if book_detail insertion fails
            $errormsg = "Error inserting into book_detail: " . mysqli_error($db);
        }
    } else {
        // Handle error if payment insertion fails
        $errormsg = "Error inserting into payments: " . mysqli_error($db);
    }
}

// Your other code for registration and login goes here...

?>














<?php 
	session_start();

	// variable declaration
	$username = "";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		$confirm_password = mysqli_real_escape_string($db, $_POST['confirm_password']);
		$address = mysqli_real_escape_string($db, $_POST['address']);
		$city = mysqli_real_escape_string($db, $_POST['city']);
		$gender = mysqli_real_escape_string($db, $_POST['gender']);
		$contact_no = mysqli_real_escape_string($db, $_POST['contact_no']);


		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password)) { array_push($errors, "Password is required"); }

		if ($password != $confirm_password) {
			array_push($errors, "The two passwords do not match");
		}

		// first check the database to make sure 
		// a user does not already exist with the same username and/or email
		$user_check_query = "SELECT * FROM customer WHERE username='$username' OR email='$email' LIMIT 1";
		$result = mysqli_query($db, $user_check_query);
		$user = mysqli_fetch_assoc($result);
		
		if ($user) { // if user exists
			if ($user['username'] === $username) {
				array_push($errors, "Username already exists");
			}

			if ($user['email'] === $email) {
				array_push($errors, "email already exists");
			}
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password);//encrypt the password before saving in the database
			$query = "INSERT INTO customer (
				username,
				password,
				address,
				city,
				gender,
				contact_no,
				email
				) 
				VALUES(
					'$username',
					'$password',
					'$address',
					'$city',
					'$gender',
					'$contact_no',
					'$email'
				)";

			if(mysqli_query($db, $query)) {
				$_SESSION['reg_success'] = "Successfullly Register";
			}
			else{
				array_push($errors, "Error...!");
			} 

		}

	}

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($email)) {
			array_push($errors, "Email is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM customer WHERE email='$email' AND password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				if ($row = mysqli_fetch_array($results)) {
					$_SESSION['cust_id'] = $row['customer_id'];
					$_SESSION['cust_name'] = $row['username'];	
					$_SESSION['success'] = "You are now logged in";
					header('location: index.php');
				} 
			}else {
				array_push($errors, "Wrong email/password combination");
			}

		}
	}
/*	<?php echo $_SERVER['PHP_SELF']; ?>*/

	// index page When Search Buses is clicked 
	if (isset($_POST['searchBuses'])) {
		$journeyFrom = $_POST['journeyFrom'];
		$journeyTo = $_POST['journeyTo'];
		$dateOfJourney = $_POST['dateOfJourney'];

		if (empty($journeyFrom)) { 
			$error = true;
			array_push($errors, "journeyFrom is required"); 
		}
		if (empty($journeyTo)) { 
			$error = true;
			array_push($errors, "journeyTo is required"); 
		}
		if (empty($dateOfJourney)) { 
			$error = true;
			array_push($errors, "dateOfJourney is required"); 
		}

		if(!$error){
			$_SESSION['journeyFrom'] = $journeyFrom;
			$_SESSION['journeyTo'] = $journeyTo; 
			$_SESSION['dateOfJourney'] = $dateOfJourney; 

			echo date("Y-m-d");
			$book_date = date("Y-m-d");
			$_SESSION['book_date'] = $book_date; 

			
			$route_sql = "SELECT * from `route_detail`";
			$route_run = mysqli_query($db,$route_sql);
		
			if(!$route_run)
				die("Unable to run query".mysqli_error($db));
		
			$no_rows = mysqli_num_rows($route_run);
			if($no_rows>0){
				while($data = mysqli_fetch_assoc($route_run)){
		
					$departure_station = $data['departure_station'];
					$arrival_station = $data['arrival_station'];
		
					$journeyFrom = $_SESSION['journeyFrom'];
					$journeyTo = $_SESSION['journeyTo']; 
					$dateOfJourney = $_SESSION['dateOfJourney'];
		
					if(($journeyFrom == $departure_station) && ($journeyTo == $arrival_station)){
						$route_id = $data['route_id'];
						$_SESSION['selected_route_id'] = $route_id;
					}
				}
			}
			header("location: availablebus.php");
		}
	}

	// booking page When Insert is Clicked
	if (isset($_POST['insert_seat'])) {
		if(!empty($_POST['chooseSeat'])) {
			$chooseSeat = $_POST['chooseSeat'];
			$count = count($chooseSeat);
			$_SESSION['selected_no_of_seat'] = $count;

			$chooseSeat_array = implode(',', $_POST['chooseSeat']);
			$_SESSION['selected_seat'] = $chooseSeat_array;

			header("location: checkout.php");
		}
		else {
			$errormsg = "Please Choose the seat!";
		}
	}

	// checkout page
	if (isset($_POST['confirm_booking'])) {
		$customer_id = $_POST['customer_id'];
		$cust_fullname = $_POST['cust_fullname'];
		$trasn_type = $_POST['payment_method'];
		$total_rent = $_POST['total_rent'];
		
		$journey_date = $_POST['journey_date'];
		$booking_date = $_POST['booking_date'];
		$route_rent = $_POST['route_rent'];
		$selected_seat = $_POST['selected_seat'];
		$selected_route_id = $_POST['selected_route_id'];
		$bus_type = $_POST['bus_type'];
		$current_phone_no = $_POST['current_phone_no'];

		if (empty($customer_id)) { 
			$error = true;
			array_push($errors, "customer_id is required"); 
		}
		if (empty($cust_fullname)) { 
			$error = true;
			array_push($errors, "cust_fullname is required"); 
		}
		if (empty($trasn_type)) { 
			$error = true;
			array_push($errors, "trasn_type is required"); 
		}
		if (empty($total_rent)) { 
			$error = true;
			array_push($errors, "total_rent is required"); 
		}
		if (empty($current_phone_no)) { 
			$error = true;
			array_push($errors, "current_phone_no is required"); 
		}
		if (count($errors) == 0) {
			$query = "INSERT INTO `payment` (
				`customer_id`, 
				`owner_name`, 
				`trans_type`, 
				`total_rent`, 
				`current_phone_no`
				) 
				VALUES(
					'$customer_id',
					'$cust_fullname',
					'$trasn_type',
					'$total_rent',
					'$current_phone_no'
				)";

			$run = mysqli_query($db,$query);

			if($run) {
				$query1 = "INSERT INTO `book_detail` (
					route_id,
					journey_date,
					booking_date,
					rent,
					bus_type,
					choice,
					customer_id
                    ) 
                    VALUES(
                        '$selected_route_id',
						'$journey_date',
						'$booking_date',
						'$route_rent',
						'$bus_type',
						'$selected_seat',
						'$customer_id'
                    )";
                if(mysqli_query($db, $query1)){
					$_SESSION['booking_success'] = "Thank you for booking seat";
					$_SESSION['booking_date'] = $booking_date;
					$_SESSION['selected_seat'] = $selected_seat;
					$_SESSION['total_rent'] = $total_rent;
					header("location: myticket.php");
                }
                else{
                    $errormsg = "Error...!".mysqli_error($db);
                }
			}
			else{
				array_push($errors, "Error...!");
			} 
		}
	}
	


?>
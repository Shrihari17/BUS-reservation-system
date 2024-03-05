
















<?php
    include 'dbconnect.php';
    include 'server.php';


    if (!isset($_SESSION['cust_id']))
    {
        header("location: ../index.php");
    }
    else{ //Continue to current page
        header( 'Content-Type: text/html; charset=utf-8' );
    }

?>
<!DOCTYPE html>
<html dir="">

<head>
    <title>Bus Reservation System</title>
    <meta charset="utf-8">
    <meta name="fragment" content="!">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="assets/css/index.css" type="text/css" rel="stylesheet" />
    <link href="assets/css/seat.css" type="text/css" rel="stylesheet" />

    <style>
        form label {
            width: 140px;
        }
    </style>

</head>

<body>
    <div id="pagewrapper">
        <div id="topbg"></div>
        <div id="systemName">
            <h1>Bus Booking</h1>
        </div>
        <div id="header">
            <div id="mainmenu">
                <header>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="timetable.php">Time Table</a></li>
                        <?php  if (!isset($_SESSION['cust_name'])) {?>
                            <li><a href="login.php">Login</a></li>
                        <?php }?>
                        <?php  if (isset($_SESSION['cust_name'])) {?>
                            <li> <a href="index.php?logout='1'">Logout</a> </li>
                        <?php }?>
                    </ul>
                </header>
            </div>
        </div>
        <div></div>
        <div></div>
        <div></div>

        <div id="content">
            <h1>Checkout</h1>
            <div class="busdataarea">
                <div class="buswrapper">
                    <label>
                        <b>Booking Date : </b>
                    </label>
                    <label>
                        <?php
                            echo ($dateOfJourney = $_SESSION['dateOfJourney']);
                        ?>
                    </label>
                </div>
                <!-- <div class="buswrapper">
                    <label>
                        <b>Bus Number : </b>
                    </label>
                    <label>
                        <?php
                            echo ('...');
                        ?>
                    </label>
                </div> -->
                <div class="buswrapper">
                    <label>
                        <b>From : </b>
                    </label>
                    <label>
                        <?php
                            echo ($journeyFrom = $_SESSION['journeyFrom']);
                        ?>
                    </label>
                </div>
                <div class="buswrapper">
                    <label>
                        <b>To : </b>
                    </label>
                    <label>
                        <?php
                            echo ($journeyTo = $_SESSION['journeyTo']);
                        ?>
                    </label>
                </div>
                <div class="buswrapper">
                    <label>
                        <b>Seat No. : </b>
                    </label>
                    <label>
                        <?php
                            echo ($selected_seat = $_SESSION['selected_seat']);
                        ?>
                    </label>
                </div>
                <div class="buswrapper">
                    <label>
                        <b>No. of Seat : </b>
                    </label>
                    <label>
                        <?php
                            echo ($selected_no_of_seat = $_SESSION['selected_no_of_seat']);
                        ?>
                    </label>
                </div>
                <div class="buswrapper">
                    <label>
                        <b>Total Amount : </b>
                    </label>
                    <label>
                        <?php
                        $route_rent = $_SESSION['route_rent'];

                        $total_rent = $route_rent * $selected_no_of_seat;
                            echo "$selected_no_of_seat*$route_rent = Rs $total_rent";
                        ?>
                    </label>
                </div>
            </div>
                
            <div id="passenger_info_m">
                <h3 style="margin-bottom:10px; margin-top:10px">Passenger Information form</h3>
                <div id="passenger_info">
                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <?php include('errors.php'); 

                        $selected_route_id = $_SESSION['selected_route_id'];
                        ?>

                        <input name="selected_route_id" value="<?php echo $selected_route_id;?>" type="hidden">

                        <input name="selected_seat" value="<?php echo $selected_seat;?>" type="hidden">
                        <input name="journey_date" value="<?php echo $dateOfJourney;?>" type="hidden">
                        <input name="booking_date" type="hidden" value="<?php echo $_SESSION['book_date'] ?>">
                        <input name="selected_no_of_seat" value="<?php echo $selected_no_of_seat;?>" type="hidden">
                        <input name="route_rent" value="<?php echo $route_rent;?>" type="hidden">
                        <input name="total_rent" value="<?php echo $total_rent;?>" type="hidden">


                        <?php

                            $query = "SELECT * FROM customer";
                            $results = mysqli_query($db, $query);
                            
                            if ($row = mysqli_fetch_array($results)) {
                                $cust_email = $row['email'];
                                $cust_address = $row['address'];
                                $cust_contact_no = $row['contact_no'];
                            }
                        ?>

                        <input type="hidden" name="customer_id" value="<?php echo $_SESSION['cust_id'];?>">

                        <div class="input-group">
                            <label>Your Full Name</label>
                            <input type="text" name="cust_fullname" required>
                        </div>

                        <input type="hidden" name="email" value="<?php echo $cust_email?>"/>
                        <input type="hidden" name="address" value="<?php echo $cust_address?>"/>
                        <input type="hidden" name="contact_no" value="<?php echo $cust_contact_no?>" />

                        <div class="input-group">
                            <label>Payment method</label>
                            <select name="payment_method">
                                <option value="cash" selected>Cash</option>
                                <option value="creditcard" disabled="disabled">Credit card</option>
                                <option value="paypal" disabled="disabled">Paypal</option>
                            </select>
                        </div>

                        <div class="input-group">
                            <label>Current Phone No</label>
                            <input type="text" name="current_phone_no" required>
                        </div>
                        <div class="input-group">
                            <label>Bus Type</label>
                                <select class="select" name="bus_type">
                                        <?php
                                            $sql = "SELECT * from `bus_detail`";
                                            $run = mysqli_query($db,$sql);

                                            if(!$run)
                                                die("Unable to run query".mysqli_error($db));

                                            $rows = mysqli_num_rows($run);

                                            if($rows>0){
                                                while($data = mysqli_fetch_object($run)){
                                                            echo '<option value="' . $data -> bus_type . '">' . $data -> bus_type . '</option>';
                                                }
                                            }
                                            else{
                                                    echo "No data found <br/>";
                                                }
                                        ?>

                                </select>
                        </div>

                        <div class="input-group">
                            <input type="submit" name="confirm_booking" value="Confirm" />
                        </div>
                        <div style="margin-top: 10px;"> 
                        <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
                    </div>
                                                
                    </form>
                </div>
            </div>
                
        </div>
        
        <!--#contentwrapper-->
        <div class="clear"></div>
        
        <div id="footer">
            Copyright © 2018.<br> All Rights Reserved.
        </div>
    </div>
</body>

</html>


server 

<?php
include 'dbconnect.php';
include 'server.php';

if (!isset($_SESSION['cust_id'])) {
    header("location: ../index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selected_route_id = isset($_POST['selected_route_id']) ? $_POST['selected_route_id'] : '';
    $selected_seat = isset($_POST['selected_seat']) ? $_POST['selected_seat'] : '';
    $journey_date = isset($_POST['journey_date']) ? $_POST['journey_date'] : '';
    $booking_date = isset($_POST['booking_date']) ? $_POST['booking_date'] : '';
    $selected_no_of_seat = isset($_POST['selected_no_of_seat']) ? $_POST['selected_no_of_seat'] : '';
    $route_rent = isset($_POST['route_rent']) ? $_POST['route_rent'] : '';
    $total_rent = isset($_POST['total_rent']) ? $_POST['total_rent'] : '';
    $customer_id = isset($_POST['customer_id']) ? $_POST['customer_id'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $contact_no = isset($_POST['contact_no']) ? $_POST['contact_no'] : '';
    $payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';
    $current_phone_no = isset($_POST['current_phone_no']) ? $_POST['current_phone_no'] : '';
    $bus_type = isset($_POST['bus_type']) ? $_POST['bus_type'] : '';

    // Validate and sanitize form inputs
    // You should customize this according to your requirements
    $customer_id = mysqli_real_escape_string($db, $customer_id);
    $email = mysqli_real_escape_string($db, $email);
    $address = mysqli_real_escape_string($db, $address);
    $contact_no = mysqli_real_escape_string($db, $contact_no);
    $payment_method = mysqli_real_escape_string($db, $payment_method);
    $current_phone_no = mysqli_real_escape_string($db, $current_phone_no);
    $bus_type = mysqli_real_escape_string($db, $bus_type);

    // Insert data into the bookings table
    $query = "INSERT INTO bookings (route_id, seat_number, journey_date, booking_date, number_of_seats, route_rent, total_rent, customer_id, customer_name, email, address, contact_no, payment_method, current_phone_no, bus_type) 
              VALUES ('$selected_route_id', '$selected_seat', '$journey_date', '$booking_date', '$selected_no_of_seat', '$route_rent', '$total_rent', '$customer_id', '$customer_id', '$email', '$address', '$contact_no', '$payment_method', '$current_phone_no', '$bus_type')";

    if (mysqli_query($db, $query)) {
        // Booking successful
        // Redirect to a success page
        header("Location: booking_success.php");
        exit();
    } else {
        // Handle error if insertion fails
        echo "Error: " . $query . "<br>" . mysqli_error($db);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bus Reservation System - Checkout</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/index.css" type="text/css" rel="stylesheet" />
    <link href="assets/css/seat.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <div id="pagewrapper">
        <!-- Your HTML content for the checkout page -->
        <!-- Include the form for passenger information -->
        <div id="content">
            <h1>Checkout</h1>
            <!-- Form for passenger information -->
            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <!-- Input fields for passenger information -->
                <!-- Your existing code for form inputs -->
                <!-- Make sure to keep the existing hidden input fields -->
                
                <!-- Example: -->
                <input type="hidden" name="selected_route_id" value="<?php echo $_SESSION['selected_route_id']; ?>">
                <input type="hidden" name="selected_seat" value="<?php echo $_SESSION['selected_seat']; ?>">
                <input type="hidden" name="journey_date" value="<?php echo $_SESSION['dateOfJourney']; ?>">
                <input type="hidden" name="booking_date" value="<?php echo $_SESSION['book_date']; ?>">
                <input type="hidden" name="selected_no_of_seat" value="<?php echo $_SESSION['selected_no_of_seat']; ?>">
                <input type="hidden" name="route_rent" value="<?php echo $_SESSION['route_rent']; ?>">
                <input type="hidden" name="total_rent" value="<?php echo $_SESSION['route_rent'] * $_SESSION['selected_no_of_seat']; ?>">
                <input type="hidden" name="customer_id" value="<?php echo $_SESSION['cust_id']; ?>">
                
                <!-- Add more input fields as needed -->
                
                <div class="input-group">
                    <label>Your Full Name</label>
                    <input type="text" name="cust_fullname" required>
                </div>
                <div class="input-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>
                <div class="input-group">
                    <label>Address</label>
                    <input type="text" name="address" required>
                </div>
                <div class="input-group">
                    <label>Contact Number</label>
                    <input type="text" name="contact_no" required>
                </div>
                <div class="input-group">
                    <label>Payment method</label>
                    <select name="payment_method">
                        <option value="cash" selected>Cash</option>
                        <option value="creditcard">Credit card</option>
                        <option value="paypal">Paypal</option>
                    </select>
                </div>
                <div class="input-group">
                    <label>Current Phone No</label>
                    <input type="text" name="current_phone_no" required>
                </div>
                <div class="input-group">
                    <label>Bus Type</label>
                    <select class="select" name="bus_type">
                        <?php
                        $sql = "SELECT * FROM `bus_detail`";
                        $run = mysqli_query($db, $sql);
                        if (!$run) {
                            die("Unable to run query: " . mysqli_error($db));
                        }
                        while ($data = mysqli_fetch_object($run)) {
                            echo '<option value="' . $data->bus_type . '">' . $data->bus_type . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="input-group">
                    <input type="submit" name="confirm_booking" value="Confirm" />
                </div>
            </form>
        </div>
    </div>
</body>
</html>



login



<?php
    include 'dbconnect.php';
    include 'server.php';  

    if (isset($_SESSION['cust_name']))
    {
        header("location: index.php");
    }
    else{ //Continue to current page
        header( 'Content-Type: text/html; charset=utf-8' );
    }
?>

<!DOCTYPE html>
<html lang="en" class="js csstransitions">

<head>
    <title>Bus Ticket Reservation System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/normalize.css" />
    <link href="assets/css/index.css" type="text/css" rel="stylesheet" />
    <link href="assets/css/normalize.css" type="text/css" rel="stylesheet" />
</head>

<body>
    <div id="pagewrapper">
        <div id="topbg"></div>
        <div id="systemName">
            <h1>Bus Booking</h1>
        </div>
        <div id="header">
            <div id="mainmenu">
                <header>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="timetable.php">Time Table</a></li>
                        <!-- <li><a href="login.php">Login</a></li> -->
                        <li><a href="register.php">Register</a></li>
                    </ul>
                </header>
            </div>
        </div>
        <div id="content">
            <div class="abc">
                <?php
                    if (!isset($_SESSION['cust_id']))
                    {
                        echo "<h2>You Must Login To Book Ticket or </br><a href='timetable.php'>Click Here</a> to view available route.</h2>";
                    }
                ?>

                <div id="signin">
                    <h1>Sign-In</h1>
                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform" class="signin-form">
                        <span class="text-danger">
                            <?php include('errors.php'); ?>
                        </span>
                        
                        <div class="input-group">
                            <label>Email</label>
                            <input type="email" name="email" >
                        </div>
                        <div class="input-group">
                            <label>Password</label>
                            <input type="password" name="password">
                        </div>
                        <div class="input-group">
                            <button type="submit" class="btn" name="login_user">Login</button>
                        </div>
                        <p>
                            Not yet a member? <a href="register.php">Sign up</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>

        <!--#contentwrapper-->
        <div class="clear"></div>
        <div id="footer">
            Copyright © OBTRS 2018.<br> All Rights Reserved.
        </div>
    </div>



</body>
</html>
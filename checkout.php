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



<?php
include 'dbconnect.php';

$errors = array();
$errormsg = "";
// Check if the form is submitted
if (isset($_POST['confirm_booking'])) {
    // Retrieve form data
    $route_id = mysqli_real_escape_string($db, $_POST['selected_route_id']);
    $seat_number = mysqli_real_escape_string($db, $_POST['selected_seat']);
    $journey_date = mysqli_real_escape_string($db, $_POST['journey_date']);
    $booking_date = mysqli_real_escape_string($db, $_POST['booking_date']);
    $number_of_seats = mysqli_real_escape_string($db, $_POST['selected_no_of_seat']);
    $route_rent = mysqli_real_escape_string($db, $_POST['route_rent']);
    $total_rent = mysqli_real_escape_string($db, $_POST['total_rent']);
    $customer_id = mysqli_real_escape_string($db, $_POST['customer_id']);
    $customer_name = mysqli_real_escape_string($db, $_POST['cust_fullname']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $address = mysqli_real_escape_string($db, $_POST['address']);
    $contact_no = mysqli_real_escape_string($db, $_POST['contact_no']);
    $payment_method = mysqli_real_escape_string($db, $_POST['payment_method']);
    $current_phone_no = mysqli_real_escape_string($db, $_POST['current_phone_no']);
    $bus_type = mysqli_real_escape_string($db, $_POST['bus_type']);

    // Validation code here (if needed)

    // Insert data into the bookings table
    $query = "INSERT INTO bookings (route_id, seat_number, journey_date, booking_date, number_of_seats, route_rent, total_rent, customer_id, customer_name, email, address, contact_no, payment_method, current_phone_no, bus_type) 
              VALUES ('$route_id', '$seat_number', '$journey_date', '$booking_date', '$number_of_seats', '$route_rent', '$total_rent', '$customer_id', '$customer_name', '$email', '$address', '$contact_no', '$payment_method', '$current_phone_no', '$bus_type')";

    if (mysqli_query($db, $query)) {
        // Booking successful
        // Redirect to a success page
        $_SESSION['booking_success'] = "Thank you for booking a seat";
        $_SESSION['booking_date'] = $booking_date;
        $_SESSION['selected_seat'] = $seat_number;
        $_SESSION['total_rent'] = $total_rent;
        header("Location: booking_success.php");
        exit();
    } else {
        // Handle error if insertion fails
        $errormsg = "Error: " . $query . "<br>" . mysqli_error($db);
    }
}

// Your other PHP code...

?>

<!-- Your HTML code -->


<?php echo $errormsg;?>

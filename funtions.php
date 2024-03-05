<?php
include 'dbconnect.php';

// Function to edit booking details
function editBooking($id)
{
    global $db;

    $query = "SELECT * FROM bookings WHERE id = $id";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    } else {
        return null;
    }
}

// Function to update booking details
function updateBooking($id, $data)
{
    global $db;

    $route_id = $data['route_id'];
    $seat_number = $data['seat_number'];
    $journey_date = $data['journey_date'];
    $booking_date = $data['booking_date'];
    $number_of_seats = $data['number_of_seats'];
    $route_rent = $data['route_rent'];
    $total_rent = $data['total_rent'];
    $customer_id = $data['customer_id'];
    $customer_name = $data['customer_name'];
    $email = $data['email'];
    $address = $data['address'];
    $contact_no = $data['contact_no'];
    $payment_method = $data['payment_method'];
    $current_phone_no = $data['current_phone_no'];
    $bus_type = $data['bus_type'];

    $query = "UPDATE bookings SET 
                route_id = '$route_id',
                seat_number = '$seat_number',
                journey_date = '$journey_date',
                booking_date = '$booking_date',
                number_of_seats = '$number_of_seats',
                route_rent = '$route_rent',
                total_rent = '$total_rent',
                customer_id = '$customer_id',
                customer_name = '$customer_name',
                email = '$email',
                address = '$address',
                contact_no = '$contact_no',
                payment_method = '$payment_method',
                current_phone_no = '$current_phone_no',
                bus_type = '$bus_type'
              WHERE id = $id";

    mysqli_query($db, $query);
}

// Function to delete a booking
function deleteBooking($id)
{
    global $db;

    $query = "DELETE FROM bookings WHERE id = $id";
    mysqli_query($db, $query);
}
?>

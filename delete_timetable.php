<?php
    // Include database connection and session start
    include 'dbconnect.php';
    include 'server.php';

    // Check if the form was submitted and the 'route_id' is set
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['route_id'])) {
        // Get the route_id from the form
        $route_id = $_POST['route_id'];

        // Query to get the details of the timetable entry with the given route_id
        $query = "SELECT * FROM `time_table` WHERE `route_id` = $route_id";

        // Execute the query
        $result = mysqli_query($db, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch the timetable entry data
            $data = mysqli_fetch_assoc($result);

            // Free the result set
            mysqli_free_result($result);
        } else {
            // Timetable entry not found
            echo "Timetable entry not found.";
            exit();
        }
    } else {
        // Redirect to an error page or display an error message
        echo "Invalid request.";
        exit();
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Timetable Entry</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
    <h1>Delete Timetable Entry</h1>
    <form method="post" action="update_timetable.php">
        <input type="hidden" name="route_id" value="<?php echo $route_id; ?>">
        <div>
            <label for="departure_station">Departure Station:</label>
            <input type="text" id="departure_station" name="departure_station" value="<?php echo $data['departure_station']; ?>" readonly>
        </div>
        <div>
            <label for="arrival_station">Arrival Station:</label>
            <input type="text" id="arrival_station" name="arrival_station" value="<?php echo $data['arrival_station']; ?>" readonly>
        </div>
        <div>
            <label for="via_station">Via Station:</label>
            <input type="text" id="via_station" name="via_station" value="<?php echo $data['via_station']; ?>" readonly>
        </div>
        <div>
            <label for="departure_time">Departure Time:</label>
            <input type="text" id="departure_time" name="departure_time" value="<?php echo $data['departure_time']; ?>" readonly>
        </div>
        <div>
            <label for="arrival_time">Arrival Time:</label>
            <input type="text" id="arrival_time" name="arrival_time" value="<?php echo $data['arrival_time']; ?>" readonly>
        </div>
        <div>
            <label for="fare">Fare:</label>
            <input type="text" id="fare" name="fare" value="<?php echo $data['fare']; ?>" readonly>
        </div>
        <input type="submit" name="delete" value="Delete">
    </form>
</body>
</html>


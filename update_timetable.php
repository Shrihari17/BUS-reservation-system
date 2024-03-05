<?php
    // Include database connection and session start
    include 'dbconnect.php';
    include 'server.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
        // Get form data
        $route_id = mysqli_real_escape_string($db, $_POST['id']);
        $departure_station = mysqli_real_escape_string($db, $_POST['departure_station']);
        $arrival_station = mysqli_real_escape_string($db, $_POST['arrival_station']);
        $via_station = mysqli_real_escape_string($db, $_POST['via_station']);
        $departure_time = mysqli_real_escape_string($db, $_POST['departure_time']);
        $arrival_time = mysqli_real_escape_string($db, $_POST['arrival_time']);
        $rent = mysqli_real_escape_string($db, $_POST['rent']);

        // Update query
        $query = "UPDATE `time_table` SET 
                    `departure_station` = '$departure_station', 
                    `arrival_station` = '$arrival_station', 
                    `via_station` = '$via_station', 
                    `departure_time` = '$departure_time', 
                    `arrival_time` = '$arrival_time', 
                    `rent` = '$rent' 
                    WHERE `route_id` = '$route_id'";

        if (mysqli_query($db, $query)) {
            // Update successful
            header("Location: timetable.php");
            exit();
        } else {
            // Handle error if update fails
            echo "Error updating record: " . mysqli_error($db);
        }
    } else {
        echo "Invalid request.";
    }
?>

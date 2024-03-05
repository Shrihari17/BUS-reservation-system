<?php
    // Include database connection and session start
    include 'dbconnect.php';
    include 'server.php';

    // Check if ID is provided in the URL
    if(isset($_GET['id'])) {
        $id = mysqli_real_escape_string($db, $_GET['id']);

        // Fetch the timetable entry from the database
        $query = "SELECT * FROM `time_table` WHERE `route_id` = '$id'";
        $result = mysqli_query($db, $query);

        if(mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            // Display the form with the data for editing
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Timetable Entry</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        h1 {
            margin-top: 0;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="time"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Edit Timetable Entry</h1>
    <form method="post" action="update_timetable.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="departure_station">Departure Station:</label>
        <input type="text" name="departure_station" id="departure_station" value="<?php echo $row['departure_station']; ?>" required><br><br>

        <label for="arrival_station">Arrival Station:</label>
        <input type="text" name="arrival_station" id="arrival_station" value="<?php echo $row['arrival_station']; ?>" required><br><br>

        <label for="via_station">Via Station:</label>
        <input type="text" name="via_station" id="via_station" value="<?php echo $row['via_station']; ?>"><br><br>

        <label for="departure_time">Departure Time:</label>
        <input type="time" name="departure_time" id="departure_time" value="<?php echo $row['departure_time']; ?>" required><br><br>

        <label for="arrival_time">Arrival Time:</label>
        <input type="time" name="arrival_time" id="arrival_time" value="<?php echo $row['arrival_time']; ?>" required><br><br>

        <label for="rent">Fare:</label>
        <input type="text" name="rent" id="rent" value="<?php echo $row['rent']; ?>" required><br><br>

        <input type="submit" value="Update">
    </form>
</body>
</html>
<?php
        } else {
            echo "Timetable entry not found.";
        }
    } else {
        echo "ID not provided.";
    }
?>

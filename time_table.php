<?php
    // Include database connection and session start
    include 'dbconnect.php';
    include 'server.php';

    // Redirect to index.php if user is not logged in
    if (!isset($_SESSION['cust_name'])) {
        header("location: index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bus Ticket Reservation System - Time Table</title>
    <style>
        /* Basic table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <h1>Bus Ticket Reservation System - Time Table</h1>
    
    <div>
        <h2>Time Table</h2>
        <table>
            <thead>
                <tr>
                    <th>From</th>
                    <th>To</th>
                    <th>Via Station</th>
                    <th>Departure Time</th>
                    <th>Arrival Time</th>
                    <th>Fare</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Select data from the time_table table
                    $sql = "SELECT * FROM `time_table`";
                    $result = mysqli_query($db, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        // Output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['departure_station'] . "</td>";
                            echo "<td>" . $row['arrival_station'] . "</td>";
                            echo "<td>" . $row['via_station'] . "</td>";
                            echo "<td>" . date('h:i A', strtotime($row['departure_time'])) . "</td>";
                            echo "<td>" . date('h:i A', strtotime($row['arrival_time'])) . "</td>";
                            echo "<td>$" . $row['rent'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'> No data found </td></tr>";
                    }

                    // Free result set
                    mysqli_free_result($result);

                    // Close connection
                    mysqli_close($db);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

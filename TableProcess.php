<?php include 'connect.php'; ?>
<script src="script.js"></script>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Table Process</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;700&display=swap" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    </head>
    <?php
    //include 'connect.php';
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_GET['tableNo']) && isset($_POST['startTime']) && isset($_POST['endTime'])) {
            $tableNo = $_GET['tableNo'];
            $startTime = $_POST['startTime'];
            $endTime = $_POST['endTime'];

            // Get user ID from session
            if (isset($_SESSION['user_id'])) {
                $userID = $_SESSION['user_id'];

                // Insert into TableReservation table
                $insertQuery = "INSERT INTO TableReservation (U_ID, TableNo, ReservationDate, EndDate) VALUES (?, ?, ?, ?)";
                $stmt = $mysqli->prepare($insertQuery);

                if ($stmt) {
                    // Assuming ReservationDate corresponds to $startTime
                    $reservationDate = date('Y-m-d') . ' ' . $startTime;

                    // Combining date and time for end time
                    $endDate = date('Y-m-d') . ' ' . $endTime;

                    $stmt->bind_param("iiss", $userID, $tableNo, $reservationDate, $endDate);
                    $stmt->execute();

                    if ($stmt->affected_rows > 0) {
                        echo "Reservation successful!";
                        header('Location: TableReserve.php');
                        
                    } else {
                        echo "Reservation failed.";
                    }

                    $stmt->close();
                } else {
                    echo "Error: Unable to prepare SQL statement.";
                }
            } else {
                echo "User ID not found in session.";
            }
        } else {
            echo "Incomplete data provided.";
        }
    }
    ?>

    <body class="center">
        <div class="headbar">
            <img src="pictures\CSS326BasedLib.png" alt="Logo">
            <div class="greet-text">
                <p>Table Reservation</p><br>
            </div>
        </div>
        <form action="" class="manage-panel process-items center" method="post">
            <div class="row">
                <div class="column">
                    <h2>Reserve this Table from</h2>
                    <input type="time" id="startTime" name="startTime">
                    <h2>to</h2>
                    <input type="time" id="endTime" name="endTime" required>
                </div>
            </div>
            <div class="row center" style="padding: 0 0 0 0; justify-content: space-evenly;">
                <input type="submit" value="Confirm" class="conBT" id="submit-button">
                <input type="button" value="Cancel" class="canBT" id="submit-button" onclick="gotoPage('TableReserve.php')">
            </div>
        </form>

    </body>
</html>
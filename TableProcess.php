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
                            $_SESSION['popMessage'] = "Reservation successfully added.";
                            echo '<div style="display: flex; background-color: #4CA82C;" class="popError center column" id="popup">' .
                                '<h2>' . $_SESSION['popMessage'] . '</h2>' .
                                '<input type="button" value="Close" onclick="gotoPage(\'TableReserve.php\')">' . '</div>' .
                                '<div style="display: flex; margin: -20vw;" class="overlay" id="overlay"></div>';
                            
                        } else {
                            $_SESSION['popMessage'] = "Failed to add reservation.";
                            echo '<div style="display: flex; background-color: #E46060;" class="popError center column" id="popup">' .
                                '<h2>' . $_SESSION['popMessage'] . '</h2>' .
                                '<input type="button" value="Close" onclick="gotoPage(\'TableProcess.php\')">' . '</div>' .
                                '<div style="display: flex; margin: -20vw;" class="overlay" id="overlay"></div>';
                            unset($SESSION['popMessage']);
                        }

                        $stmt->close();
                    } else {
                        $_SESSION['popMessage'] = "Error: Unable to prepare SQL statement.";
                        echo '<div style="display: flex; background-color: #E46060;" class="popError center column" id="popup">' .
                            '<h2>' . $_SESSION['popMessage'] . '</h2>' .
                            '<input type="button" value="Close" onclick="gotoPage(\'TableProcess.php\')">' . '</div>' .
                            '<div style="display: flex; margin: -20vw;" class="overlay" id="overlay"></div>';
                        unset($SESSION['popMessage']);
                    }
                } else {
                    $_SESSION['popMessage'] = "User ID not found in Session.";
                    echo '<div style="display: flex; background-color: #E46060;" class="popError center column" id="popup">' .
                        '<h2>' . $_SESSION['popMessage'] . '</h2>' .
                        '<input type="button" value="Close" onclick="gotoPage(\'TableProcess.php\')">' . '</div>' .
                        '<div style="display: flex; margin: -20vw;" class="overlay" id="overlay"></div>';
                    unset($SESSION['popMessage']);
                }
            } else {
                $_SESSION['popMessage'] = "Incomplete Data provided.";
                echo '<div style="display: flex; background-color: #E46060;" class="popError center column" id="popup">' .
                    '<h2>' . $_SESSION['popMessage'] . '</h2>' .
                    '<input type="button" value="Close" onclick="gotoPage(\'TableProcess.php\')">' . '</div>' .
                    '<div style="display: flex; margin: -20vw;" class="overlay" id="overlay"></div>';
                unset($SESSION['popMessage']);
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
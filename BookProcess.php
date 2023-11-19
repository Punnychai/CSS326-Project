<?php include 'connect.php'; ?>
<script src="script.js"></script>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Book Process</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;700&display=swap" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    </head>

    <?php
        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if both 'user_id' session variable and 'id' from URL parameters exist
            if (isset($_SESSION['user_id']) && isset($_GET['id'])) {
                $userID = $_SESSION['user_id'];
                $bookID = $_GET['id'];

                // Retrieve form inputs for BorrowDate and ReturnDate
                $borrowDate = $_POST['borrow'];
                $returnDate = $_POST['return'];

                // Prepare and execute the SQL INSERT query
                $insertQuery = "INSERT INTO bookreservation (U_ID, B_ID, BorrowDate, ReturnDate) VALUES (?, ?, ?, ?)";
                $stmt = $mysqli->prepare($insertQuery);

                if ($stmt) {
                    $stmt->bind_param("iiss", $userID, $bookID, $borrowDate, $returnDate);
                    $stmt->execute();

                    // Check if the query was successful
                    if ($stmt->affected_rows > 0) {
                        // Successful insertion
                        $_SESSION['popMessage'] = "Reservation successfully added.";
                        echo '<div style="display: flex; background-color: #4CA82C;" class="popError center column" id="popup">' .
                            '<h2>' . $_SESSION['popMessage'] . '</h2>' .
                            '<input type="button" value="Close" onclick="gotoPage(\'BookReserve.php\')">' . '</div>' .
                            '<div style="display: flex; margin: -20vw;" class="overlay" id="overlay"></div>';
                    } else {
                        // Failed to insert
                        $_SESSION['popMessage'] = "Failed to add reservation.";
                        echo '<div style="display: flex; background-color: #E46060;" class="popError center column" id="popup">' .
                            '<h2>' . $_SESSION['popMessage'] . '</h2>' .
                            '<input type="button" value="Close" onclick="gotoPage(\'BookProcess.php\')">' . '</div>' .
                            '<div style="display: flex; margin: -20vw;" class="overlay" id="overlay"></div>';
                        unset($SESSION['popMessage']);
                    }

                    $stmt->close();
                } else {
                    // Error in preparing the statement
                    $_SESSION['popMessage'] = "Error: Unable to prepare SQL statement.";
                    echo '<div style="display: flex; background-color: #E46060;" class="popError center column" id="popup">' .
                        '<h2>' . $_SESSION['popMessage'] . '</h2>' .
                        '<input type="button" value="Close" onclick="gotoPage(\'BookProcess.php\')">' . '</div>' .
                        '<div style="display: flex; margin: -20vw;" class="overlay" id="overlay"></div>';
                    unset($SESSION['popMessage']);
                }
            } else {
                // Handle the case when either 'user_id' or 'id' is missing
                $_SESSION['popMessage'] = "User ID or Book ID missing.";
                echo '<div style="display: flex; background-color: #E46060;" class="popError center column" id="popup">' .
                    '<h2>' . $_SESSION['popMessage'] . '</h2>' .
                    '<input type="button" value="Close" onclick="gotoPage(\'BookProcess.php\')">' . '</div>' .
                    '<div style="display: flex; margin: -20vw;" class="overlay" id="overlay"></div>';
                unset($SESSION['popMessage']);
            }
        }
    ?>

    <body class="center">
        <div class="headbar">
            <img src="pictures\CSS326BasedLib.png" alt="Logo">
            <div class="greet-text">
                <p>Book Reservation</p><br>
            </div>
        </div>
        <form action="" class="manage-panel process-items center" method="post">
            <div class="row">
                <div class="column">
                    <h2>Date of borrowing</h2>
                    <input type="date" id="borrow" name="borrow" value="<?php echo date('Y-m-d'); ?>">
                    <h2>Date of return</h2>
                    <input type="date" id="return" name="return" required>
                </div>
            </div>
            <div class="row center" style="padding: 0 0 0 0; justify-content: space-evenly;">
                <input type="submit" value="Confirm" class="conBT" id="submit-button">
                <input type="button" value="Cancel" class="canBT" id="submit-button" onclick="gotoPage('BookReserve.php')">
            </div>
        </form>
    </body>
</html>
<?php include 'connect.php'; ?>
<script src="script.js"></script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Book Process</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;700&display=swap" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
</head>
<?php
include 'connect.php';

session_start(); // Start the session if not already started

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
                echo "Reservation successfully added.";
            } else {
                // Failed to insert
                echo "Failed to add reservation.";
            }

            $stmt->close();
        } else {
            // Error in preparing the statement
            echo "Error: Unable to prepare SQL statement.";
        }
    } else {
        // Handle the case when either 'user_id' or 'id' is missing
        echo "User ID or Book ID missing.";
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
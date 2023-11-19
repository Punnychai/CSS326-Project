<?php include 'connect.php'; ?>
<script src="script.js"></script>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Add Book</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;700&display=swap" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    </head>
    <?php
    //include 'connect.php';

    session_start(); // Start the session if not already started

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['bID'])) {
        // Retrieve the bID from the URL parameter
        $bookID = $_GET['bID'];

        // Prepare and execute the SQL SELECT query
        $selectQuery = "SELECT ISBN, Name, AuthorName, Genre FROM book WHERE Book_ID = ?";
        $stmt = $mysqli->prepare($selectQuery);

        if ($stmt) {
            $stmt->bind_param("i", $bookID);
            $stmt->execute();
            $stmt->bind_result($ISBN, $name, $authorName, $genre);

            // Fetch the results
            $stmt->fetch();

            // Close the statement
            $stmt->close();
        } else {
            // Error in preparing the statement
            echo "Error: Unable to prepare SQL statement.";
        }
    } else {
        // Handle the case when 'bID' is missing or the request method is not GET
        echo "Book ID missing or Update: ";
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['bID'])) {
        // Retrieve form data
        $bookID = $_GET['bID'];
        $name = $_POST['Name'];
        $authorName = $_POST['Author'];
        $genre = $_POST['Genre'];
        $ISBN = $_POST['ISBN'];

        // Update the book details in the database
        $updateQuery = "UPDATE book SET Name = ?, AuthorName = ?, Genre = ?, ISBN = ? WHERE Book_ID = ?";
        $stmt = $mysqli->prepare($updateQuery);

        if ($stmt) {
            $stmt->bind_param("ssssi", $name, $authorName, $genre, $ISBN, $bookID);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                // Successful update
                echo "Book details updated successfully.";
            } else {
                // No rows affected, probably no changes made
                echo "No changes were made to the book details.";
            }

            $stmt->close();
            header('Location: ManageBook.php');
        } else {
            // Error in preparing the statement
            echo "Error: Unable to prepare SQL statement.";
        }
    }
    ?>

    <body class="center">
        <div class="headbar">
            <img src="pictures\CSS326BasedLib.png" alt="Logo">
            <div class="greet-text">
                <p>Edit book</p><br>
            </div>
        </div>
        <form action="" class="manage-panel add-book" method="post">
            <div class="row" style="width: 88%;">
                <div class="column">
                    <h3>Name</h3>
                </div>
                <div class="column" style="width: 73%;">
                    <input type="text" id="Name" name="Name" value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>" required>
                </div>
            </div>
            <div class="row" style="width: 88%;">
                <div class="column">
                    <h3>Author Name</h3>
                </div>
                <div class="column" style="width: 73%;">
                    <input type="text" id="Author" name="Author" value="<?php echo isset($authorName) ? htmlspecialchars($authorName) : ''; ?>" required>
                </div>
            </div>
            <div class="row" style="width: 88%;">
                <div class="column">
                    <h3>Genre</h3>
                </div>
                <div class="column" style="width: 73%;">
                    <input type="text" id="Genre" name="Genre" value="<?php echo isset($genre) ? htmlspecialchars($genre) : ''; ?>" required>
                </div>
            </div>
            <div class="row" style="width: 88%;">
                <div class="column">
                    <h3>ISBN</h3>
                </div>
                <div class="column" style="width: 73%;">
                    <input type="text" id="ISBN" name="ISBN" value="<?php echo isset($ISBN) ? htmlspecialchars($ISBN) : ''; ?>" required>
                </div>
            </div>
            <div class="row center" style="padding: 0 0 0 0; justify-content: space-evenly;">
                <input type="submit" value="Confirm" class="conBT" id="submit-button">
                <input type="button" value="Cancel" class="canBT" id="submit-button" onclick="gotoPage('ManageBook.php')">
            </div>
        </form>


    </body>
</html>
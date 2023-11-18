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

    <body class="center">
        <div class="headbar">
            <img src="pictures\CSS326BasedLib.png" alt="Logo">
            <div class="greet-text">
                <p>Add Book</p><br>
            </div>
        </div>
        <form action="" class="manage-panel add-book" method="post">
            <div class="row" style="width: 88%;">
                <div class="column">
                    <h3>Name</h3>
                </div>
                <div class="column" style="width: 73%;"><input type="text" id="Name" name="Name" required></div>
            </div>
            <div class="row" style="width: 88%;">
                <div class="column">
                    <h3>Author Name</h3>
                </div>
                <div class="column" style="width: 73%;">
                    <input type="text" id="Author" name="Author" required>
                </div>
            </div>
            <div class="row" style="width: 88%;">
                <div class="column">
                    <h3>Genre</h3>
                </div>
                <div class="column" style="width: 73%;"><input type="text" id="Genre" name="Genre" required>
                </div>
            </div>
            <div class="row" style="width: 88%;">
                <div class="column">
                    <h3>ISBN</h3>
                </div>
                <div class="column" style="width: 73%;"><input type="text" id="ISBN" name="ISBN" required>
                </div>
            </div>
            <div class="row center" style="padding: 0 0 0 0; justify-content: space-evenly;">
                <input type="submit" value="Confirm" class="conBT" id="submit-button">
                <input type="button" value="Cancel" class="canBT" id="submit-button" onclick="gotoPage('ManageBook.php')">
            </div>
        </form>

        <?php
            session_start();

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Check if all fields are filled
                if (isset($_POST['Name'], $_POST['Author'], $_POST['Genre'], $_POST['ISBN']) &&
                    !empty($_POST['Name']) && !empty($_POST['Author']) &&
                    !empty($_POST['Genre']) && !empty($_POST['ISBN'])) {

                    $name = $_POST['Name'];
                    $author = $_POST['Author'];
                    $genre = $_POST['Genre'];
                    $isbn = $_POST['ISBN'];

                    // Validate ISBN format (char(13))
                    if (strlen($isbn) === 13) {
                        // Prepare and bind the SQL statement
                        $stmt = $mysqli->prepare("INSERT INTO book (Name, AuthorName, Genre, ISBN) VALUES (?, ?, ?, ?)");
                        $stmt->bind_param("ssss", $name, $author, $genre, $isbn);

                        // Execute the query
                        if ($stmt->execute()) {
                            // THERE'S SOME STYLE ISSUE HERE, FIX IT.
                            $_SESSION['popMessage'] =  "New Book has been added!";
                            echo '<div style="display: flex; background-color: green;" class="popError center column" id="popup">' .
                                '<h2>' . $_SESSION['popMessage'] . '</h2>' .
                                '<input type="button" value="Close" onclick="gotoPage(\'ManageBook.php\')">' . '</div>' .
                                '<div style="display: flex; margin: -20vw;" class="overlay" id="overlay"></div>';

                        }
                        else {
                            $_SESSION['popMessage'] =  "Error: " . $stmt->error;
                            echo '<div style="display: flex; background-color: red;" class="popError center column" id="popup">' .
                                '<h2>' . $_SESSION['popMessage'] . '</h2>' .
                                '<input type="button" value="Close" onclick="PopDown()">' . '</div>' .
                                '<div style="display: flex; margin: -20vw;" class="overlay" id="overlay"></div>';
                        }

                        // Close statement and connection
                        $stmt->close();
                        //$mysqli->close();
                    }
                    else {
                        $_SESSION['popMessage'] =  "ISBN should be 13 characters long.";
                        echo '<div style="display: flex; background-color: red;" class="popError center column" id="popup">' .
                            '<h2>' . $_SESSION['popMessage'] . '</h2>' .
                            '<input type="button" value="Close" onclick="PopDown()">' . '</div>' .
                            '<div style="display: flex; margin: -20vw;" class="overlay" id="overlay"></div>';
                    }
                }
                else {
                    $_SESSION['popMessage'] =  "All fields are required.";
                    echo '<div style="display: flex; background-color: red;" class="popError center column" id="popup">' .
                        '<h2>' . $_SESSION['popMessage'] . '</h2>' .
                        '<input type="button" value="Close" onclick="PopDown()">' . '</div>' .
                        '<div style="display: flex; margin: -20vw;" class="overlay" id="overlay"></div>';
                }
            }
        ?>
    </body>
</html>
<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Manage Book</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;700&display=swap" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    </head>

    <?php
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
                        echo "New record added successfully!";
                    } else {
                        echo "Error: " . $stmt->error;
                    }

                    // Close statement and connection
                    $stmt->close();
                    //$mysqli->close();
                } else {
                    echo "ISBN should be 13 characters long.";
                }
            } else {
                echo "All fields are required.";
            }
        }
    ?>

    <body class="center">
        <div class="headbar">
            <img src="pictures\CSS326BasedLib.png" alt="Logo">
            <div class="greet-text">
                <p>Manage Book</p><br>
            </div>
        </div>
        <form action="" class="popup center column add-book" id="popup" method="post">
            <div class="row">
                <h1>Add a new book</h1>
            </div>
            <div class="row">
                <div class="column">
                    <h2>Name</h2>
                    <input type="text" id="Name" name="Name" required>
                    <h2>Author Name</h2>
                    <input type="text" id="Author" name="Author" required>
                    <h2>Genre</h2>
                    <input type="text" id="Genre" name="Genre" required>
                    <h2>ISBN</h2>
                    <input type="text" id="ISBN" name="ISBN" required>
                </div>
            </div>
            <input type="submit" value="Confirm" style="color: green">
            <input type="button" value="Cancel" style="color: red" onclick="PopDown()">
        </form>

        <div class="manage-panel">
            <button class="add" onclick="PopUp()">
                <img src="pictures\add_icon_big.png" alt="" class="add-icon">
                <label for="">Add</label>
            </button>
            <div id="" class="admin">
                <!--%%%%% Main block %%%%-->
                <table style="width:96%;">
                    <col width="98%">
                    <col width="1.5%">
                    <col width="0.5%">
                    <?php
                    $q2 = "SELECT book.Name, book.Book_ID FROM book";
                    $result = $mysqli->query($q2);
                    if (!$result) {
                        echo "Select failed. Error: " . $mysqli->error;
                        return false;
                    }
                    while ($row = $result->fetch_array()) { ?>
                        <tr>
                            <td>
                                <p>
                                    <?= $row[0] ?>
                                </p>
                            </td>
                            <td><a href='EditBook.php?bID=<?= $row[1] ?>'>
                                    <p>Edit</p>
                                </a></td>
                            <td>|</td>
                            <td><a href='RemoveBook.php?bID=<?= $row[1] ?>'>
                                    <p>Remove</p>
                                </a></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>

        <script src="script.js"></script>
    </body>
</html>
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
    <body class="center">
    <div class="headbar">
        <img src="pictures\CSS326BasedLib.png" alt="Logo">
        <div class="greet-text">
            <p>Manage Book</p><br>
        </div>
    </div>
    <form action="" class="popup center column add-book" id="popup">
        <div class="row">
            <h1>Add a new book</h1>
        </div>
        <div class="row">
            <div class="column">
                <h2>Name</h2>
                <input type="text" id="Name" name="Name">
                <h2>Author Name</h2>
                <input type="text" id="Author" name="Author">
                <h2>Genre</h2>
                <input type="text" id="Genre" name="Genre">
                <h2>ISBN</h2>
                <input type="text" id="ISBN" name="ISBN">
            </div>
        </div>
        <div class="row"><input type="submit" value="Confirm"></div>
        <div class="row"><input type="submit" value="Cancel" onclick="PopDown()"></div>
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
                $q2 = "SELECT book.Name FROM book";
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
                        <td><a href='edit_book.php?id=<?= $row[0] ?>'>
                                <p>Edit</p>
                            </a></td>
                        <td>|</td>
                        <td><a href='delbook.php?id=<?= $row[0] ?>'>
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
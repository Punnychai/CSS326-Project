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
                <p>Edit book</p><br>
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

    </body>
</html>
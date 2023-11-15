<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Book Reserve</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;700&display=swap" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    </head>

    <body class="center">
        <div class="headbar">
            <img src="pictures\CSS326BasedLib.png" alt="Logo">
            <div class="greet-text">
                <p>Book Reservation</p><br>
            </div>
        </div>

        <form action="empty.php" class="popup center column" id="popup">
            <div class="row">
                <h1>Select the borrow date</h1>
            </div>
            <div class="row">
                <div class="column">
                    <h2>Date of borrowing</h2>
                    <input type="date" id="borrow" name="borrow" value="<?php echo date('Y-m-d'); ?>">
                    <h2>Date of return</h2>
                    <input type="date" id="return" name="return" required>
                </div>
            </div>
            <div class="row"><input type="submit" value="Confirm" style="color: green"></div>
            <div class="row"><input type="button" value="Cancel" style="color: red" onclick="PopDown()"></div>
        </form>

        <div class="book-panel">
            <table style="width:90%;">
                <tr>
                    <th>Title</th> 
                    <th>Author</th>
                    <th>Genre</th>
                    <th>ISBN</th>
                </tr>
            </table>
        </div>
            
        <div class="manage-panel">
            
            <div class="book-panel">
                <table style="width:96%;">
                    <col width="25%">
                    <col width="25%">
                    <col width="25%">
                    <col width="25%">

                    <?php
                    $bookSelect = "SELECT book.Name, AuthorName, Genre, ISBN FROM book";
                    $result = $mysqli->query($bookSelect);
                    if (!$result) {
                        echo "Select failed. Error: " . $mysqli->error;
                        return false;
                    }
                    while ($row = $result->fetch_array()) { ?>
                        <tr onclick="PopUp()">
                            <td>
                                <p><?= $row[0] ?></p>
                            </td>
                            <td>
                                <p><?= $row[1] ?></p>    
                            </td>
                            <td>
                                <p><?= $row[2] ?></p>    
                            </td>
                            <td>
                                <p><?= $row[3] ?></p>     
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
        <script src="script.js"></script>
    </body>
</html>
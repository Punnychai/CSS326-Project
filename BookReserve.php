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
                    $bookSelect = "SELECT book.Name, AuthorName, Genre, ISBN, Book_ID FROM book where Book_ID not in (SELECT B_ID from bookreservation)";
                    $result = $mysqli->query($bookSelect);
                    if (!$result) {
                        echo "Select failed. Error: " . $mysqli->error;
                        return false;
                    }
                    while ($row = $result->fetch_array()) { ?>
                        <tr onclick="gotoPageWithID('BookProcess.php', <?= $row['Book_ID'] ?>)">
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
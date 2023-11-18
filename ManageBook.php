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
        <?php
            if (isset($_SESSION['popMessage'])) {
                echo '<div style="display: flex;" class="popError center column" id="popup">' .
                    '<h2>' . $_SESSION['popMessage'] . '</h2>' .
                    '<input type="button" value="Close" onclick="PopDown()">' . '</div>' .
                    '<div style="display: flex; margin: -20vw;" class="overlay" id="overlay"></div>';
            }
        ?>
        <div class="headbar">
            <img src="pictures\CSS326BasedLib.png" alt="Logo">
            <div class="greet-text">
                <p>Manage Book</p><br>
            </div>
        </div>

        <div class="manage-panel">
            <button class="add" onclick="gotoPage('AddBook.php')">
                <img src="pictures\add_icon_big.png" alt="" class="add-icon">
                <label for="">Add</label>
            </button>

            <div id="" class="admin">
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
                            <td>
                                <a href='EditBook.php?bID=<?= $row[1] ?>'>
                                    <p>Edit</p>
                                </a>
                            </td>
                            <td>|</td>
                            <td>
                                <a href='RemoveBook.php?bID=<?= $row[1] ?>'>
                                    <p>Remove</p>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>

        <script src="script.js"></script>
    </body>
</html>
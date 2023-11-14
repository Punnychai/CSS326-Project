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
        <div class="headbar row">
            <img src="pictures\CSS326BasedLib.png" alt="Logo">
            <div class="greet-text">
                <?php
                    session_start();
                    $getName = "SELECT User_FName, User_LName FROM user WHERE Username = '$username' LIMIT 1";  // only selects the first match
                    $result = $mysqli -> query($getName);
                    while ($row = $result -> fetch_assoc()) {
                        echo "<p>Welcome, " . $row["User_FName"] . " " . $row["User_LName"] . "!</p><br>";
                    }
                ?>
            </div>
        </div>

        <div>
            <h2>Book Reservation page</h2>			
            <table>
                <col width="10%">
                <col width="20%">
                <col width="30%">
                <col width="30%">
                <col width="5%">
                <col width="5%">

                <tr>
                    <th>Title</th> 
                    <th>Author</th>
                    <th>Genre</th>
                    <th>ISBN</th>
                </tr>
                <?php
                    $bookSelect = "SELECT Name, AuthorName, Genre, ISBN FROM book";
                    $result = $mysqli -> query($bookSelect);
                    if (!$result) {
                        echo "Select failed. Error: " . $mysqli -> error ;
                        return false;
                    }
                while ($row = $result -> fetch_array()) { ?>
                <tr>
                    <td><?=$row[1]?></td> 
                    <td><?=$row[2]?></td>
                    <td><?=$row[3]?></td>
                    <td><?=$row[4]?></td>
                    <td><a href='edit_group.php?id=<?=$row[0]?>'> <img src="images/Modify.png" width="24" height="24"></td>
                    <td><a href='delinfo.php?id=<?=$row[0]?>'> <img src="images/Delete.png" width="24" height="24"></a></td>
                </tr>                               
                <?php } ?>

            <?php 
                // count the no. of entries
                echo "<tr><td colspan='6' style='text-align: right;'>Total " . mysqli_num_rows($result) . " records" . "</td></tr>";
            ?>
            </table>	
        </div>
    </body> 
</html>
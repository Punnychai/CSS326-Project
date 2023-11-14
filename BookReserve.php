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
        <img src="pictures\CSS326BasedLib.png" alt="Logo" class="headbar">
        
        <div class="main">
            <h2>Book Reservation page</h2>			
            <table style="width: 70vw">
                <col style="width: 27%;">
                <col style="width: 27%;">
                <col style="width: 20%;">
                <col style="width: 16%;">
                <col style="width: 8%;">

                <tr>
                    <th>Title</th> 
                    <th>Author</th>
                    <th>Genre</th>
                    <th>ISBN</th>
                </tr>
                <?php
                    $bookSelect = "SELECT book.Name, AuthorName, Genre, ISBN FROM book";
                    $result = $mysqli -> query($bookSelect);
                    if (!$result) {
                        echo "Select failed. Error: " . $mysqli -> error ;
                        return false;
                    }
                while ($row = $result -> fetch_array()) { ?>
                <tr>
                    <td><?=$row[0]?></td> 
                    <td><?=$row[1]?></td>
                    <td><?=$row[2]?></td>
                    <td><?=$row[3]?></td>
                    <td>
                        <button>select</button>
                        <button>remove</button>
                    </td>
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
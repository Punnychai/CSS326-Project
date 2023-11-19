<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Table Reserve</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;700&display=swap" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    </head>

    <body class="center">
        <?php
            $query = "SELECT TableNo, BookedFlag FROM libtable";
            $result = $mysqli->query($query);

            if ($result) {
                // Fetch the rows as associative arrays
                $tables = $result->fetch_all(MYSQLI_ASSOC);
                $result->free();

                echo '<div class="row">';
                echo '<div class="table-panel">';
                
                // Iterate through the fetched data to create buttons dynamically
                foreach ($tables as $table) {
                    $tableNo = $table['TableNo'];
                    $bookedFlag = $table['BookedFlag'];
                    $buttonClass = ($bookedFlag == 1) ? 'table reserved' : 'table';
                
                    // Render button without link if BookedFlag is 1
                    if ($bookedFlag == 1) {
                        echo '<button class="' . $buttonClass . '" id="table' . $tableNo . '">Table ' . $tableNo . '</button>';
                    } else {
                        echo '<button onclick="gotoPage(\'TableProcess.php?tableNo=' . $tableNo . '\')" class="' . $buttonClass . '" id="table' . $tableNo . '">Table ' . $tableNo . '</button>';
                    }
                }
                
                echo '</div>';
                echo '<div class="icon-container">';
                echo '<img src="pictures\CSS326BasedLib.png" alt="Logo">';
                echo '</div>';
                echo '</div>';
            } else {
                echo "Error: Unable to fetch table information.";
            }
        ?>

        <script src="script.js"></script>
    </body>
</html>
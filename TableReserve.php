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
            // Check if the 'Confirm' button is pressed -- DOESN'T WORK YET
            // if (isset($_POST['Confirm'])) {
                // echo '<div style="display: flex; background-color: #4ca82c" class="popSuccess center column" id="popup2">' .
                //     '<h1>Success!</h1>' .
                //     '<input type="button" value="Close" onclick="PopDown()">' . '</div>' .
                //     '<div style="display: flex; margin: -20vw;" class="overlay" id="overlay2"></div>';
            // }
        ?>
        
        <div class="row">
            <div class="table-panel">
                <button onclick="gotoPage('TableProcess.php')" class="table " id="table1">Table 1</button>
                <button onclick="gotoPage('TableProcess.php')" class="table reserved" id="table2">Table 2</button>
                <button onclick="gotoPage('TableProcess.php')" class="table " id="table3">Table 3</button>
                <button onclick="gotoPage('TableProcess.php')" class="table " id="table4">Table 4</button>
                <button onclick="gotoPage('TableProcess.php')" class="table " id="table5">Table 5</button>
                <button onclick="gotoPage('TableProcess.php')" class="table " id="table6">Table 6</button>
                <button onclick="gotoPage('TableProcess.php')" class="table " id="table7">Table 7</button>
                <button onclick="gotoPage('TableProcess.php')" class="table " id="table8">Table 8</button>
                <button onclick="gotoPage('TableProcess.php')" class="table reserved" id="table9">Table 9</button>
                <button onclick="gotoPage('TableProcess.php')" class="table reserved" id="table10">Table 10</button>
                <button onclick="gotoPage('TableProcess.php')" class="table reserved" id="table11">Table11</button>
            </div>
            <div class="icon-container">
                <img src="pictures\CSS326BasedLib.png" alt="Logo">
            </div>

        </div>
        <script src="script.js"></script>
    </body>
</html>
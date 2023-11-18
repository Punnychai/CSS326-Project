<?php include 'connect.php'; ?>
<script src="script.js"></script>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Table Process</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;700&display=swap" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    </head>

    <body class="center">
        <div class="headbar">
            <img src="pictures\CSS326BasedLib.png" alt="Logo">
            <div class="greet-text">
                <p>Table Reservation</p><br>
            </div>
        </div>
        <form action="" class="manage-panel add-book" method="post">
            <div class="row">
                <h1>Specify Booking Time</h1>
            </div>
            <div class="row">
                <div class="column">
                    <h2>Reserve this Table from</h2>
                    <input type="time" id="startTime" name="startTime">
                    <h2>To</h2>
                    <input type="time" id="endTime" name="endTime" required>
                </div>
            </div>
            <div class="row center" style="padding: 0 0 0 0; justify-content: space-evenly;">
                <input type="submit" value="Confirm" class="conBT" id="submit-button">
                <input type="button" value="Cancel" class="canBT" id="submit-button" onclick="gotoPage('TableReserve.php')">
            </div>
        </form>

    </body>
</html>
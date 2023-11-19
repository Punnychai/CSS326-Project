<?php include 'connect.php'; ?>
<script src="script.js"></script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Book Process</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;700&display=swap" />
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
    <form action="" class="manage-panel process-items center" method="post">
        <div class="row">
            <div class="column">
                <h2>Date of borrowing</h2>
                <input type="date" id="borrow" name="borrow" value="<?php echo date('Y-m-d'); ?>">
                <h2>Date of return</h2>
                <input type="date" id="return" name="return" required>
            </div>
        </div>
        <div class="row center" style="padding: 0 0 0 0; justify-content: space-evenly;">
            <input type="submit" value="Confirm" class="conBT" id="submit-button">
            <input type="button" value="Cancel" class="canBT" id="submit-button" onclick="gotoPage('BookReserve.php')">
        </div>
    </form>

</body>

</html>
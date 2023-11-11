<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;700&display=swap" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
</head>

<body class="center">
    <div class="headbar row">
        <img src="pictures\CSS326BasedLib.png" alt="Logo" style="height: 8vh; position: relative; top: 1vh; left: 3vw">
        <div class="greet-text">
            <?php
            session_start();
            $getName = "SELECT User_FName, User_LName FROM user WHERE Username = '$username' LIMIT 1"; // only selects the first match
            $result = $mysqli->query($getName);
            while ($row = $result->fetch_assoc()) {
                echo "<p>Welcome, " . $row["User_FName"] . " " . $row["User_LName"] . "!</p><br>";
            }
            ?>
        </div>
    </div>
    <button class="reserve admin">
        <img src="pictures\table_icon_big.png" alt="" class="reserve-icon admin">
        <br><label for="">Table reservation</label>
    </button>
    <button class="reserve admin">
        <img src="pictures\book_icon_big.png" alt="" class="reserve-icon admin">
        <br><label for="">Book reservation</label>
    </button>
    <button class="reserve admin">
        <img src="pictures\pencil_icon_big.png" alt="" class="reserve-icon admin">
        <br><label for="">Manage book</label>
    </button>
    <button class="reserve admin">
        <img src="pictures\person_icon_big.png" alt="" class="reserve-icon admin">
        <br><label for="">Manage Admin</label>
    </button>
</body>

</html>
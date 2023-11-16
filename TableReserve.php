<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Table Reserve</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;700&display=swap" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
</head>

<body class="center">
    <form action="empty.php" class="popup center column" id="popup">
        <div class="row">
            <h1>Specify Booking Time</h1>
        </div>
        <div class="row">
            <div class="column">
                <!-- <input type="date" id="borrow" name="borrow" value="<?php echo date('Y-m-d'); ?>"> -->
                <h2>Reserve this Table from</h2>
                <input type="time" id="startTime" name="startTime">
                <h2>To</h2>
                <input type="time" id="endTime" name="endTime">
            </div>
        </div>
        <div class="row"><input type="submit" value="Confirm" style="color: green"></div>
        <div class="row"><input type="button" value="Cancel" style="color: red" onclick="PopDown()"></div>
    </form>
    <div class="overlay" id="overlay"></div>
    <div class="row">
        <div class="table-panel">
            <button onclick="PopUp()" class="table " id="table1">Table 1</button>
            <button onclick="PopUp()" class="table reserved" id="table2">Table 2</button>
            <button onclick="PopUp()" class="table " id="table3">Table 3</button>
            <button onclick="PopUp()" class="table " id="table4">Table 4</button>
            <button onclick="PopUp()" class="table " id="table5">Table 5</button>
            <button onclick="PopUp()" class="table " id="table6">Table 6</button>
            <button onclick="PopUp()" class="table " id="table7">Table 7</button>
            <button onclick="PopUp()" class="table " id="table8">Table 8</button>
            <button onclick="PopUp()" class="table reserved" id="table9">Table 9</button>
            <button onclick="PopUp()" class="table reserved" id="table10">Table 10</button>
            <button onclick="PopUp()" class="table reserved" id="table11">Table11</button>
        </div>
        <div class="icon-container">
            <img src="pictures\CSS326BasedLib.png" alt="Logo">
        </div>

    </div>
    <script src="script.js"></script>
</body>

</html>
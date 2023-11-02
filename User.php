<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>General User</title>
    </head>
    <body>
        <?php
            echo "<h3>This is general users page</h3>"
            // get the user full name to show here
        ?>
        <?php
        session_start();

        // Check if the user is logged in
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $userType = $_SESSION['userType'];

            echo "Welcome, $username!<br>";
            echo "User Type: $userType<br>";
        } else {
            // Handle the case when the user is not logged in or session data is not set
            echo "You are not logged in.";
        }
        ?>
    </body>
</html>
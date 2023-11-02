<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Member</title>
    </head>
    <body>
    <?php
            echo "<h3>This is members only</h3>"
        ?>
    <?php
    session_start();

    // Check if the user is logged in
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $userType = $_SESSION['userType'];
        $memberType = $_SESSION['memberType'];
        $faculty = $_SESSION['faculty'];
        $doe = $_SESSION['doe'];

        echo "Welcome, $username!<br>";
        echo "User Type: $userType<br>";

        if ($userType == "member") {
            echo "Member Type: $memberType<br>";
            echo "Faculty: $faculty<br>";
            echo "Date of Enrollment: $doe<br>";
        }
    } else {
        // Handle the case when the user is not logged in or session data is not set
        echo "You are not logged in.";
    }
    ?>
    </body>
</html>

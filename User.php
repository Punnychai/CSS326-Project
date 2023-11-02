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
        // Make sure you have started the session to access $_SESSION variables
        session_start();
        if(isset($_SESSION['signup'])){
        // Database connection details
        $host = "localhost"; // Change to your MySQL server hostname
        $username = "root";  // Change to your MySQL username
        $password = "root";  // Change to your MySQL password
        $database = "mockup"; // Change to your database name

        // Create a database connection
        $mysqli = new mysqli($host, $username, $password, $database);

        // Check the connection
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        // Prepare the user data
        $userType = $_SESSION['userType'];
        $fname = $_SESSION['fname'];
        $lname = $_SESSION['lname'];
        $dob = $_SESSION['dob'];
        $username = $_SESSION['username'];
        $password = $_SESSION['passwd']; // Hash the default password

        // Create the SQL query to insert user data into the "user" table
        $sqlUser = "INSERT INTO user (User_FName, User_LName, Username, User_DOB, User_Blacklist, Member_Flag, Member_Type, Member_Faculty, Member_Year, General_Flag, Admin_Flag)
                VALUES (?, ?, ?, ?, 0, 0, NULL, NULL, NULL, 1, 0)";

        // Prepare the statement
        $stmtUser = $mysqli->prepare($sqlUser);

        if ($stmtUser) {
            // Bind parameters and execute the statement
            $stmtUser->bind_param("ssss", $fname, $lname, $username, $dob);
            
            if ($stmtUser->execute()) {
                // Get the User_ID of the newly inserted user
                $user_id = $stmtUser->insert_id;

                // Close the statement
                $stmtUser->close();

                // Create the SQL query to insert login data into the "login" table
                $sqlLogin = "INSERT INTO login (User_ID, username, password)
                        VALUES (?, ?, ?)";

                // Prepare the statement for login data
                $stmtLogin = $mysqli->prepare($sqlLogin);

                if ($stmtLogin) {
                    // Bind parameters and execute the statement
                    $stmtLogin->bind_param("iss", $user_id, $username, $password);
                    
                    if ($stmtLogin->execute()) {
                        echo "User and login data inserted successfully.";
                    } else {
                        echo "Error inserting login data: " . $stmtLogin->error;
                    }

                    // Close the statement
                    $stmtLogin->close();
                } else {
                    echo "Error preparing login data statement: " . $mysqli->error;
                }
            } else {
                echo "Error inserting user data: " . $stmtUser->error;
            }
        } else {
            echo "Error preparing user data statement: " . $mysqli->error;
        }

        // Close the database connection
        $mysqli->close();
        }
        ?>
    </body>
</html>
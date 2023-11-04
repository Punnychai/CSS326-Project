<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>General User</title>
    </head>
    <body>
        <?php
            // Make sure you have started the session to access $_SESSION variables
            session_start();
            if(isset($_SESSION['signup'])){

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
            }
            // Check if the user is logged in
            if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];
                $userType = $_SESSION['userType'];
                $memberType = $_SESSION['memberType'];
                $faculty = $_SESSION['faculty'];
                $doe = $_SESSION['doe'];

                $getName = "SELECT User_FName, User_LName FROM user WHERE Username = '$username' LIMIT 1";  // only selects the first match
                $result = $mysqli -> query($getName);
                while ($row = $result -> fetch_assoc()) {
                    echo "<h3>Welcome, " . $row["User_FName"] . " " . $row["User_LName"] . "!</h3><br>";
                }
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

            // Close the database connection
            $mysqli->close();
        ?>
    </body>
</html>
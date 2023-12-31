<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>General User</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;700&display=swap" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    </head>
    <body class="center">
        <?php include 'headBar.php'; ?>

        <?php
            if(isset($_SESSION['signup'])){
                unset($_SESSION['signup']);
                // Prepare the user data
                $userType = $_SESSION['userType'];
                $fname = $_SESSION['fname'];
                $lname = $_SESSION['lname'];    
                $dob = $_SESSION['dob'];
                $username = $_SESSION['username'];
                $password = $_SESSION['passwd']; // Hash the default password
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

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
                        $_SESSION['user_id']=$user_id;
                        // Close the statement
                        // $stmtUser->close();

                        // Create the SQL query to insert login data into the "login" table
                        $sqlLogin = "INSERT INTO login (User_ID, username, password)
                                VALUES (?, ?, ?)";

                        // Prepare the statement for login data
                        $stmtLogin = $mysqli->prepare($sqlLogin);

                        if ($stmtLogin) {
                            // Bind parameters and execute the statement
                            $stmtLogin->bind_param("iss", $user_id, $username, $hashedPassword);
                            
                            if ($stmtLogin->execute()) {
                                // echo "User and login data inserted successfully.";
                            } else {
                                // echo "Error inserting login data: " . $stmtLogin->error;
                            }
                            
                            header('location: LogIn.php');
                            // Close both statements
                            $userStmt->close();
                            $loginStmt->close();
                        } else {
                            // echo "Error preparing login data statement: " . $mysqli->error;
                        }
                    } else {
                        // echo "Error inserting user data: " . $stmtUser->error;
                    }
                } else {
                    // echo "Error preparing user data statement: " . $mysqli->error;
                }
            }
            // Check if the user is logged in
            if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];
                $userType = $_SESSION['userType'];
                $memberType = $_SESSION['memberType'];
                $faculty = $_SESSION['faculty'];
                $doe = $_SESSION['doe'];

                if ($userType == "member") {
                    echo "Member Type: $memberType<br>";
                    echo "Faculty: $faculty<br>";
                    echo "Date of Enrollment: $doe<br>";
                }
            } else {
                // Handle the case when the user is not logged in or session data is not set
                // echo "You are not logged in.";
            }

            // Close the database connection
            $mysqli->close();
            session_destroy();
        ?>
        <a href="TableReserve.php" class="reserve">
            <button>
                <img src="pictures\table_icon_big.png" alt="" class="reserve-icon">
                <br><label for="">Table reservation</label>
            </button>
        </a>
    </body>
</html>
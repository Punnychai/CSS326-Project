<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Member</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;700&display=swap" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    </head>
    <body class="center">
        <?php include 'headBar.php'; ?>

        <?php
            if(isset($_SESSION['signup']) && $_SESSION['signup']==1) {
                $_SESSION['signup']=0;
                // Create a prepared statement for inserting user data into the user table
                $userStmt = $mysqli->prepare("INSERT INTO user (User_FName, User_LName, Username, User_DOB, User_Blacklist, Member_Flag, Member_Type, Member_Faculty, Member_Year, General_Flag, Admin_Flag) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                // Create a prepared statement for inserting login data into the login table
                $loginStmt = $mysqli->prepare("INSERT INTO login (User_ID, username, password) VALUES (?, ?, ?)");

                if ($userStmt && $loginStmt) {
                    // Bind values to the placeholders for the user table
                    $userFName = $_SESSION['fname'];
                    $userLName = $_SESSION['lname'];
                    $username = $_SESSION['username'];
                    $userDOB = $_SESSION['dob'];
                    $userBlacklist = 0; // Assuming default is 0
                    $memberFlag = 1; // Assuming this is for members
                    $memberType = $_SESSION['memberType'];
                    $memberFaculty = $_SESSION['faculty'];
                    $memberYear = $_SESSION['doe'];
                    $generalFlag = 0; // Assuming this is not a general user
                    $adminFlag = 0; // Assuming this is not an admin user

                    $userStmt->bind_param("ssssiiisiii", $userFName, $userLName, $username, $userDOB, $userBlacklist, $memberFlag, $memberType, $memberFaculty, $memberYear, $generalFlag, $adminFlag);

                    // Execute the statement for inserting user data
                    if ($userStmt->execute()) {
                        // Get the User_ID of the inserted user
                        $user_id = $userStmt->insert_id;
                        $_SESSION['user_id']=$user_id;
                        // Now, bind values to the placeholders for the login table
                        $loginUsername = $_SESSION['username'];
                        $loginPassword = $_SESSION['passwd']; 
                        $hashedPassword = password_hash($loginPassword, PASSWORD_BCRYPT);
                        $loginStmt->bind_param("iss", $user_id, $loginUsername, $hashedPassword);

                        // Execute the statement for inserting login data
                        if ($loginStmt->execute()) {
                            // Both user and login data have been successfully inserted
                        } else {
                            // echo "Error inserting login data: " . $loginStmt->error;
                        }
                    } else {
                        // echo "Error inserting user data: " . $userStmt->error;
                    }

                    // Close both statements
                    $userStmt->close();
                    $loginStmt->close();
                } else {
                    // echo "Error preparing statements: " . $mysqli->error;
                }
            }
            // Check if the user is logged in
            if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];
                $userType = $_SESSION['userType'];
                /*
                $sqlmem="SELECT Member_Type, Member_Faculty, Member_Year from user WHERE User_ID=?";
                $stmtmem=$mysqli->prepare($sqlmem);
                $stmtmem->bind_param("i", $_SESSION['user_id']);
                $stmtmem->execute();
                $stmtmem->bind_result($_SESSION['memberType'],$_SESSION['faculty'],$_SESSION['doe']);
                */
                $memberType = $_SESSION['memberType'];
                $faculty = $_SESSION['faculty'];
                $doe = $_SESSION['doe'];

                //echo "User Type: $userType<br>"; //I commented this so Im not confused

                // if ($userType == "Member") {
                //     echo "Member Type: $memberType<br>";
                //     echo "Faculty: $faculty<br>";
                //     echo "Date of Enrollment: $doe<br>";
                // }
            } else {
                // Handle the case when the user is not logged in or session data is not set
                echo "You are not logged in.";
            }
            
            // Close the database connection
            $mysqli->close();
        ?>
        <a href="TableReserve.php" class="reserve">
            <button>
                <img src="pictures\table_icon_big.png" alt="" class="reserve-icon">
                <br><label for="">Table reservation</label>
            </button>
        </a>
        <a href="BookReserve.php" class="reserve">
            <button>
                <img src="pictures\book_icon_big.png" alt="" class="reserve-icon">
                <br><label for="">Book reservation</label>
            </button>
        </a>
    </body>
</html>

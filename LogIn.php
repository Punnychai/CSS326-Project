<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en" style="background-image: linear-gradient(225deg, #B165FD, #FE5F7C);">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Log In</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;700&display=swap" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    </head>
    <?php
        session_start();
        $username = $_POST['username'];
        $password = $_POST['passwd'];
        if (isset($_POST['SignUp'])) {
            header('Location: SignUp.php');
        }
        else if (isset($_POST['LogIn'])) {
            $username = $_POST['username'];
            $password = $_POST['passwd'];
        
            // Perform a database query to check if the username exists
            $query = "SELECT User_ID, Username, password FROM login WHERE username = ?";
            $stmt = $mysqli->prepare($query);
        
            if ($stmt) {
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $stmt->store_result();
        
                if ($stmt->num_rows > 0) {
                    $stmt->bind_result($user_id, $dbUsername, $dbPassword);
                    $stmt->fetch();
        
                    // Verify the password
                    if ($password==$dbPassword) {
                        // Password is correct
        
                        // Store the user's ID in the session to indicate they are logged in
                        $_SESSION['user_id'] = $user_id;
                        // Prepare an SQL query to retrieve the Member_Flag column
                        $sql = "SELECT Member_Flag FROM user WHERE User_ID = ?";

                        // Create a prepared statement
                        $stmt = $mysqli->prepare($sql);

                        // Bind the user ID to the query
                        $stmt->bind_param("i", $user_id);

                        // Execute the query
                        $stmt->execute();

                        // Bind the result to a variable
                        $stmt->bind_result($memberFlag);

                        // Fetch the result
                        if ($stmt->fetch()) {
                            // Check the value of Member_Flag
                            if ($memberFlag == 1) {
                                // Redirect to Member.php if the user is a member
                                $_SESSION['username']=$username;
                                $_SESSION['userType']="Member";
                                /*
                                $sqlmem="SELECT Member_Type, Member_Faculty, Member_Year from user WHERE User_ID = ?";
                                $stmtmem=$mysqli->prepare($sqlmem);
                                $stmtmem->bind_param("i", $user_id);
                                $stmtmem->execute();
                                $stmtmem->bind_result($memberType,$faculty,$doe);
                                if($memberType==1){
                                    $_SESSION['memberType']="Student";
                                }
                                if($memberType==2){
                                    $_SESSION['memberType']="Professor";
                                }
                                if($memberType==3){
                                    $_SESSION['memberType']="Faculty";
                                }
                                $_SESSION['faculty']=$faculty;
                                $_SESSION['doe']=$doe;
                                */
                                header('Location: Member.php');
                            } else {
                                // Redirect to User.php if the user is not a member (0=user)
                                $_SESSION['username']=$username;
                                $_SESSION['userType']="General";
                                header('Location: User.php');
                            }
                            exit(); // Make sure no further code is executed
                        } else {
                            // Handle the case where the query didn't return any results or an error occurred
                            // You can display an error message or redirect to an appropriate page
                            $popMessage = "Error. Could not find match in database";
                        }
                        // Redirect to the user's profile or dashboard
                        header('Location: LogIn.php'); // Replace with the actual destination page
                        exit();
                    } else {
                        // Password is incorrect
                        $popMessage = "Incorrect password. Please try again.";
                    }
                } else {
                    // Username does not exist
                    $popMessage = "Username not found. Please try again or sign up.";
                }
        
                $stmt->close();
            } else {
                $popMessage = "Error preparing statement: " . $mysqli->error;
            }
        }
        
        // Close the database connection
        $mysqli->close();
    ?>

    <body class="login">
        <div class="row">
            <div style="width: 50%;">
                <img src="pictures\CSS326BasedLib.png" alt="Logo"
                    style="height: 46vh; position: relative; top: 6vh; left: 6vw">
            </div>
                <form action="" method="post" class="login-panel">
                <div class="row login">
                    <div class="column">
                        <label for="username" class="login-label">Username</label>
                        <input type="text" name="username" id="username" class="text-field login" />
                    </div>
                </div>
                <div class="row login">
                    <div class="column">
                    <label for="passwd" class="login-label">Password</label>
                    <input type="password" name="passwd" id="passwd" class="text-field login" />
                    </div>
                    
                </div>


                <input type="submit" class="btn-login" name="LogIn" value="LOG IN" style="background-color: #4CA82C;" onclick="PopUp()">
                <p> Doesn't have an account yet?</p>
                <input type="submit" class="btn-login" name="SignUp" value="SIGN UP" style="background-color: #B165FD;">
            </form>
        </div>
        <div class="overlay" id="overlay"></div>
        <div class="popup" id="popup">
            <?php echo $popMessage; ?>
            <button onclick="PopDown()">Close</button>
        </div>
    </body>
</html>
<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Manage Admin</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;700&display=swap" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    </head>

    <body class="center">
        <div class="headbar">
            <img src="pictures\CSS326BasedLib.png" alt="Logo">
            <div class="greet-text">
                <p>Manage Admin</p><br>
            </div>
        </div>
        <form action="" class="popup center column add-admin" id="popup" method="post">
            <div class="row">
                <h1>Add an Admin</h1>
            </div>
            <div class="row">
                <div class="column">
                    <h2>Username</h2>
                    <input type="text" id="admuser" name="admuser" required>
                    <h2>Password</h2>
                    <input type="Password" id="admpasswd" name="admpasswd" required>
                </div>
                
            </div>
            <input type="submit" value="Confirm" style="color: #4CA82C">
            <input type="button" value="Cancel" style="color: #E46060" onclick="PopDown()">
        </form>

        <div class="manage-panel">
            <button class="add" onclick="PopUp()">
                <img src="pictures\add_icon_big.png" alt="" class="add-icon">
                <label for="">Add</label>
            </button>
            <div id="" class="admin">
                <!--%%%%% Main block %%%%-->
                <table style="width:96%;">
                    <col width="98%">
                    <col width="1.5%">
                    <col width="0.5%">
                    <?php
                        $q2 = "select username from user where admin_flag = 1";
                        $result = $mysqli->query($q2);
                        if (!$result) {
                            echo "Select failed. Error: " . $mysqli->error;
                            return false;
                        }
                        while ($row = $result->fetch_array()) { ?>
                            <tr>
                                <td>
                                    <p>
                                        <?= $row[0] ?>
                                    </p>
                                </td>
                                <td>
                                    <a href='ManageAdmin.php?Username=<?= $row[0] ?>'>
                                        <p>Remove</p>
                                    </a>
                                </td>
                            </tr>
                    <?php } 
                    
                        $Username = $_GET['Username'];
                        if (isset($Username)) {
                            // $q="UPDATE user SET Admin_Flag = 0 WHERE Username = '$Username'";
                            // if($mysqli->query($q)) {
                            //     echo "DELETE success. Error: ".$mysqli->error ;
                            // }
                            // //redirect
                            // header("Location: ManageAdmin.php");
                            // unset($Username);   
                            // exit();
                            
                            $q = "UPDATE user SET Admin_Flag = 0 WHERE Username = '$Username'";
                            if ($mysqli->query($q)) {
                                $_SESSION['popMessage'] =  "$Username's Admin flag has been removed";
                                echo '<div style="display: flex; background-color: #4CA82C;" class="popError center column" id="popup">' .
                                    '<h2>' . $_SESSION['popMessage'] . '</h2>' .
                                    '<input type="button" value="Close" onclick="gotoPage(\'ManageAdmin.php\')">' . '</div>' .
                                    '<div style="display: flex; margin: -30vw;" class="overlay" id="overlay"></div>';
                            } else {
                                $_SESSION['popMessage'] =  "Update failed: " . $mysqli->error;
                                echo '<div style="display: flex; background-color: #E46060;" class="popError center column" id="popup">' .
                                    '<h2>' . $_SESSION['popMessage'] . '</h2>' .
                                    '<input type="button" value="Close" onclick="gotoPage(\'ManageAdmin.php\')">' . '</div>' .
                                    '<div style="display: flex; margin: -30vw;" class="overlay" id="overlay"></div>';
                            }
                        }
                    ?>
                </table>
            </div>
        </div>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['admuser'], $_POST['admpasswd']) && !empty($_POST['admuser']) && !empty($_POST['admpasswd'])) {
                    // Retrieve username and password from the form
                    $username = $_POST['admuser'];
                    $password = $_POST['admpasswd'];

                    // Prepare and execute a query to retrieve User_ID and hashed password from login table
                    $stmt = $mysqli->prepare("SELECT User_ID, password FROM login WHERE Username = ?");
                    $stmt->bind_param("s", $username);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows >= 1) {
                        $row = $result->fetch_assoc();
                        $hashedPasswordFromDB = $row['password'];
                        $user_id = $row['User_ID'];

                        // Verify the provided password with the hashed password from the database
                        if (password_verify($password, $hashedPasswordFromDB)) {
                            // Passwords match, proceed with updating Admin_Flag

                            // Update Admin_Flag in the user table
                            $update_stmt = $mysqli->prepare("UPDATE user SET Admin_Flag = 1 WHERE User_ID = ?");
                            $update_stmt->bind_param("i", $user_id);
                            $update_success = $update_stmt->execute();

                            if ($update_success) {
                                $_SESSION['popMessage'] =  "Admin flag updated successfully for User_ID: $user_id";
                                echo '<div style="display: flex; background-color: #4CA82C;" class="popError center column" id="popup">' .
                                    '<h2>' . $_SESSION['popMessage'] . '</h2>' .
                                    '<input type="button" value="Close" onclick="gotoPage(\'ManageAdmin.php\')">' . '</div>' .
                                    '<div style="display: flex; margin: -20vw;" class="overlay" id="overlay"></div>';
                                unset($_SESSION['popMessage']);
                            } else {
                                $_SESSION['popMessage'] =  "Failed to update admin flag for User_ID: $user_id";
                                echo '<div style="display: flex; background-color: #E46060;" class="popError center column" id="popup">' .
                                    '<h2>' . $_SESSION['popMessage'] . '</h2>' .
                                    '<input type="button" value="Close" onclick="gotoPage(\'ManageAdmin.php\')">' . '</div>' .
                                    '<div style="display: flex; margin: -20vw;" class="overlay" id="overlay"></div>';
                                unset($_SESSION['popMessage']);
                            }

                            $update_stmt->close();
                        } else {
                            $_SESSION['popMessage'] =  "Invalid Username or Password.";
                            echo '<div style="display: flex; background-color: #E46060;" class="popError center column" id="popup">' .
                                '<h2>' . $_SESSION['popMessage'] . '</h2>' .
                                '<input type="button" value="Close" onclick="gotoPage(\'ManageAdmin.php\')">' . '</div>' .
                                '<div style="display: flex; margin: -20vw;" class="overlay" id="overlay"></div>';
                            unset($_SESSION['popMessage']);
                        }
                    } else {
                        $_SESSION['popMessage'] =  "Invalid Username or Password.";
                        echo '<div style="display: flex; background-color: #E46060;" class="popError center column" id="popup">' .
                            '<h2>' . $_SESSION['popMessage'] . '</h2>' .
                            '<input type="button" value="Close" onclick="gotoPage(\'ManageAdmin.php\')">' . '</div>' .
                            '<div style="display: flex; margin: -20vw;" class="overlay" id="overlay"></div>';
                        unset($_SESSION['popMessage']);
                    }

                    // Close statement and connection
                    $stmt->close();
                } else {
                    $_SESSION['popMessage'] =  "All fields are required.";
                        echo '<div style="display: flex; background-color: #E46060;" class="popError center column" id="popup">' .
                        '<h2>' . $_SESSION['popMessage'] . '</h2>' .
                        '<input type="button" value="Close" onclick="gotoPage(\'ManageAdmin.php\')">' . '</div>' .
                        '<div style="display: flex; margin: -20vw;" class="overlay" id="overlay"></div>';
                    unset($_SESSION['popMessage']);
                }
            }
        ?>


        <script src="script.js"></script>       
    </body>
</html>
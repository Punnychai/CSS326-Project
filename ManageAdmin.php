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

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['admuser'], $_POST['admpasswd']) && !empty($_POST['admuser']) && !empty($_POST['admpasswd'])) {
                // Retrieve username and password from the form
                $username = $_POST['admuser'];
                $password = $_POST['admpasswd'];

                // Prepare and execute a query to retrieve User_ID from login table
                $stmt = $mysqli->prepare("SELECT User_ID FROM login WHERE Username = ? AND Password = ?");
                $stmt->bind_param("ss", $username, $password);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows === 1) {
                    // Fetch the User_ID from the login table
                    $row = $result->fetch_assoc();
                    $user_id = $row['User_ID'];

                    // Update Admin_Flag in the user table
                    $update_stmt = $mysqli->prepare("UPDATE user SET Admin_Flag = 1 WHERE User_ID = ?");
                    $update_stmt->bind_param("i", $user_id);
                    $update_success = $update_stmt->execute();

                    if ($update_success) {
                        echo "Admin flag updated successfully for User_ID: $user_id";
                    } else {
                        echo "Failed to update admin flag for User_ID: $user_id";
                    }
                    
                    $update_stmt->close();
                } else {
                    echo "Invalid username or password";
                }

                // Close statement and connection
                //$stmt->close();
            } else {
                echo "Please provide both username and password";
            }
        }
    ?>

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
            <input type="submit" value="Confirm" style="color: green">
            <input type="button" value="Cancel" style="color: red" onclick="PopDown()">
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
                            $q="UPDATE user SET Admin_Flag = 0 WHERE Username = '$Username'";
                            if(!$mysqli->query($q)){
                                echo "DELETE failed. Error: ".$mysqli->error ;
                            }
                            //redirect
                            header("Location: ManageAdmin.php");
                            unset($Username);
                            exit();
                        }
                    ?>
                </table>
            </div>
        </div>

        <script src="script.js"></script>       
    </body>
</html>
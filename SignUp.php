<!DOCTYPE html>
<html lang="en">
    <?php
        session_start();
            if (isset($_POST['SignUp'])) {
                $userType = $_POST['utype'];
                $fname=$_POST['fname'];
                $lname=$_POST['lname'];
                $dob=$_POST['dob'];
                $username=$_POST['username'];
                if($_POST['passwd']==$_POST['cfmpasswd']){
                    $password=$_POST['passwd'];
                }
                else {
                    // Passwords don't match, display an error message
                    echo '<script>
                        alert("Passwords do not match. Please re-enter your password.");
                        window.location = "SignUp.php"; // Redirect back to the signup page
                    </script>';
                    exit(); // Exit the script to prevent further execution
                }
                // Store user data in $_SESSION
                $_SESSION['userType'] = $userType;
                $_SESSION['fname'] = $fname;
                $_SESSION['lname'] = $lname;
                $_SESSION['dob'] = $dob;
                $_SESSION['username']=$username;
                $_SESSION['passwd']=$password;
                $_SESSION['signup'] = true;
                if ($userType == "member") {
                    if (isset($_POST['memberType'])) {
                        // Capture and store additional member-specific data in $_SESSION
                        $memberType = $_POST['memberType'];
                        $faculty = $_POST['faculty'];
                        $doe = $_POST['doe'];

                        $_SESSION['memberType'] = $memberType;
                        $_SESSION['faculty'] = $faculty;
                        $_SESSION['doe'] = $doe;
                        header('Location: Member.php');
                        exit(); // make sure that no further code is executed
                    }
                    else {
                        echo '<script>   /* popup window */
                            alert("You are a member!\nPlease select one member type.");
                        </script>';
                    }
                    
                }
                else {
                    header('Location: User.php');
                }
                
            }
        ?>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Sign Up</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;700&display=swap" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    </head>

    <body>
        
        <form action="" method="post">
            <div class="row">
                <div class="column">
                    <img src="pictures\CSS326BasedLib.png" alt="" style="height: 19vh; display: block; margin-left: auto; margin-right: auto;"><br>
                    <label for="fname">First Name</label><br />
                    <input type="text" name="fname" id="fname" class="text-field" required /><br />
                    <label for="lname">Last Name</label><br />
                    <input type="text" name="lname" id="lname" class="text-field" required /><br />
                    <label>User Type</label><br />
                    <select name="utype" id="utype">
                        <option value="general">General User</option>
                        <option value="member">Member</option>
                    </select><br />
                    <label for="dob">Date of Birth</label><br />
                    <input type="date" name="dob" id="dob" required/>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        // Get a reference to the "User Type" select element
                        var utypeSelect = document.getElementById("utype");
                        // Get a reference to the "MEMBERSHIP INFORMATION" section
                        var membershipInfo = document.querySelector(".membershipInfo");

                        membershipInfo.style.opacity = 0;   // DEFAULT -> Invisible Member Info
                        // Add an event listener to the "User Type" select element
                        utypeSelect.addEventListener("change", function() {
                            if (utypeSelect.value === "member") {
                                membershipInfo.style.opacity = 1;
                            }
                            if (utypeSelect.value === "general") {
                                membershipInfo.style.opacity = 0;
                            }
                        });
                    });
                </script>

                <div class="column" style="margin-left: 10vw;">
                    <div class="columnn membershipInfo">
                        <label>MEMBERSHIP INFORMATION</label><br />
                        <input type="radio" name="memberType" id="student" class="radio-btn" value="Student"/>
                        <label for="student" class="member-type-label">Student</label><br />
                        <input type="radio" name="memberType" id="professor" class="radio-btn" value="Professor"/>
                        <label for="professor" class="member-type-label">Professor</label><br />
                        <input type="radio" name="memberType" id="faculty_member" class="radio-btn" value="Faculty"/>
                        <label for="faculty_member" class="member-type-label">Faculty Member</label><br />
                    </div>
                    <div class="row selection-bar">
                        <div class="column selection-col">
                            <label for="faculty">Faculty</label><br />
                            <select name="faculty" id="faculty">
                                <option value="Option 1">Option 1</option>
                                <option value="Option 2">Option 2</option>
                            </select>
                        </div>
                        <div class="column selection-col">
                            <label for="doe">Enrolled Year</label><br />
                            <input type="date" name="doe" id="doe" required />
                        </div>
                    </div>
                    <hr />
                    <label for="username">Create Username</label><br />
                    <input type="text" name="username" id="username" class="text-field" required /><br />
                    <label for="passwd">Create Password</label><br />
                    <input type="password" name="passwd" id="passwd" class="text-field" required /><br />
                    <label for="cfmpasswd">Confirm Password</label><br />
                    <input type="password" name="cfmpasswd" id="cfmpasswd" class="text-field" required /><br />
                </div>
            </div>
            <div class="row">
                    <input type="submit" class="btn-signup" name="SignUp" value="SIGN UP" style="text-align: center">
                </div>
        </form>
    </body>
</html>
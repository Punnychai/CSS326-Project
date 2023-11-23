<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Sign Up</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;700&display=swap" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    </head>
    <?php
        session_start();
        if (isset($_POST['SignUp'])) {
            // Store user data in $_SESSION
            $_SESSION['userType'] = $_POST['utype'];
            $_SESSION['fname'] = $_POST['fname'];
            $_SESSION['lname'] = $_POST['lname'];
            $_SESSION['dob'] = $_POST['dob'];
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['signup'] = true;
            
            if($_POST['passwd'] == $_POST['cfmpasswd']){
                $_SESSION['passwd'] = $_POST['passwd'];
            }
            else {
                // Passwords don't match, display an error message
                echo '<script>
                    alert("Passwords do not match. Please re-enter your password.");
                    window.location = "SignUp.php"; // Redirect back to the signup page
                </script>';
                exit(); // Exit the script to prevent further execution
            }
            
            if ($_SESSION['userType'] == "member") {
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

    <body>
        <form action="" method="post">
            <div class="row">
                <div class="column">
                    <a href="LogIn.php">
                        <img src="pictures\CSS326BasedLib.png" alt="Logo" style="height: 19vh; display: block; margin-left: auto; margin-right: auto;"><br>
                    </a>
                    <label for="fname">First Name</label><br />
                    <input type="text" name="fname" id="fname" class="text-field" required /><br />
                    <label for="lname">Last Name</label><br />
                    <input type="text" name="lname" id="lname" class="text-field" required /><br />
                    <label>User Type</label><br />
                    <select name="utype" id="utype" onchange="handleUserTypeChange()">
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
                        // I need to use 2 vars since querySelector can only select one element  - PUNNYCHAI
                        var memberInfo1 = document.querySelector(".memberInfo1");
                        var memberInfo2 = document.querySelector(".memberInfo2");

                        memberInfo1.style.opacity = 0;   // DEFAULT -> Invisible Member Info
                        memberInfo2.style.opacity = 0;
                        // Add an event listener to the "User Type" select element
                        utypeSelect.addEventListener("change", function() {
                            if (utypeSelect.value === "member") {
                                memberInfo1.style.opacity = 1;
                                memberInfo2.style.opacity = 1;
                            }
                            if (utypeSelect.value === "general") {
                                memberInfo1.style.opacity = 0;
                                memberInfo2.style.opacity = 0;
                            }
                        });
                    });
                </script>

                <div class="column" style="margin-left: 10vw;">
                    <div class="columnn memberInfo1">
                        <label>MEMBERSHIP INFORMATION</label><br />
                        <input type="radio" name="memberType" id="student" class="radio-btn" value="Student"/>
                        <label for="student" class="member-type-label">Student</label><br />
                        <input type="radio" name="memberType" id="professor" class="radio-btn" value="Professor"/>
                        <label for="professor" class="member-type-label">Professor</label><br />
                        <input type="radio" name="memberType" id="faculty_member" class="radio-btn" value="Faculty"/>
                        <label for="faculty_member" class="member-type-label">Faculty Member</label><br />
                    </div>
                    <div class="row selection-bar memberInfo2">
                        <div class="column selection-col">
                            <label for="faculty">Faculty</label><br />
                            <select name="faculty" id="faculty">
                                <option value="Option 1">SIIT</option>
                                <option value="Option 2">Others</option>
                            </select>
                            <hr />
                        </div>
                        <div class="column selection-col">
                            <label for="doe">Enrolled Year</label><br />
                            <input type="date" name="doe" id="doe" />
                            <hr />
                        </div>

                        <script>
                            function handleUserTypeChange() {
                                var utypeSelect = document.getElementById("utype");
                                var doeInput = document.getElementById("doe");

                                // Check if the selected value is "member"
                                if (utypeSelect.value === "member") {
                                    doeInput.required = true;
                                } else {
                                    doeInput.required = false;
                                }
                            }
                        </script>
                    </div>
                    
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
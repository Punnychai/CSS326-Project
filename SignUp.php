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

    <body>
        <div class="row">
            <form action="MemberCheck.php" method="post">
                <div class="column">

                    <label for="">First Name</label><br />
                    <input type="text" name="fname" id="fname" class="text-field" /><br />
                    <label for="">Last Name</label><br />
                    <input type="text" name="lname" id="lname" class="text-field" /><br />
                    <label for="">User Type</label><br />
                    <select name="utype" id="utype">
                        <option value="general">General User</option>
                        <option value="member">Member</option>
                    </select><br />
                    <label for="">Date of Birth</label><br />
                    <input type="date" name="dob" id="dob" />
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
                <div class="column">
                    <div class="columnn membershipInfo">
                        <label for="">MEMBERSHIP INFORMATION</label><br />      <!-- This can be left blank if user is not a member -->
                        <input type="radio" name="member_type" id="student" class="radio-btn"/>
                        <label for="" class="member-type-label">Student</label><br />
                        <input type="radio" name="member_type" id="professor" class="radio-btn"/>
                        <label for="" class="member-type-label">Professor</label><br />
                        <input type="radio" name="member_type" id="faculty_member" class="radio-btn"/>
                        <label for="" class="member-type-label">Faculty Member</label><br />
                    </div>
                    <div class="row">
                        <div class="column">
                            <label for="">Faculty</label><br />
                            <select name="faculty" id="faculty">
                                <option value="">Option 1</option>
                                <option value="">Option 2</option>
                            </select>
                        </div>
                        <div class="column">
                            <label for="">Enrolled Year</label><br />
                            <input type="date" name="doe" id="doe" />
                        </div>
                    </div>
                    <hr />
                    <label for="">Create Password</label><br />
                    <input type="text" name="" id="" class="text-field" /><br />
                    <label for="">Confirm Password</label><br />
                    <input type="text" name="" id="" class="text-field" /><br />
                </div>
                <div style="text-align: center">
                    <input type="submit" class="btn-signup" name="SignUp" value="SIGN UP">
                </div>
            </form>
        </div>
    </body>
</html>
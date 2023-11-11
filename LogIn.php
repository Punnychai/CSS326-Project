<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en" style="background-image: linear-gradient(225deg, #B165FD, #FE5F7C);">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Log In</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;700&display=swap" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
</head>
<?php
if (isset($_POST['SignUp'])) {
    header('Location: SignUp.php');
} else if (isset($_POST['LogIn'])) {
    /* session_start();

    the username exists {
        password is correct {
            user is member {

            }
            user is general user {

            }
        }
        password is incorrect {
            
        }
    }
    username doesn't exist {

    } */

}
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


            <input type="submit" class="btn-login" name="LogIn" value="LOG IN" style="background-color: #4CA82C;">
            <p> Doesn't have an account yet?</p>
            <input type="submit" class="btn-login" name="SignUp" value="SIGN UP" style="background-color: #B165FD;">
        </form>
    </div>
</body>

</html>
<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Log In</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;700&display=swap" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    </head>

    <body>
        <div class="row" style="padding-top: 12vh;">
            <div style="width: 50%;">
                <img src="pictures\CSS326BasedLib.png" alt="Logo" style="height: 46vh; position: relative; top: 6vh; left: 6vw">
            </div>
            <div style="width: 35%; background: white; border-radius: 4vh; padding: 3%;">
                <form action="" method="post">
                    <label for="username">Username</label><br />
                    <input type="text" name="username" id="username" class="text-field" required /><br />
                    <label for="passwd">Password</label><br />
                    <input type="password" name="passwd" id="passwd" class="text-field" required /><br />
                    <input type="submit" class="btn-login" name="LogIn" value="LOG IN">
                    <p> Doesn't have an account yet?</p>
                    <input type="submit" class="btn-login" name="SignUp" value="SIGN UP">
                </form>
            </div>
        </div>
    </body>
    
</html>

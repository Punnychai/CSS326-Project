<div class="headbar row">
    <img src="pictures\CSS326BasedLib.png" alt="Logo">
    <div class="greet-text">
        <?php
            session_start();
            // Use a prepared statement to prevent SQL injection
            $getName = "SELECT User_FName, User_LName FROM user WHERE Username = ? LIMIT 1";
            $stmt = $mysqli->prepare($getName);

            // Bind the session username as a parameter
            $stmt->bind_param("s", $_SESSION['username']);

            // Execute the query & Bind the result to variables
            $stmt->execute();
            $stmt->bind_result($userFName, $userLName);

            // Fetch & Output the result, then close the statement.
            $stmt->fetch();
            echo "<p>Welcome, " . $userFName . " " . $userLName . "!</p><br>";
            $stmt->close();
        ?>
    </div>
</div>
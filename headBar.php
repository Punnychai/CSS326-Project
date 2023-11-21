<div class="headbar row">
    <img src="pictures\CSS326BasedLib.png" alt="Logo">
    <div class="greet-text">
        <?php
            session_start();

            // Use a prepared statement to prevent SQL injection
            $getName = "SELECT User_FName, User_LName FROM user WHERE Username = ? LIMIT 1";
            $stmt = $mysqli->prepare($getName);

            if ($stmt) {
                // Bind the session username as a parameter
                $stmt->bind_param("s", $_SESSION['username']);

                // Execute the query & Bind the result to variables
                $stmt->execute();
                $stmt->bind_result($userFName, $userLName);

                // Fetch the result
                $stmt->fetch();

                if ($userFName && $userLName) {
                    // If the user's name is retrieved, display the welcome message
                    echo "<p>Welcome, " . $userFName . " " . $userLName . "!</p><br>";
                } else {
                    // If the query returns an empty result set, display a default welcome message
                    echo "<p>Welcome!</p><br>";
                }
                
                $stmt->close();
            } else {
                // If the query fails, echo a default welcome message
                echo "<p>Welcome!</p><br>";
            }
        ?>
    </div>
</div>

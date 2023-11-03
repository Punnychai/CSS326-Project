<?php
    // Database connection details
    $host = "localhost";    // MySQL server hostname
    $username = "root";     // MySQL username
    $password = "root";     // MySQL password
    $database = "mockup";   // database name

    // Create a database connection
    $mysqli = new mysqli($host, $username, $password, $database);

    // Check the connection
    if ($mysqli -> connect_error) {
        die("Connection failed: " . $mysqli -> connect_error);
    }
?>
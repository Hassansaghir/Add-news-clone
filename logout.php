<?php
        session_start(); // Start the session

        // Clear all session variables
        session_unset();
        
        // Destroy the session
        session_destroy();
        
        // Redirect to the login page
        header("Location: login.php"); // Replace "login.php" with your actual login page URL
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
</head>
<body>
</body>
</html>
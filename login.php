<?php 
    $username = "Hassan";
    $password = "Work";
    $error="";
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Take the input by post superglobal:
    $userText = $_POST["usernameInput"];
    $passText = $_POST["passwordInput"]; 
    if (isset($_POST["submit"])) {
        //Test if the informations are equals:
            if($userText == $username && $passText == $password ){
                session_start();
                $_SESSION['login']="login";
                //Redirect to another page if the password is correct
                header("Location: ../Control panel\controlPanel.php");
                exit(); //Make sure to exit after sending the header
            }
            else {
                // Echo an error message
                $error="Error in username or password";
                } 
        }
    if (isset($_POST["reset"])) {
        // Clear the username and password values
        $userText = "";
        $passText = "";
        $error="";
    } 
     }     
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Stylessheet/loginn.css">
    <title>Login</title>
</head>
<body>
    <form action="login.php" method="post">
        <div class="container">
            <div class="lgPara">
                <h1>LOGIN HERE</h1>
            </div>
            <div class="In">
                <label for="Username">Username:</label>
                <input type="text" name="usernameInput">
            </div>
            <div class="In">
                <label for="password">Password:</label>
                <input type="password" name="passwordInput">
            </div>
            <div class="buttons">
                <input type="submit" name="submit">
                <input type="submit" value="Reset" name="reset">
            </div>
            <div>
                <?php echo "<p style='color:white'>$error</p>";
                ?>
            </div>
        </div>
    </form>
</body>
</html>
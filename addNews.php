<?php 
//Check if the session is the same or not
session_start();
    if (!isset($_SESSION['login'])) {
        header("location: ../login/login.php");
    }
//Include the database file
include '../database/database.php';
//intialize a variables
$title='';
$desc='';
$type='';
$Noerror='';
//check if reset is clicked
if(isset($_POST["reset"])){
$title='';
$desc='';
$type='';
$Noerror='';
}
//check if submit is click
if(isset($_POST["submit"])){
    //check if all input are not empty
    if (isset($_POST['titleText']) && !empty($_POST['titleText']) &&
    isset($_POST['textArea']) && !empty($_POST['textArea']) && isset($_POST['checkbox']) && isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK){
    //Check the connection
    if($conn->connect_error){
        die("Database connection failed". $conn->connect_error);
    }
    else{
        $Noerror="Submited!!";
    }
        // Get the last inserted custom ID
        $getLastIdQuery = "SELECT MAX(number) AS last_id FROM list";
        $result = $conn->query($getLastIdQuery);

        if ($result && $row = $result->fetch_assoc()) {
            $lastId = $row['last_id'];
            $nextId = $lastId + 1;
        } else {
            $nextId = 1; // Start from 1 if there are no existing rows
        }
        //for image and save it in images files
        $file=$_FILES['img']['name'];   
        $tmp_name=$_FILES['img']['tmp_name'];

        // Extract the original file extension
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        // Generate a new name for the image (you can customize the logic as needed)
        $newName = $nextId . '.' . $extension;
        $folder="../Images/". $newName;
        move_uploaded_file($tmp_name,$folder);
    //Take the values from inputs 
    $title = $_POST['titleText'];
    $desc = $_POST['textArea'];
    $type = $_POST['selected_option'];
    //Add to database
    $sql="INSERT INTO list (number,title,Description,type,img) VALUES('$nextId','$title','$desc','$type','$folder')";
    mysqli_query($conn,$sql);
}
    else{
        $Noerror="Please check the fields";
    }
    echo $Noerror;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Stylessheet/addNews.css">
</head>
<body>
    <form action="addNews.php" method="post" enctype="multipart/form-data">
        <table class="area">
            <tr>
                <td><label for="Title">Title:</label></td>
                <td><input type="text" name="titleText" placeholder="Enter the title here" ></td>
            </tr>
            <tr>
                <td class="align"><label for="Desc">Description:</label></td>
                <td><textarea name="textArea" cols="30" rows="10" placeholder="Enter your news here" ></textarea></td>
            </tr>
            <tr>
                <td><label for="publish">Publish Directly:</label></td>
                <td><input type="checkbox" name="checkbox"></td>
            </tr>
            <tr>
                <td><label for="Type">Type:</label></td>
                <td><select name="selected_option" required>
                <option disabled selected hidden value="">Select an option</option>
                    <option value="economic">Economic</option>
                    <option value="Technology">Technology</option>
                </td>
            </tr>
            <tr>
                <td><label for="Image"> Upload Image:</label></td>
                <td><input type="file" name="img"></td>
            </tr>
        </table>
        <div class="buttons">
                <input type="submit" value="submit" name="submit">
                <input type="submit" value="reset" name="reset">
        </div>
    </form>
    <div>
            <button class="goback"><a href="../Control panel/controlPanel.php">Go back</a></button>
        </div>
</body>
</html>
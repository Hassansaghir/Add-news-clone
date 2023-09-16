<?php
session_start();
$id1=$_SESSION['id2'];
//Include the database file
include '../database/database.php';
//Take the values from inputs 
$title = $_POST['titleText'];
$desc = $_POST['textArea'];
$type = $_POST['select_name'];
//check if there is an file uploaded to change the link
if(isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK){

      //for image and save it in images files
      $file=$_FILES['img']['name'];   
      $tmp_name=$_FILES['img']['tmp_name'];

      // Extract the original file extension
      $extension = pathinfo($file, PATHINFO_EXTENSION);
      // Generate a new name for the image (you can customize the logic as needed)
      $newName = $id1 . '.' . $extension;
      $folder="../Images/".$newName;
      move_uploaded_file($tmp_name,$folder);
      //update the image link in sql
      $sql3="UPDATE `list` SET  img='$folder' WHERE list.number = $id1;";
      $conn->query($sql3);

}

    $sql2="UPDATE `list` SET title = '$title', Description = '$desc', type =' $type' WHERE list.number = $id1;";
   if ($conn->query($sql2) === TRUE) {
        echo "Record updated successfully";
    } else {
        
        echo "Error updating record: " . $conn->error;
    }
    header("location: ListNews.php");
?>
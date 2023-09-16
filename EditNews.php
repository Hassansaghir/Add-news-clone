<?php 
session_start();
$_SESSION['id2']=$_POST['hidden1'];
//Include the database file
include '../database/database.php';
//intialize a variables
$title='';
$desc='';
$type='';
$Noerror='';

//for show the old values
$id=$_POST['hidden1'];
$q3="SELECT title,Description,type,img FROM list WHERE number=$id";
$result=mysqli_query($conn,$q3);
while($row=mysqli_fetch_assoc($result)){
    $Temptitle=$row['title'];
    $Tempdesc=$row['Description'];
    $Temptype=$row['type'];
    $Tempimg=$row['img'];
}
//For option selected 
$options = array("technology", "economic");
$selectedOption = $Temptype; // This is the selected option

if(isset($_POST["submit"])){
//Check the connection
if($conn->connect_error){
    die("Database connection failed". $conn->connect_error);
}
else{
    $Noerror="EDITED!!";
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
    <form action="EditNews-inc.php" method="post" enctype="multipart/form-data">
        <table class="area">
            <tr>
                <td><label for="Title">Title:</label></td>
                <td><input type="text" name="titleText" placeholder="Enter the title here" value="<?php echo $Temptitle; ?>"></td>
            </tr>
            <tr>
                <td class="align"><label for="Desc">Description:</label></td>
                <td><textarea name="textArea" cols="30" rows="10" placeholder="Enter your news here" value=""><?php echo $Tempdesc; ?></textarea></td>
            </tr>
            <tr>
                <td><label for="publish">Publish Directly:</label></td>
                <td><input type="checkbox" name="checkbox" checked></td>
            </tr>
            <tr>
                <td><label for="Type">Type:</label></td>
                <td>
                    <?php
                            // Assuming you have an array of options and a PHP variable for the selected option
                            $options = array("technology", "economic");
                            $selectedOption =$Temptype; // This is the selected option

                            // Start HTML form
                            echo '<select name="select_name">';

                            // Loop through the options and create <option> tags
                            foreach ($options as $option) {
                                echo '<option value="' . $option . '"';
                                if ($option === $selectedOption) {
                                    echo ' selected';
                                }
                                echo '>' . $option . '</option>';
                            }

                            // Close the select and form tags
                            echo '</select>';

                    ?>

                </td>
            </tr>
            <tr>
                <td><label for="Image">Image:</label></td>
                <td>
                    <img src="<?php echo $Tempimg ?>" height="100px"width='100px'>
                </td>
                <td>
                    <input type="file" name="img"></td>
            </tr>
        </table>
        <div class="buttons">
        <input name="hidden" value="<?php $id;?>" type="hidden">
            <input type="submit" value="Edit" name="submit">
        </div>
    </form>
</body>
</html>
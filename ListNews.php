<?php
//Check if the session is the same or not
session_start();
    if (!isset($_SESSION['login'])) {
        header("location: ../login/login.php");
    }
    $dbHost="localhost";
    $dbUser="hasan";
    $dbPass="123456";
    $dbName="php_dev";
    //Connection to database
    $conn = new mysqli($dbHost,$dbUser, $dbPass,$dbName);

//// querry
$q=' SELECT * FROM  list';

//result
$r=mysqli_query($conn,$q);

// way to display res
$r2=mysqli_fetch_all($r,MYSQLI_ASSOC);
//check if delete is clicked
if(isset($_POST['delete'])){
    //take the number of this buttun
    $id=$_POST['hidden'];
    //write a query to delete
    $q2="DELETE FROM `list` WHERE `list`.`number` = $id";
    mysqli_query($conn,$q2);
    //write a query to decrement the number of news:
        $q3="UPDATE list SET number = number - 1 WHERE number > $id";
        mysqli_query($conn,$q3);
    //refresh the page
    header("location: ListNews.php");
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Stylessheet/listNews.css">
</head>
<body>
<table border="1">
    <?php 
         // Table header
    echo '<tr>';
    echo '<th>number</th>';
    echo '<th>title</th>';
    echo '<th>description</th>';
    echo '<th>type</th>';
    echo '<th>image</th>';
    echo '<th>action</th>';
    echo '</tr>';
    ?>
    <?php foreach($r2 as $r2){?>

   <tr>
    <td>
        <?php echo $r2['number'] ; ?>
    </td>
    <td>
        <?php echo $r2['title'] ; ?>
    </td>
    <td>
        <?php echo $r2['Description'] ; ?>
    </td>
    <td>
        <?php echo $r2['type'] ; ?>
    </td>
    <td>
        <?php
        echo "<img src=".$r2['img']." height='100px' width='100px'>"; 
        ?>
    </td>
    <td>
        <form action="EditNews.php" method="post" class="left">
            <input name="hidden1" value="<?php echo $r2['number'];?>" type="hidden">
            <input type="submit" value="Edit" name="edit" class="edit-button">
        </form>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];  ?>">  
            <input name="hidden" value="<?php echo $r2['number'];?>" type="hidden">
            <input type="submit" value="delete" name="delete" class="delete-button">        
        </form>
        
    </td>
    </tr>
   <?php   } ?>

</table>
<div>
            <button><a href="../Control panel/controlPanel.php">Go back</a></button>
        </div>
</body>
</html>
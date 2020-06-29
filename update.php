<?php
session_start();
 include_once ('config.php');
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$currentuser=$_SESSION["username"];

//Add to the counter
if(isset($_POST['add'])){

// Attempt update query execution
$update = "UPDATE users SET counter = counter + 1 WHERE username='$currentuser'";
if(mysqli_query($link, $update)){
    echo "Records were updated successfully.";
      header("location: index.php");
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
}

//Substract from the counter
if(isset($_POST['substract'])){

// Attempt update query execution
$update = "UPDATE users SET counter = counter - 1 WHERE username='$currentuser'";
if(mysqli_query($link, $update)){
    echo "Records were updated successfully.";
      header("location: index.php");
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
}

//Reset the counter
if(isset($_POST['reset'])){

// Attempt update query execution
$update = "UPDATE users SET counter = 0 WHERE username='$currentuser'";
if(mysqli_query($link, $update)){
    echo "Records were updated successfully.";
      header("location: index.php");
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
}


?>
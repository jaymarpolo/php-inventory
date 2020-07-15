<?php
$conn = new mysqli('localhost', 'root', '', 'sis')or die(mysqli_error($conn));
if(isset($_POST['add_cat'])){
    $cat_name = $_POST['cat_name'];
    $conn->query("INSERT INTO tbl_cat (cat_name) VALUES ('$cat_name')") or die($conn->error);
    header("Location:category.php");
    }
?>
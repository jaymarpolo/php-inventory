<?php
$conn = new mysqli('localhost', 'root', '', 'sis')or die(mysqli_error($conn));
if(isset($_POST['add_user'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $role = $_POST['role'];
    $conn->query("INSERT INTO tbl_user (username,password,first_name,last_name,role) VALUES ('$username','$password','$first_name','$last_name','$role')") or die($conn->error);
    header("Location:acc.php");
    }
?>
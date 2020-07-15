<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Rigels Food Corp.</title>
  <link href="bootstrap-4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
  <link href="css/table.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="bootstrap-4.0.0/dist/css/dataTables.bootstrap4.min.css">

</head>
<body>
</body>
</html>
<?php
session_start();
require 'connect.php';
date_default_timezone_set("Asia/Manila");
$date = date("Y-m-d");
$ddate = date("l, M m");
$date_time = date("Y-m-d h:i:s");

$usernameErr = $passwordErr = $current_passwordErr = $new_passwordErr = $repeat_passwordErr = "";
$username = $txtpassword  = $current_password  = $new_password  = $repeat_password = "";

function clean($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else {
        $username = clean($_POST["username"]);
    }

    if (empty($_POST["txtpassword"])) {
        $passwordErr = "Password is required";
    } else {
        $txtpassword = clean($_POST["txtpassword"]);
    }

    if (empty($_POST["current_password"])) {
        $current_passwordErr = "Current password is required";
    } else {
        $current_password = clean($_POST["current_password"]);
    }

    if (empty($_POST["new_password"])) {
        $new_passwordErr = "New password is required";
    } else {
        $new_password = clean($_POST["new_password"]);
    }

    if (empty($_POST["repeat_password"])) {
        $repeat_passwordErr = "password is required";
    } else {
        $repeat_password = clean($_POST["repeat_password"]);
    }
}   

if(isset($_POST['login'])){
    $sql = "SELECT * FROM tbl_user WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            if($row['password'] == $txtpassword){
                $_SESSION['user_name'] = $row['username'];
                $_SESSION['role'] = $row['role'];
                header("location:product.php");
            } else {
                $passwordErr = '<div class="alert text-danger">
                        Incorrect Password
                        </div>';
                $username = $row['username'];
            }
        }
    } else {
        $usernameErr = '<div class="alert text-danger">
                        Incorrect Username
                        </div>';
        $username = "";
    }
}
?>
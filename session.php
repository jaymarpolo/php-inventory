<?php
session_start();
if (!isset($_SESSION['user_name']) || (trim($_SESSION['user_name']) == '')) {
    header("location:login.php");
    exit();
}
if (!isset($_SESSION['role']) || (trim($_SESSION['role']) == '')) {
    header("location:login.php");
    exit();
}
?>
<?php
$conn = new mysqli('localhost', 'root', '', 'sis')or die(mysqli_error($conn));
if(isset($_POST['add_unit'])){
    $unit_name = $_POST['unit_name'];
    $conn->query("INSERT INTO tbl_unit (unit_name) VALUES ('$unit_name')") or die($conn->error);
    header("Location:unit.php");
    }
?>
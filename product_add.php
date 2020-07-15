<?php
require_once 'control.php';
$conn = new mysqli('localhost', 'root', '', 'sis') or die(mysqli_error($conn));
$sql = "SELECT tbl_items.id, tbl_items.prod_name, tbl_items.prod_desc, tbl_items.cat_name, tbl_items.unit_name, tbl_items.prod_reorder_lvl AS reorder_lvl, tbl_items.prod_price, tbl_inventory.qty AS qty FROM tbl_items join tbl_inventory ON tbl_items.prod_name = tbl_inventory.prod_name";
if (isset($_POST['add_item'])) {
    $prod_name = $_POST['prod_name'];
    $prod_desc = $_POST['prod_desc'];
    $cat_name = $_POST['cat_name'];
    $unit_name = $_POST['unit_name'];
    $prod_reorder_lvl = $_POST['prod_reorder_lvl'];
    $prod_price = $_POST['prod_price'];
    $sql = "INSERT INTO tbl_items (prod_name,prod_desc,cat_name,unit_name,prod_reorder_lvl,prod_price,prod_date) VALUES ('$prod_name','$prod_desc','$cat_name','$unit_name','$prod_reorder_lvl','$prod_price','$date')";
    if ($conn->query($sql) === TRUE) {
        $add_inventory_query = "INSERT INTO tbl_inventory(prod_name,qty,date) VALUES ('$prod_name','0','$date')";
        if ($conn->query($add_inventory_query) === TRUE) {
            echo '<script>window.location.href="product.php"</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

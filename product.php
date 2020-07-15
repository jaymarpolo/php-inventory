<?php
include 'control.php';
$session_username = $_SESSION['user_name'];
$session_role = $_SESSION['role'];
if(empty($_SESSION['user_name'])){
    header("location:login.php");
}
?>
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
    <div class="d-flex" id="wrapper">
      <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading">RIGELS FOOD CORP.</div>
          <div class="list-group list-group-flush">
            <a href="product.php" class="list-group-item list-group-item-action bg-light">Product</a>
            <a href="category.php" class="list-group-item list-group-item-action bg-light">Category</a>
            <a href="unit.php" class="list-group-item list-group-item-action bg-light">Unit of Measure</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Sales Report</a>
          </div>
        </div>
      <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">

          <button class="btn btn-light" id="menu-toggle"><span class="navbar-toggler-icon"></span></button>
          <a class="navbar-brand font-weight-light ml-2"><?php echo $ddate; ?></a>
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="pos.php">Transaction <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Account
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item small" href="acc.php">Account Settings</a>
                  <a class="dropdown-item small" href="#logout" data-toggle="modal">Log-Out</a>
                </div>
              </li>
            </ul>
          </nav>

            
                  
                  <div class="container-fluid border">

  <div class="table-wrapper">
<div class="form-group float-right">
                  <a href="#add" class="btn btn-white text-primary border-primary" data-toggle="modal"><span>Add New Product</span></a>
                </div>
                <span class="counter float-right"></span>
<div class="table-title">
                  <div class="row">
                    <div class="col-sm-6">
                      <h3 class="font-weight-light mb-0" data-toggle="modal">Manage Products</h3>
                    </div>
                  </div><hr>
                </div>
      <div class="table-responsive">
        <table class="table" id="example">
          <thead>
            <tr>
            
                    <th>Name</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Unit</th>
                    <th>In Stock</th>
                    <th>Price</th>
                    <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $sql = "SELECT tbl_items.id, tbl_items.prod_name, tbl_items.prod_desc, tbl_items.cat_name, tbl_items.unit_name, tbl_items.prod_reorder_lvl AS reorder_lvl, tbl_items.prod_price, tbl_inventory.qty AS qty FROM tbl_items join tbl_inventory ON tbl_items.prod_name = tbl_inventory.prod_name";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $prod_name = $row['prod_name'];
                    $prod_desc = $row['prod_desc'];
                    $cat_name = $row['cat_name'];
                    $unit_name = $row['unit_name'];
                    $reorder_lvl = $row['reorder_lvl'];
                    $qty = $row['qty'];
                    $prod_price = $row['prod_price'];

                  if($qty == 0){
                    $alert = "<div class='alert text-danger'>
                              <strong>$qty</strong> No Stock
                              </div>";
                    }else if($reorder_lvl >= $qty){
                    $alert = "<div class='alert text-warning'>
                              <strong>$qty</strong> (Re-order)
                              </div>";
                    }else {
                      $alert = $qty;
                    }
                  
                  ?>
                  <tr>  
                    <td>
                        <?php echo $prod_name; ?>
                    </td>
                    <td>
                        <?php echo $prod_desc; ?>
                    </td>
                    <td>
                        <?php echo $cat_name; ?>
                    </td>
                    <td>
                        <?php echo $unit_name; ?>
                    </td>
                    <td>
                        <?php echo $alert; ?>
                    </td>
                    <td>
                        ₱<?php echo $prod_price; ?>
                    </td>
              <td><div class="dropdown">
                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Action
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item small" href="#add<?php echo $id;?>" data-toggle="modal">Stock In</a>
                  <a class="dropdown-item small" href="#out<?php echo $id;?>" data-toggle="modal">Stock Out</a>
                  <a class="dropdown-item small" href="#edit<?php echo $id;?>" data-toggle="modal">Update</a>
                  <a class="dropdown-item small" href="#delete<?php echo $id;?>" data-toggle="modal">Delete</a>
                </div>
              </div></td>
                    <!-- In Stock Modal HTML -->
                    <div id="add<?php echo $id; ?>" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <form method="post">
                            <div class="modal-header">            
                              <h4 class="modal-title font-weight-light">Stock In</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            </div>
                            <div class="modal-body font-weight-normal">
                              <div class="form-group">
                                <label>Name</label>
                                <input type="hidden" name="add_stocks_id" value="<?php echo $id; ?>">
                                <input type="text" class="form-control" id="prod_name" name="prod_name" required readonly value="<?php echo $prod_name; ?>">
                              </div>
                              <div class="form-group">
                                <label>Quantity:</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" autocomplete="off" required min="1" autofocus>
                              </div>
                              <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <input type="submit" class="btn btn-primary" name="add_inventory" value="Add">
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- In Stock Modal HTML -->
                    <div id="out<?php echo $id; ?>" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <form method="post">
                            <div class="modal-header">            
                              <h4 class="modal-title font-weight-light">Stock Out</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            </div>
                            <div class="modal-body font-weight-normal">
                              <div class="form-group">
                                <label>Name</label>
                                <input type="hidden" name="out_stocks_id" value="<?php echo $id; ?>">
                                <input type="text" class="form-control" id="prod_name" name="prod_name" required readonly value="<?php echo $prod_name; ?>">
                              </div>
                              <div class="form-group">
                                <label>Quantity:</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" autocomplete="off" required min="1" autofocus>
                              </div>
                              <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <input type="submit" class="btn btn-primary" name="out_inventory" value="Add">
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>

                    <!-- Edit Modal HTML -->
                    <div id="edit<?php echo $id; ?>" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <form method="post">
                            <div class="modal-header">            
                              <h4 class="modal-title font-weight-light">Update Product</h4>
                            </div>
                            <div class="modal-body font-weight-normal">
                              <input type="hidden" name="edit_prod_id" value="<?php echo $id; ?>">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" id="prod_name" name="prod_name" value="<?php echo $prod_name; ?>" autocomplete="off" required>
                                  </div>
                                  <div class="form-group">
                                    <label>Descripion</label>
                                    <input class="form-control" id="prod_desc" name="prod_desc" value="<?php echo $prod_desc; ?>" autocomplete="off" required>
                                  </div>
                                  <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control" id="cat_name" name="cat_name" autocomplete="off" required>
                                  <?php
                                    $sql = "SELECT cat_name FROM tbl_cat";
                                    $catedit = $conn->query($sql);
                                      while($row = $catedit->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo $row["cat_name"]; ?>"><?php echo $row["cat_name"]; ?></option>
                                      <?php }?>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label>Unit of Measure</label>
                                    <select class="form-control" id="unit_name" name="unit_name" autocomplete="off" required>
                                  <?php
                                    $sql = "SELECT unit_name FROM tbl_unit";
                                    $unitedit = $conn->query($sql);
                                      while($row = $unitedit->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo $row["unit_name"]; ?>"><?php echo $row["unit_name"]; ?></option>
                                      <?php }?>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" class="form-control" id="prod_price" name="prod_price" value="<?php echo $prod_price; ?>" autocomplete="off" required>
                                  </div>
                                  <div class="form-group">
                                    <label>Re-order Level</label>
                                    <input type="number" class="form-control" id="prod_reorder_lvl" name="prod_reorder_lvl" value="<?php echo $reorder_lvl; ?>" autocomplete="off" required>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                              <input type="submit" class="btn btn-primary" name="update_item" value="Save">
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- Delete Modal HTML -->
                    <div id="delete<?php echo $id; ?>" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <form method="post">
                            <div class="modal-header">            
                              <h4 class="modal-title font-weight-light">Delete Product</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            </div>
                            <div class="modal-body font-weight-normal">
                              <input type="hidden" name="delete_id" value="<?php echo $id; ?>">
                              <p>Are you sure you want to delete this?</p>
                              <p><small>This action cannot be undone.</small></p>
                            </div>
                            <div class="modal-footer">
                              <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                              <input type="submit" name="delete" class="btn btn-danger" value="Delete" autofocus>
                            </div>
                          </form>
                        </div>
                      </div>
                    </tr>
                    
                
                        <?php
                        }
                        if(isset($_POST['update_item'])){
                            $edit_prod_id = $_POST['edit_prod_id'];
                            $prod_name = $_POST['prod_name'];
                            $prod_desc = $_POST['prod_desc'];
                            $cat_name = $_POST['cat_name'];
                            $unit_name = $_POST['unit_name'];
                            $prod_reorder_lvl = $_POST['prod_reorder_lvl'];
                            $prod_price = $_POST['prod_price'];
                            $sql = "UPDATE tbl_items SET 
                                prod_name='$prod_name',
                                prod_desc='$prod_desc',
                                cat_name='$cat_name',
                                unit_name='$unit_name',
                                prod_reorder_lvl='$prod_reorder_lvl',
                                prod_price='$prod_price'
                                WHERE id ='$edit_prod_id'";
                            if ($conn->query($sql) === TRUE) {
                            $update_inventory_query = "UPDATE tbl_inventory SET 
                                prod_name='$prod_name'
                                WHERE id ='$edit_prod_id'";
                            if ($conn->query($update_inventory_query) === TRUE) {
                                echo '<script>window.location.href="product.php"</script>';
                            } else {
                                echo "Error updating record: " . $conn->error;
                            }
                        } else {
                            echo "Error updating record: " . $conn->error;
                        }
                      }


                        if(isset($_POST['delete'])){
                            $delete_id = $_POST['delete_id'];
                            $sql = "DELETE FROM tbl_items WHERE id='$delete_id'";
                            if ($conn->query($sql) === TRUE) {
                                $sql = "DELETE FROM tbl_inventory WHERE id='$delete_id'";
                                if ($conn->query($sql) === TRUE) {
                                    $sql = "DELETE FROM tbl_inventory WHERE id='$delete_id'";
                                    echo '<script>window.location.href="product.php"</script>';
                                } else {
                                    echo "Error deleting record: " . $conn->error;
                                }
                            } else {
                                echo "Error deleting record: " . $conn->error;

                            }
                        }


                    if(isset($_POST['add_inventory'])){
                        $add_stocks_id = clean($_POST['add_stocks_id']);
                        $quantity = clean($_POST['quantity']);
                        $sql = "INSERT INTO tbl_issuance (prod_name,qty,date) VALUES ('$prod_name','$quantity','$date_time')";
                        if ($conn->query($sql) === TRUE) {
                            $add_inv = "UPDATE tbl_inventory SET qty = (qty + '$quantity') WHERE id = '$add_stocks_id'";
                            if ($conn->query($add_inv) === TRUE) {
                                echo '<script>window.location.href="product.php"</script>';
                            } else {
                                echo "Error updating record: " . $conn->error;
                            }
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                      }

                      if(isset($_POST['out_inventory'])){
                        $out_stocks_id = clean($_POST['out_stocks_id']);
                        $quantity = clean($_POST['quantity']);
                        $sql = "INSERT INTO tbl_issuance (prod_name,qty,date) VALUES ('$prod_name','$quantity','$date_time')";
                        if ($conn->query($sql) === TRUE) {
                            $out_inv = "UPDATE tbl_inventory SET qty = (qty - '$quantity') WHERE id = '$out_stocks_id'";
                            if ($conn->query($out_inv) === TRUE) {
                                echo '<script>window.location.href="product.php"</script>';
                            } else {
                                echo "Error updating record: " . $conn->error;
                            }
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>

              <!-- Add Modal HTML -->
              <div id="add" class="modal fade">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form method="post" action="product_add.php">
                      <div class="modal-header">            
                        <h4 class="modal-title font-weight-light">New Product</h4>
                      </div>
                      <div class="modal-body font-weight-normal">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Name</label>
                              <input type="text" class="form-control" id="prod_name" name="prod_name"  autocomplete="off" required autofocus>
                            </div>
                            <div class="form-group">
                              <label>Description</label>
                              <input class="form-control" id="prod_desc" name="prod_desc" required="">
                            </div>
                            <div class="form-group">
                              <label>Category</label>
                              <select class="form-control" id="cat_name" name="cat_name" autocomplete="off" required>
                                <?php
                                  $sql = "SELECT cat_name FROM tbl_cat";
                                  $catadd = $conn->query($sql);
                                while($row = $catadd->fetch_assoc()) {
                                ?>
                                  <option value="<?php echo $row["cat_name"]; ?>"><?php echo $row["cat_name"]; ?></option>
                                <?php }?>
                              </select>
                            </div>
                            <div class="form-group">
                              <label>Unit of Measure</label>
                              <select class="form-control" id="unit_name" name="unit_name" autocomplete="off" required>
                                <?php
                                  $sql = "SELECT unit_name FROM tbl_unit";
                                  $unitadd = $conn->query($sql);
                                while($row = $unitadd->fetch_assoc()) {
                                ?>
                                  <option value="<?php echo $row["unit_name"]; ?>"><?php echo $row["unit_name"]; ?></option>
                                <?php }?>
                              </select>
                            </div>
                            <div class="form-group">
                              <label>Price</label>
                              <input type="number" class="form-control" id="prod_price" name="prod_price" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                              <label>Re-order Level</label>
                              <input type="number" class="form-control" id="prod_reorder_lvl" name="prod_reorder_lvl" autocomplete="off" required>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-primary" name="add_item" value="Add">
                      </div>
                    </form>
                  </div>
                </div>
              </div>


              <div id="logout" class="modal fade">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form method="post">
                      <div class="modal-header">            
                        <h4 class="modal-title">LOGOUT</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                      </div>
                      <div class="modal-body font-weight-normal">
                        <p>Are you sure you want to log-out?</p>
                      </div>
                      <div class="modal-footer">
                        <a href="logout.php"><button type="button" class="btn btn-primary" autofocus>Yes</button></a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
  </body>
</html>
  <script src="jquery/jquery.min.js"></script>
  <script src="bootstrap-4.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="bootstrap-4.0.0/dist/js/jquery.dataTables.min.js"></script>
  <script src="bootstrap-4.0.0/dist/js/dataTables.bootstrap4.min.js"></script>
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>
  <script>
    $(document).ready(function() {
      $('#example').DataTable();
    });
  </script>
<?php
include 'control.php';
$session_username = $_SESSION['user_name'];
$session_role = $_SESSION['role'];
if(empty($_SESSION['user_name'])){
    header("lounition:login.php");
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

            
                  
            <div class="tableprod container-fluid border">
          <div class="table-wrapper">
            
             <div class="row">
            <div class="col-md-4">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title font-weight-light mb-0">Manage Units</h3>
                </div>
                <div class="box-body">
                  <form method="post" action="unit_add.php">
                    <div class="form-group">
                      <div class="input-group col-xs-12">
                      <input type="text" class="form-control" id="unit_name" name="unit_name" required autofocus>
                  </div>
                  </div><!-- /.form group -->
                  <div class="form-group">
                    <div class="input-group">
                      <button type="submit" class="btn btn-unit btn-light text-primary border-primary" name="add_unit"><span>Add Unit</span></button>
                    </div>
                  </div><!-- /.form group -->
                </form> 
                </div><!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div><!-- /.col (right) -->
            
            <div class="col-md-8">
    
                <!-- /.box-header -->
      <div class="table-responsive">

        <table class="table" id="example">
          <thead>
            <tr>

         <th style="padding-right: 100px;">Name</th>
                    <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
                    $sql = "SELECT tbl_unit.unit_id, tbl_unit.unit_name FROM tbl_unit";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $unit_id = $row['unit_id'];
                            $unit_name = $row['unit_name'];
                  ?>
            <tr>
                    <td>
                        <?php echo $unit_name; ?>
                    </td>
              <td>

    <a class="btn btn-info" href="#edit<?php echo $unit_id;?>" data-toggle="modal">Update</a>
    <a class="btn btn-danger" href="#delete<?php echo $unit_id;?>" data-toggle="modal">Delete</a>
  </td>


                    <!-- Edit Modal HTML -->
                    <div id="edit<?php echo $unit_id; ?>" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <form method="post">
                            <div class="modal-header">            
                              <h4 class="modal-title font-weight-light">Update Unit of Measure</h4>
                            </div>
                            <div class="modal-body font-weight-normal">
                              <input type="hidden" name="edit_unit_id" value="<?php echo $unit_id; ?>">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" id="unit_name" name="unit_name" value="<?php echo $unit_name; ?>" autocomplete="off" required autofocus>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                              <input type="submit" class="btn btn-primary" name="update_unit" value="Save">
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- Delete Modal HTML -->
                    <div id="delete<?php echo $unit_id; ?>" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <form method="post">
                            <div class="modal-header">            
                              <h4 class="modal-title font-weight-light">Delete Unit of Measure</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            </div>
                            <div class="modal-body font-weight-normal">
                              <input type="hidden" name="delete_unit_id" value="<?php echo $unit_id; ?>">
                              <p>Are you sure you want to delete this?</p>
                              <p><small>This action cannot be undone.</small></p>
                            </div>
                            <div class="modal-footer">
                              <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                              <input type="submit" name="delete_unit" class="btn btn-danger" value="Delete" autofocus>
                            </div>
                          </form>
                        </div>
                      </div>
                    </tr>
                    
                
                        <?php
                        }
                        if(isset($_POST['update_unit'])){
                            $edit_unit_id = $_POST['edit_unit_id'];
                            $unit_name = $_POST['unit_name'];
                            $sql = "UPDATE tbl_unit SET 
                            unit_name='$unit_name'
                            WHERE unit_id ='$edit_unit_id'";
                            if ($conn->query($sql) === TRUE) {
                            echo '<script>window.lounition.href="unit.php"</script>';
                            } else {
                                echo "Error updating record: " . $conn->error;
                            }
                        }

                        if(isset($_POST['delete_unit'])){
                            $delete_unit_id = $_POST['delete_unit_id'];
                            $sql = "DELETE FROM tbl_unit WHERE unit_id='$delete_unit_id'";
                            if ($conn->query($sql) === TRUE) {
                            echo '<script>window.lounition.href="unit.php"</script>';
                            } else {
                                echo "Error deleting record: " . $conn->error;
                            }
                          }
                        }
                    ?>
                  </tbody>
                </table>
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
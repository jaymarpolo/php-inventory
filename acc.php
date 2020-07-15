<?php
include 'control.php';
$session_username = $_SESSION['user_name'];
$session_role = $_SESSION['role'];
if (empty($_SESSION['user_name'])) {
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
            <a href="#add" class="btn btn-white text-primary border-primary" data-toggle="modal"><span>Add New User</span></a>
          </div>
          <span class="counter float-right"></span>
          <div class="table-title">
            <div class="row">
              <div class="col-sm-6">
                <h3 class="font-weight-light mb-0" data-toggle="modal">Manage Users</h3>
              </div>
            </div>
            <hr>
          </div>
          <div class="table-responsive">
            <table class="table" id="example">
              <thead>
                <tr>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Firstname</th>
                  <th>Lastname</th>
                  <th>Role</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql = "SELECT tbl_user.id, tbl_user.username, tbl_user.password, tbl_user.first_name, tbl_user.last_name, tbl_user.role FROM tbl_user";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $username = $row['username'];
                    $password = $row['password'];
                    $first_name = $row['first_name'];
                    $last_name = $row['last_name'];
                    $role = $row['role'];

                ?>
                    <tr>
                      <td>
                        <?php echo $username; ?>
                      </td>
                      <td>
                        <?php echo $password; ?>
                      </td>
                      <td>
                        <?php echo $first_name; ?>
                      </td>
                      <td>
                        <?php echo $last_name; ?>
                      </td>
                      <td>
                        <?php echo $role; ?>
                      </td>
                      <td>
                        <div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item small" href="#edit<?php echo $id; ?>" data-toggle="modal">Update</a>
                          </div>
                        </div>
                      </td>

                      <!-- Edit Modal HTML -->
                      <div id="edit<?php echo $id; ?>" class="modal fade">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <form method="post">
                              <div class="modal-header">
                                <h4 class="modal-title font-weight-light">Update User</h4>
                              </div>
                              <div class="modal-body font-weight-normal">
                                <input type="hidden" name="edit_user_id" value="<?php echo $id; ?>">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Username</label>
                                      <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                      <label>Password</label>
                                      <input type="text" class="form-control" id="password" name="password" value="<?php echo $password; ?>" autocomplete="off" required>
                                    </div>

                                    <div class="form-group">
                                      <label>Firstname</label>
                                      <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $first_name; ?>" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                      <label>Lastname</label>
                                      <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $last_name; ?>" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                      <label>Role</label>
                                      <select class="form-control" id="role" name="role" autocomplete="off" required>
                                        <?php
                                        $sql = "SELECT role FROM tbl_user";
                                        $roleres = $conn->query($sql);
                                        while ($row = $roleres->fetch_assoc()) {
                                        ?>
                                          <option value="<?php echo $row["role"]; ?>"><?php echo $row["role"]; ?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <input type="submit" class="btn btn-primary" name="update_user" value="Save">
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </tr>
                <?php
                  }
                  if (isset($_POST['update_user'])) {
                    $edit_prod_id = $_POST['edit_user_id'];
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $last_name = $_POST['first_name'];
                    $role = $_POST['role'];
                    $sql = "UPDATE tbl_user SET 
                                username='$username',
                                password='$password',
                                first_name='$first_name',
                                last_name='$last_name',
                                role='$role'
                                WHERE id ='$edit_user_id'";
                    if ($conn->query($sql) === TRUE) {
                      echo '<script>window.location.href="acc.php"</script>';
                    } else {
                      echo "Error updating record: " . $conn->error;
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
                <form method="post" action="user_add.php">
                  <div class="modal-header">
                    <h4 class="modal-title font-weight-light">New User</h4>
                  </div>
                  <div class="modal-body font-weight-normal">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Username</label>
                          <input type="text" class="form-control" id="username" name="username" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                          <label>Password</label>
                          <input type="text" class="form-control" id="password" name="password" autocomplete="off" required>
                        </div>

                        <div class="form-group">
                          <label>Firstname</label>
                          <input type="text" class="form-control" id="first_name" name="first_name" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                          <label>Lastname</label>
                          <input type="text" class="form-control" id="last_name" name="last_name" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                          <label>Role</label>
                          <select class="form-control" id="role" name="role" autocomplete="off" required>
                            <?php
                            $sql = "SELECT role FROM tbl_user";
                            $roleres = $conn->query($sql);
                            while ($row = $roleres->fetch_assoc()) {
                            ?>
                              <option value="<?php echo $row["role"]; ?>"><?php echo $row["role"]; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-primary" name="add_user" value="Add">
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
  $(document).ready(function() {
    $('#example').DataTable();
  });
</script>
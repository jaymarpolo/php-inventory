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
      <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">

          <button class="btn btn-light" id="menu-toggle"></button>
          <a class="navbar-brand font-weight-light ml-2"><?php echo $ddate; ?></a>
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="product.php">Home <span class="sr-only">(current)</span></a>
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

          <div class="container">
            <div class="row clearfix">
              <div class="col-md-12">
                <table class="table table-bordered" id="tab_logic_total">
                  <tbody >
                    <tr>
                      <th class="text-center">Order Date</th>
                      <td class="text-center"><input type="text" class="form-control" autocomplete="off" required></td>
                    </tr>
                    <tr>
                      <th class="text-center">Client Name</th>
                      <td class="text-center"><input type="text" class="form-control" autocomplete="off" required></td>
                    </tr>
                    <tr>
                      <th class="text-center">Client Contact</th>
                      <td class="text-center"><input type="text" class="form-control" autocomplete="off" required></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-12">
                <table class="table table-bordered" id="tab_logic">
                  <thead>
                    <tr>
                      <th class="text-center"> # </th>
                      <th class="text-center"> Product </th>
                      <th class="text-center"> Price </th>
                      <th class="text-center"> In Stock </th>
                      <th class="text-center"> Qty </th>
                      <th class="text-center"> Total </th>
                    </tr>
                  </thead>
                  <tbody>
                      <tr id='addr0'>
                        <td>1</td>
                      <td><select class="form-control" id="prod_name" name="prod_name" autocomplete="off" required>
                                  <?php
                                    $sql = "SELECT prod_name FROM tbl_inventory";
                                    $prodres = $conn->query($sql);
                                      while($row = $prodres->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo $row["prod_name"]; ?>"><?php echo $row["prod_name"]; ?></option>
                                      <?php }?>
                                    </select></td>
                      <td><input type="number" name='price[]' placeholder='Enter Unit Price' class="form-control price" step="0.00" min="0"/></td>
                      <td><input type="number" name='qty[]' placeholder='Enter Qty' class="form-control qty" step="0" min="0"/></td>
                      <td><input type="number" name='qty[]' placeholder='Enter Qty' class="form-control qty" step="0" min="0"/></td>
                      <td><input type="number" name='total[]' placeholder='0.00' class="form-control total" readonly/></td>
                    </tr>
                    <tr id='addr1'></tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-12">
                <button id='delete_row' class="float-right btn btn-default" style="margin-left: 5px; margin-right: 14px;">Delete Row</button>
                <button id="add_row" class="float-right btn btn-default pull-left">Add Row</button>
              </div>
            </div>
            <div class="row float-right clearfix" style="margin-top:20px">
              <div class="float-right col-md-12">
                <table class="table table-bordered" id="tab_logic_total">
                  <tbody>
                    <tr>
                      <th class="text-center">Sub Total</th>
                      <td class="text-center"><input type="number" name='sub_total' placeholder='0.00' class="form-control" id="sub_total" readonly/></td>
                    </tr>
                    <tr>
                      <th class="text-center">Tax</th>
                      <td class="text-center"><div class="input-group mb-2 mb-sm-0">
                          <input type="number" class="form-control" id="tax" placeholder="0" min="0">
                          <div class="input-group-addon">%</div>
                        </div></td>
                    </tr>
                    <tr>
                      <th class="text-center">Tax Amount</th>
                      <td class="text-center"><input type="number" name='tax_amount' id="tax_amount" placeholder='0.00' class="form-control" readonly/></td>
                    </tr>
                    <tr>
                      <th class="text-center">Grand Total</th>
                      <td class="text-center"><input type="number" name='total_amount' id="total_amount" placeholder='0.00' class="form-control" readonly/></td>
                    </tr>
                  </tbody>
                </table>
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
  <script>
    $(document).ready(function(){
    var i=1;
    $("#add_row").click(function(){b=i-1;
        $('#addr'+i).html($('#addr'+b).html()).find('td:first-child').html(i+1);
        $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
        i++; 
    });
    $("#delete_row").click(function(){
      if(i>1){
    $("#addr"+(i-1)).html('');
    i--;
    }
    calc();
  });
  
  $('#tab_logic tbody').on('keyup change',function(){
    calc();
  });
  $('#tax').on('keyup change',function(){
    calc_total();
  });
  

});

function calc()
{
  $('#tab_logic tbody tr').each(function(i, element) {
    var html = $(this).html();
    if(html!='')
    {
      var qty = $(this).find('.qty').val();
      var price = $(this).find('.price').val();
      $(this).find('.total').val(qty*price);
      
      calc_total();
    }
    });
}

function calc_total()
{
  total=0;
  $('.total').each(function() {
        total += parseInt($(this).val());
    });
  $('#sub_total').val(total.toFixed(2));
  tax_sum=total/100*$('#tax').val();
  $('#tax_amount').val(tax_sum.toFixed(2));
  $('#total_amount').val((tax_sum+total).toFixed(2));
}
  </script>
<?php
include 'control.php';
if(isset($_SESSION['user_name'])){
    header("location:product.php");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rigels Food Corp.</title>
    <link href="bootstrap-3.3.7/dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="fontawesome-free-5.6.1-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="login-page">
      <div class="form">
        <img class="login-logo" src="img/logo.png">
        <h1 class="login-title">Rigels Food Corp.</h1>
        <form action="" class="login-form" method="post">
          <input type="text" placeholder="username" value="<?php echo $username;?>" autofocus autocomplete="off" required name="username"/>
          <input type="password" placeholder="password" required name="txtpassword"/>
          <button style="margin-bottom: 10px;" type="submit" name="login">login</button><?php echo $usernameErr; ?><?php echo $passwordErr; ?>
        </form>
      </div>
    </div>
  </body>
</html>
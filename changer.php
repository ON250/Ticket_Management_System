<?php
    session_start();
    include('config_database.php'); 
    if($_SESSION['nn']=='') header("location: index.php");
    $id=$_SESSION['nn'];

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BDF | Change Password</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="height: 400px;">
     <?php

    //the login connection
    $msg='';
    
    if(isset($_POST['changeP'])){
      $newP=htmlspecialchars($_POST['npassword']);
      $confP=htmlspecialchars($_POST['cpassword']);
      $psswd=sha1($newP);
      if(strlen($newP)<6) {
        echo '<script> alert("The New Password must contain more than 5 chars")</script>';
      }
      else if($newP!=$confP) {
        echo '<script> alert("The passwords don\'t correspond!")</script>';
      }
      else{
        if($_SESSION['category_id']==1) $query=mysqli_query($connect,"UPDATE admin set admin_pin=1,admin_password='$psswd' where adminID='$id'");
        else if($_SESSION['category_id']==2) $query=mysqli_query($connect,"UPDATE subadmin set subAdmin_pin=1, subAdmin_password='$psswd' where subAdminID='$id'");
        else if($_SESSION['category_id']==3) $query=mysqli_query($connect,"UPDATE end_users set user_pin=1,user_password='$psswd' where userID='$id'");

      if($query)
      {
              echo '<script> alert("Your Password has been changed successfully! Now you can Sign In.")</script>';
              header("location: index.php");
      }
      else{
        $msg='Error. Please try Again !';
      }
      }
    }





  ?> 

<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><img src="bdf.png" class="col-xs-6">Tickect</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body" >
    <p class="login-box-msg">Choose your Confident Password</p><p class="text-danger"><?php echo $msg;?></p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="password" name="npassword" required="" class="form-control" placeholder="New Password">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="cpassword" required="" class="form-control" placeholder="Confirm Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="changeP" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!-- /.social-auth-links -->

    <a href="#">I forgot my password</a><br>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>

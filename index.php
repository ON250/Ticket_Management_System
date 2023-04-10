<?php
    session_start();
    include('config_database.php'); 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BDF | Log in</title>
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
    
    if(isset($_POST['connexion'])){
      $email=htmlspecialchars($_POST['email']);
      $passwordq=htmlspecialchars($_POST['password']);
      $password=sha1($passwordq);

      $query=mysqli_query($connect,"SELECT * FROM admin WHERE admin_email='$email' and admin_password='$password' limit 1");
      $queryS=mysqli_query($connect,"SELECT * FROM subadmin WHERE subAdmin_email='$email' and subAdmin_password='$password' limit 1");
      $queryU=mysqli_query($connect,"SELECT * FROM end_users WHERE user_email='$email' and user_password='$password' limit 1");
      if(mysqli_num_rows($query))
      {

        $get=mysqli_fetch_array($query);
        
        if($get['admin_status']==1){
          $idd=$_SESSION['nn']=$get['adminID'];
          $_SESSION['nn']=$idd;
          $_SESSION['names']=$get['admin_fname'].' '.$get['admin_lname'];
          $_SESSION['category_id']=1;
            if($get['admin_pin']==0) header("location: changer.php");
            else if($get['admin_pin']==1){
              header("location: dashboard.php");
            }
      }
        else{
        echo '<script> alert("Your Account is desactivated! Please contact the IT.")</script>';
        }
      }
      else if(mysqli_num_rows($queryS))
      {

        $get=mysqli_fetch_array($queryS);
        
        if($get['subAdmin_status']==1){
          $idd=$_SESSION['nn']=$get['subAdminID'];
          $_SESSION['nn']=$idd;
          $_SESSION['names']=$get['subAdmin_fname'].' '.$get['subAdmin_lname'];
          $_SESSION['category_id']=2;
            if($get['subAdmin_pin']==0) header("location: changer.php");
            else if($get['subAdmin_pin']==1){
              header("location: dashboard.php");
            }
        }
        else{
          echo '<script> alert("Your Account is desactivated! Please contact the IT.")</script>';
        }
      }
      else if(mysqli_num_rows($queryU)>0)
      {

        $get=mysqli_fetch_array($queryU);
        
        if($get['user_status']==1){
          $idd=$_SESSION['nn']=$get['userID'];
          $_SESSION['nn']=$idd;
          $_SESSION['names']=$get['user_fname'].' '.$get['user_lname'];
          $_SESSION['category_id']=3;
            if($get['user_pin']==0) header("location: changer.php");
            else if($get['user_pin']==1){
              header("location: dashboard.php");
            }
        }
        else{
          echo '<script> alert("Your Account is desactivated! Please contact the IT.")</script>';
        }
      }
      else{
        $msg='Email or Password is Incorrect !';
      }
    }





  ?> 

<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><img src="bdf.png" class="col-xs-6">Tickect</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body" >
    <p class="login-box-msg">Sign in to start your session</p><p class="text-danger"><?php echo $msg;?></p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="email" name="email" required="" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" required="" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="connexion" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

 

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

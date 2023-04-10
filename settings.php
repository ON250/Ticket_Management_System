<?php 
include("header.php");
include('config_database.php'); 
$id=$_SESSION['nn'];
$category=$_SESSION['category_id'];
if($category==1) { $query=mysqli_query($connect,"SELECT * FROM admin where adminID='$id'");
  $view=mysqli_fetch_array($query);
  $fname=$view['admin_fname'];
  $lname=$view['admin_lname'];
  $email=$view['admin_email'];
  $phone=$view['admin_telephone'];
  $adress=$view['admin_adress'];
  $img=$view['photoprofile'];
}
else if($category==2) { $query=mysqli_query($connect,"SELECT * FROM subadmin where subAdminID='$id'");
  $view=mysqli_fetch_array($query);
  $fname=$view['subAdmin_fname'];
  $lname=$view['subAdmin_lname'];
  $email=$view['subAdmin_email'];
  $phone=$view['subAdmin_telephone'];
  $adress=$view['subAdmin_adress'];
  $img=$view['photoprofile'];
  }
else if($category==3){ $query=mysqli_query($connect,"SELECT * FROM end_users where userID='$id'");
  $view=mysqli_fetch_array($query);
  $fname=$view['user_fname'];
  $lname=$view['user_lname'];
  $email=$view['user_email'];
  $phone=$view['user_telephone'];
  $adress=$view['user_adress'];
  $img=$view['photoprofile'];
}


if(isset($_POST['updateset']))
{
  $fname=htmlspecialchars($_POST['fname']);
  $lname=htmlspecialchars($_POST['lname']);
  $names=$fname.' '.$lname;
  //$email=htmlspecialchars($_POST['email']);
  $telephone=htmlspecialchars($_POST['telephone']);
  $address=htmlspecialchars($_POST['address']);
  $password='BDF@2019';
  $newPass=htmlspecialchars($_POST['newPass']);
  $oldpass=htmlspecialchars($_POST['oldpass']);
  $Passconfirm=htmlspecialchars($_POST['Passconfirm']);
  $psswd=sha1($newPass);
  $name=$_FILES['photoprofile']['name'];
  //ckeckm if the user want to change the password
  if($oldpass=='' && $newPass=='' && $Passconfirm==''){
    $category=$_SESSION['category_id'];
    if($name!=''){
    $ext=strrchr($name, '.');
              $tmp_name = $_FILES['photoprofile']['tmp_name'];
              $photoprofile = 'img/'.$name;
              $valables = array('.jpg','.JPG','.PNG','.png');

                if(in_array($ext, $valables)){
                  if(move_uploaded_file($tmp_name, $photoprofile)){
                  //Enregistrement dans la base de donnee
                 if($_SESSION['category_id']==1) $change=mysqli_query($connect,"UPDATE admin SET photoprofile='$photoprofile' WHERE adminID='$id' ");
                 else if($_SESSION['category_id']==2) $change=mysqli_query($connect,"UPDATE subadmin SET photoprofile='$photoprofile' WHERE subAdminID='$id' ");
                 else if($_SESSION['category_id']==3) $change=mysqli_query($connect,"UPDATE end_users SET photoprofile='$photoprofile' WHERE userID='$id' ");
                 if($_SESSION['category_id']==1) {$query=mysqli_query($connect,"UPDATE admin set   admin_fname ='$fname',admin_lname='$lname', admin_adress='$address', admin_telephone='$telephone' where adminID='$id'");}
                        else if($_SESSION['category_id']==2){ $query=mysqli_query($connect,"UPDATE subadmin set subAdmin_fname='$fname', subAdmin_lname='$lname', subAdmin_adress='$address', subAdmin_telephone='$telephone' where subAdminID='$id'");}
                        else if($_SESSION['category_id']==3) {$query=mysqli_query($connect,"UPDATE end_users set user_fname='$fname', user_lname='$lname',  user_adress='$address',user_telephone='$telephone' where userID='$id'");}
        
                  if($query){ echo '<script>alert("Your Profile has been Updated successfully!")</script>'; echo '<script>document.location="settings.php";</script>';}
                  else {echo '<script>alert("Error, please try again!")</script>';}
                }
              }
      }   
      else {
        if($_SESSION['category_id']==1) {$query=mysqli_query($connect,"UPDATE admin set   admin_fname ='$fname',admin_lname='$lname',  admin_adress='$address', admin_telephone='$telephone',admin_password='$psswd' where adminID='$id'");}
                        else if($_SESSION['category_id']==2){ $query=mysqli_query($connect,"UPDATE subadmin set subAdmin_fname='$fname', subAdmin_lname='$lname',  subAdmin_adress='$address', subAdmin_telephone='$telephone', subAdmin_password='$psswd' where subAdminID='$id'");}
                        else if($_SESSION['category_id']==3) {$query=mysqli_query($connect,"UPDATE end_users set user_fname='$fname', user_lname='$lname',  user_adress='$address',user_telephone='$telephone', user_password='$psswd' where userID='$id'");}
        
                  if($query){ echo '<script>alert("Your Profile has been Updated successfully!")</script>'; echo '<script>document.location="settings.php";</script>';}
                  else {echo '<script>alert("Error, please try again!")</script>';}
      } 
  }

else{
       if(strlen($newPass)<6) {
        echo '<script> alert("The New Password must contain more than 5 chars")</script>';
      }
      else if($newPass!=$Passconfirm) {
        echo '<script> alert("The password doesn\'t correspond!")</script>';
      }
      else
        


if($_SESSION['category_id']==1) {$query=mysqli_query($connect,"UPDATE admin set   admin_fname ='$fname',admin_lname='$lname', admin_adress='$address', admin_telephone='$telephone',admin_password='$psswd' where adminID='$id'");}
                        else if($_SESSION['category_id']==2){ $query=mysqli_query($connect,"UPDATE subadmin set subAdmin_fname='$fname', subAdmin_lname='$lname',  subAdmin_adress='$address', subAdmin_telephone='$telephone', subAdmin_password='$psswd' where subAdminID='$id'");}
                        else if($_SESSION['category_id']==3) {$query=mysqli_query($connect,"UPDATE end_users set user_fname='$fname', user_lname='$lname',  user_adress='$address',user_telephone='$telephone', user_password='$psswd' where userID='$id'");}
        
                  if($query){ echo '<script>alert("Your Profile has been Updated successfully!")</script>'; echo '<script>document.location="settings.php";</script>';}
                  else {echo '<script>alert("Error, please try again!")</script>';}
      }
  }
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <section class="content-header">
      <h1>
        Update
        <small>My account</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="">System </a></li>
        <li class="active"> Administrator</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Form</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form  autocomplete="off" method="post" enctype="multipart/form-data" action="settings.php">
          <div class="row">
            <div class="col-md-3">
              <img  <?php echo  'src="'.$img.'"';?>   class="img-responsive">
              <input type="file" title="<?php echo $img; ?>" class="form-control btn btn-primary"  style="width: 100%;"  name="photoprofile">
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <input type="text" class="form-control select2"  value="<?php echo $fname;?>" style="width: 100%;"  name="fname">
              </div>
              <div class="form-group">
                <input type="text" class="form-control select2" value="<?php echo $lname;?>" style="width: 100%;"  name="lname">
              </div>
              <div class="form-group">
                <input type="text" class="form-control select2" readonly="" value="<?php echo $email;?>"  style="width: 100%;"  name="email">
              </div>
              <div class="form-group">
                <input type="text" class="form-control select2"  value="<?php echo $phone;?>"  style="width: 100%;"  name="telephone">
              </div>
              <div class="form-group">
                <input type="text" class="form-control select2"  value="<?php echo $adress;?>" style="width: 100%;"  name="address">
              </div>
            </div>
            <!-- /.col -->
            <div class="col-md-4">
              <div class="form-group">
                <input autocomplete="off" type="password" class="form-control select2" placeholder="Old Password"  style="width: 100%;"  name="oldpass">
              </div>
              <div class="form-group">
                <input autocomplete="off" type="password" placeholder="New Password" class="form-control select2"  style="width: 100%;"  name="newPass">
              </div>
              <div class="form-group">
                <input autocomplete="off" type="password" placeholder="Confirm Password" class="form-control select2"  style="width: 100%;"  name="Passconfirm">
              </div>
              <input type="submit" name="updateset" value="Save Profile" class="pull-left btn btn-sm btn-primary" >
            </div>
            <!-- /.col -->
          </div>
        </form><!--Form-->
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
       
      </div>
      <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
<?php //include('footer.php');?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="../../bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="../../bower_components/moment/min/moment.min.js"></script>
<script src="../../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="../../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="../../bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
</body>
</html>

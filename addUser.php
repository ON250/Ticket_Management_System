<?php 
include("header.php");
include('config_database.php'); 

if(isset($_POST['addUser']))
{
  $fname=htmlspecialchars($_POST['fname']);
  $lname=htmlspecialchars($_POST['lname']);
  $names=$fname.' '.$lname;
  $email=htmlspecialchars($_POST['email']);
  $telephone=htmlspecialchars($_POST['telephone']);
  $adress=htmlspecialchars($_POST['adress']);
  $status=htmlspecialchars($_POST['status']);
  $department=htmlspecialchars($_POST['department']);
  $location=htmlspecialchars($_POST['location']);
  $passwordv='BDF@2019';
  $password=sha1($passwordv);
  $regist=mysqli_query($connect,"INSERT INTO end_users(user_fname,user_lname,user_email,user_telephone,user_adress,user_status,user_department,user_branch,user_pin,user_password,c_date) values('$fname','$lname','$email','$telephone','$adress','$status','$department','$location',0,'$password',NOW())");
  if($regist) echo '<script>alert("New User Account was created successfully! Default Password  : '.$passwordv.'")</script>';
  else echo '<script>alert("Error, please try!")</script>';
}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <section class="content-header">
      <h1>
        New
        <small> User</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="">End- </a></li>
        <li class="active"> Users</li>
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
          <form method="post" action="">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control select2"  style="width: 100%;"  name="fname" required="">
              </div>
              <div class="form-group">
                <label>Last Name</label>
                <input type="text" class="form-control select2"  style="width: 100%;"  name="lname" required="">
              </div>
              <div class="form-group">
                <label>Email </label>
                <input type="email" class="form-control select2"  style="width: 100%;"  name="email" required="">
              </div>
              <div class="form-group">
                <label>Telephone Number</label>
                <input type="text" class="form-control select2"  style="width: 100%;"  name="telephone" required="">
              </div>
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Adress</label>
                <input type="text" class="form-control select2"  style="width: 100%;"  name="adress" required="">
              </div>
              <div class="form-group">
                <label>Department </label>
                <select class="form-control select2"  style="width: 100%;"  name="department">
                  <option hidden="" value="">--Select the Department--</option>
<?php
$sdp=mysqli_query($connect,"SELECT * from department");
if(mysqli_num_rows($sdp)>0){
  while($shoedp=mysqli_fetch_array($sdp)){
?>
                  <option value="<?php echo $shoedp['departID'];?>"><?php echo $shoedp['depart_name'];?></option>
<?php } } ?>
                </select>
              </div>
              <div class="form-group">
                <label>Branch Location </label>
                <select class="form-control select2"  style="width: 100%;"  name="location">
                  <option hidden="" value="">--Select the Branch Location--</option>
<?php
$sloc=mysqli_query($connect,"SELECT * from location");
if(mysqli_num_rows($sloc)>0){
  while($showloc=mysqli_fetch_array($sloc)){
?>
                  <option value="<?php echo $showloc['locationID'];?>"><?php echo $showloc['location_name'];?></option>
<?php } } ?>
                </select>
              </div>
              <div class="form-group">
                <label>Status </label>
                <select class="form-control select2"  style="width: 100%;"  name="status">
                  <option value="1">Activate</option>
                  <option value="0">Desactivate</option>
                </select>
              </div>
              <input type="submit" name="addUser" value="Register User" class="pull-right btn btn-sm btn-primary" >
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
  <!-- /.content-wrapper -->
<?php // include('footer.php');?>
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

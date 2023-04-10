<?php 
include("header.php");
include('config_database.php'); 
$category=$_SESSION['category_id'];
//Send the Ticket 
$msgConfirm='';
if(isset($_POST['sendTicket'])){
  //keep values 
  $ticketType=$_POST['ticketType'];
  $subject=$_POST['subject'];
  $Details=$_POST['Details'];
  $sentBy=$_SESSION['nn'];
  $status=1;
  if($category==1) {$ck=mysqli_query($connect,"SELECT * FROM admin where adminID='$sentBy'");$gl=mysqli_fetch_array($ck);
  $location=$gl['location'];}
  else if($category==2){ $ck=mysqli_query($connect,"SELECT * FROM subadmin where subAdminID='$sentBy'");$gl=mysqli_fetch_array($ck);
  $location=$gl['location'];}
  else if($category==3){ $ck=mysqli_query($connect,"SELECT * FROM end_users where userID='$sentBy'");$gl=mysqli_fetch_array($ck);
  $location=$gl['user_branch'];}

  if($category==1) $sentCat=2; else if($category==2) $sentCat=1; else if($category==3) $sentCat=0;
  
  //Register
  $reg=mysqli_query($connect,"INSERT INTO request(ticket_category,request_subject,request_details,sentBy,sentCategory,branchLocation,sentOn,status) values('$ticketType','$subject','$Details','$sentBy','$sentCat','$location',NOW(),'$status')");
  if($reg) { 
          $ct=mysqli_query($connect,"SELECT requestID from request order by requestID desc");
          $gt=mysqli_fetch_array($ct);
          $nt=$gt['requestID'];
          $detrequest=$Details;
          $tnb='T0000'.$nt;
          $type=1;
          $put=mysqli_query($connect,"UPDATE request set ticket_no='$tnb' where requestID='$nt'");
          if($put){
            $inmail=mysqli_query($connect,"INSERT into mailBox(requestID,ticketID,sid,category,subject,message,type,c_date) values('$nt','$tnb','$id','$category','$subject','$detrequest','$type',NOW())");
            if($inmail){echo '<script>alert("We have received your Ticket and we will get back to you asap! Ticket No: '.$tnb.' ! ")</script>'; echo '<script>document.location="sendTickets.php";</script>';}
          }
  } 
  else { echo '<script>alert("Error! Please try again.")</script>';}
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Send
        <small>New Ticket</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Send Ticket</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

     <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php if($_SESSION['category_id']==2) echo ($f1['nb_allT']+$f1e['nb_allTe']); else echo ($f1['nb_allT']);?></h3>

              <p>Total Tickects</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php if($_SESSION['category_id']==2) echo ($f4['nb_allTClosed']+$f4e['nb_allTClosede']); else echo ($f4['nb_allTClosed']);?></h3>

              <p>Open</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php if($_SESSION['category_id']==2) echo ($f3['nb_alTlPend']+$f3e['nb_alTlPende']); else echo ($f3['nb_alTlPend']);?></h3>

              <p>Pending Rate</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php if($_SESSION['category_id']==2) echo ($f2['nb_allTFx']+$f2e['nb_allTFxe']); else echo ($f2['nb_allTFx']);?></h3>

              <p>Fixed Rate</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          
          <!-- /.nav-tabs-custom -->

          <!-- quick email widget -->
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Sent Tickect Issue</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <form action="" method="post">
                <div class="form-group">
                  <select name="ticketType" required="" class="form-control">
                    <option hidden="" value="">Select the Tickect Type</option>
                <?php 
                $slc=mysqli_query($connect,"SELECT * FROM tickect_category");
                while($get=mysqli_fetch_array($slc)){
                ?>
                      <option value="<?php echo $get['ticket_category_id'];?>"><?php echo $get['ticket_category_name'];?> <?php echo $get['ticket_category_description'];?> </option>
              <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <input type="text" required="" class="form-control" name="subject" placeholder="Subject">
                </div>
                <div>
                  <textarea required="" class="textarea" name="Details" placeholder="More Details"
                            style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
                <div class="box-footer clearfix">
              <input type="submit" name="sendTicket" class="pull-right btn btn-default glyphicon glyphicon-envelop" value="Send" >
          
            </div>
              </form>
            </div>
            
          </div>


        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
       
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php // include("footer.php");?>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>

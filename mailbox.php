<?php 
include("header.php");
include('config_database.php'); 
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mailbox
        <small> new messages</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Mailbox</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <!-- /.col -->
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Inbox</h3>

         <!--     <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="Search Mail">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div>
               /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">

              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>

                                      <?php 
$count=1;

  $sRequestt=mysqli_query($connect,"SELECT * from request order by requestID desc");
 if(mysqli_num_rows($sRequestt)>0){
  while($gett=mysqli_fetch_array($sRequestt)){
    $reqID=$gett['requestID'];
    $sby=$gett['sentBy'];
    $sentCat=$gett['sentCategory'];
    //admin
    if($category==1) {
      if($sentCat==0){$sRequest=mysqli_query($connect,"SELECT * from request inner join end_users on request.sentBy=end_users.userID where request.requestID='$reqID' order by requestID desc");
      $get=mysqli_fetch_array($sRequest);
       $enames=$get['user_fname'].' '.$get['user_lname'];}
       else if($sentCat==1){$sRequest=mysqli_query($connect,"SELECT * from request inner join subadmin on request.sentBy=subadmin.subAdminID where request.requestID='$reqID'  order by requestID desc");
      $get=mysqli_fetch_array($sRequest);
       $enames=$get['subAdmin_fname'].' '.$get['subAdmin_lname'];}
      else if($sentCat==2){$sRequest=mysqli_query($connect,"SELECT * from request inner join admin on admin.adminID=request.sentBy where request.requestID='$reqID' order by requestID desc");
    $get=mysqli_fetch_array($sRequest);
       $enames=$get['admin_fname'].' '.$get['admin_lname'];}
    }
    //sub admin
    if($category==2) {
      if($gett['status']==1){
       $sRequest=mysqli_query($connect,"SELECT * from request inner join subadmin on request.sentBy=subadmin.subAdminID where request.requestID='$reqID' and request.sentCategory=1 and request.status=1 AND subadmin.subAdminID='$id' order by requestID desc");
      $get=mysqli_fetch_array($sRequest);
       $enames=$get['subAdmin_fname'].' '.$get['subAdmin_lname'];
      }
      else{
        if($sentCat==0){ $sRequest=mysqli_query($connect,"SELECT * from request inner  join end_users on end_users.userID=request.sentBy inner join subadmin on request.assignTo=subadmin.subAdminID where request.requestID='$reqID' and request.sentCategory=0 AND subadmin.subAdminID='$id' order by requestID desc");
        $get=mysqli_fetch_array($sRequest);
       $enames=$get['user_fname'].' '.$get['user_lname'];
      }
      else if($sentCat==1){ 
        if($gett['sentBy']==$id){
        $sRequest=mysqli_query($connect,"SELECT * from request inner join  subadmin on request.sentBy=subadmin.subAdminID where subadmin.subAdminID='$id' ");
        $get=mysqli_fetch_array($sRequest);
       $enames=$get['subAdmin_fname'].' '.$get['subAdmin_lname'];
        }
        else if ($gett['assignTo']==$id)
        {
          $ikp=$gett['assignTo'];
  $sRequest=mysqli_query($connect,"SELECT * from request inner join  subadmin on request.sentBy=subadmin.subAdminID where subadmin.subAdminID='$sby' ");
        $get=mysqli_fetch_array($sRequest);
       $enames=$get['subAdmin_fname'].' '.$get['subAdmin_lname'];
        }
      }
      else if($sentCat==2){ $sRequest=mysqli_query($connect,"SELECT * from request  inner join admin on admin.adminID=request.sentBy where request.requestID='$reqID'  AND request.assignTo='$id' order by requestID desc");
        $get=mysqli_fetch_array($sRequest);
       $enames=$get['admin_fname'].' '.$get['admin_lname'];
      }
    }
  }
  //end user
   if($category==3) {
          $sRequest=mysqli_query($connect,"SELECT * from request inner join end_users on request.sentBy=end_users.userID where request.requestID='$reqID' and end_users.userID='$id' and sentBy='$id' and sentCategory=0 order by requestID desc");
      $get=mysqli_fetch_array($sRequest);
       $enames=$get['user_fname'].' '.$get['user_lname'];
    }

  if(mysqli_num_rows($sRequest)>0){
  $urlHs=(24967*$get['requestID'])+325649;
 
?>
                  <tr>
                    <td><input type="checkbox"></td>
                    <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                    <td class="mailbox-name"><a href="read-mail.php?rSh=<?php echo $urlHs;?>"><?php echo $enames?></a></td>
                    <td class="mailbox-subject"><b><?php echo $get['ticket_no']?></b> - <?php echo $get['request_subject']?></td>
                    <td class="mailbox-attachment"></td>
                                       <td class="mailbox-date"><?php echo $get['sentOn']?></td>
                  </tr>
                  <tr>
                  </tr>
<?php $count++;}}} ?>
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
        
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- Page Script -->
<script>
  $(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");

      //Switch states
      if (glyph) {
        $this.toggleClass("glyphicon-star");
        $this.toggleClass("glyphicon-star-empty");
      }

      if (fa) {
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
    });
  });
</script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
</body>
</html>

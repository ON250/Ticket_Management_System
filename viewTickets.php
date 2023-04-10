<?php 
include("header.php");
include('config_database.php'); 
$id=$_SESSION['nn'];
?>
<?php
 if(isset($_POST['Update'])){
     $Description=htmlspecialchars($_POST['Description']);
     $requestID=htmlspecialchars($_POST['requestID']);
     $status=3;
      $Resolve=mysqli_query($connect,"UPDATE request set feedBackComment='$Description', feedBackOn=NOW(),status='$status' where requestID='$requestID'");
       if($Resolve) { 
          echo '<script>alert("Ticket Resolved Succsesffuly! ")</script>';
          echo '<script>document.location="viewTickets.php";</script>';
  } 
  else { echo '<script>alert("Error! Please try again.")</script>';}
}


  
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        All 
        <small> Administrators</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">System</a></li>
        <li class="active"> Administrators</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
          <div class="box">
            <!-- /.box-header -->
             <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#No</th>
                  <th>Ticket No#</th>
                  <th>Ticket Category</th>
                  <th>Subject</th>
                  <th>Sent On</th>
                  <th>Sent By</th>
                  <th>Assigned On</th>
                  <th>Assigned By</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
<?php 
$count=1;

$slADMs=mysqli_query($connect,"SELECT * FROM request  order by requestID desc");
if(mysqli_num_rows($slADMs)>0){
  while($shows=mysqli_fetch_array($slADMs)){
    $reqID=$shows['requestID'];
  if($shows['status']==1){
          $slADM=mysqli_query($connect,"SELECT * FROM request inner join subadmin on subadmin.subAdminID=request.sentBy   inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category  WHERE subadmin.subAdminID='$id' and request.requestID='$reqID' and sentCategory=1 order by requestID desc");
  }
  else if($shows['status']!=1){
        if($shows['sentCategory']==1){
          $slADM=mysqli_query($connect,"SELECT * FROM request inner join subadmin on subadmin.subAdminID=request.assignTo   inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category  WHERE subadmin.subAdminID='$id' and request.requestID='$reqID' and sentCategory=1 order by requestID desc");
        }
        else if($shows['sentCategory']==2){
          $slADM=mysqli_query($connect,"SELECT * FROM request inner join subadmin on subadmin.subAdminID=request.assignTo   inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category  WHERE subadmin.subAdminID='$id' and request.requestID='$reqID' and sentCategory=2 order by requestID desc");
        }
        else if($shows['sentCategory']==0){
          $slADM=mysqli_query($connect,"SELECT * FROM request inner join subadmin on subadmin.subAdminID=request.assignTo   inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users on end_users.userID=request.sentBy  WHERE subadmin.subAdminID='$id' and request.requestID='$reqID' and sentCategory=0 order by requestID desc");
        }
  }
  
  if(mysqli_num_rows($slADM)>0){
    $show=mysqli_fetch_array($slADM);
    $sid=$show['sentBy'];
    $asid=$show['assignBy'];
        $kll=mysqli_query($connect,"SELECT * FROM admin where adminID='$sid'");
        $sn=mysqli_fetch_array($kll);
        $sname=$sn['admin_fname'].' '.$sn['admin_lname'];
        $klla=mysqli_query($connect,"SELECT * FROM admin where adminID='$asid'");
        $sna=mysqli_fetch_array($klla);
        $asname=$sna['admin_fname'].' '.$sna['admin_lname'];
        $klls=mysqli_query($connect,"SELECT * FROM subadmin where subAdminID='$sid'");
        $sns=mysqli_fetch_array($klls);
        $snames=$sns['subAdmin_fname'].' '.$sns['subAdmin_lname'];
    $urlHs=(14967*$show['requestID'])+225649;
    $urlHsM=(24967*$show['requestID'])+325649;
?>
                <tr>
                  <td><?php echo $count;?></td>
                  <td><?php echo $show['ticket_no'];?> </td>
                  <td><?php echo $show['ticket_category_name'];?></td>
                  <td><?php echo $show['request_subject'];?></td>
                  <td><?php echo $show['sentOn'];?></td>

                  <td><?php if($show['sentCategory']==1) echo $snames; else if($show['sentCategory']==0) echo $show['user_fname'].' '.$show['user_fname']; else if($show['sentCategory']==2) echo $sname;?></td>

                  <td><?php if($show['status']==1) echo '-'; else if($show['status']!=1) echo $show['assignOn'];?></td>
                  <td><?php if($show['status']==1) echo '-'; else if($show['status']!=1) { echo $asname;}?></td>
                  <td><?php if($show['status']==1) echo '<strong class="text-red">Open</strong>'; if($show['status']==2) echo '<strong class="text-warning">Pending...</strong>'; else if($show['status']==3) echo '<strong class="text-success">Fixed<strong/>'; else if($show['status']==4) echo '<strong class="text-danger">Closed<strong/>'; ?></td>
                    <td><?php 
                    if($show['status']==2) { ?><a href="" class="btn btn-default btn-xs btn-success " data-toggle="modal" <?php  echo 'data-target="#resolve'.$show['requestID'].'ers"'; ?> > <small>Resolve</small></a> <?php } else   if($show['status']==3) { ?><a href="" class="btn btn-default btn-diseabled btn-xs btn-default " data-toggle="modal" <?php  echo 'data-target="#resolve'.$show['requestID'].'ersdis"'; ?> > <small>Resolved</small></a> <?php }
                    ?> <a href="read-mail.php?rSh=<?php echo $urlHsM;?>" class="btn btn-primary btn-xs "  > <small>Reply</small></a></td>
                </tr>
<?php $count++; } } } ?>
              </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
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
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<!--modal to add new user-->
      <!-- Logout Modal-->
<?php 
$count=1;

$slADMs=mysqli_query($connect,"SELECT * FROM request  order by requestID desc");
if(mysqli_num_rows($slADMs)>0){
  while($shows=mysqli_fetch_array($slADMs)){
    $reqID=$shows['requestID'];
     if($shows['sentCategory']==1) {
        if($shows['status']==1) {$slADM=mysqli_query($connect,"SELECT * FROM request inner join subadmin on subadmin.subAdminID=request.sentBy  inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category  WHERE subadmin.subAdminID='$id' and request.requestID='$reqID' and request.sentCategory=1 order by requestID desc");}
        else if($shows['status']==2) {$slADM=mysqli_query($connect,"SELECT * FROM request inner join subadmin on subadmin.subAdminID=request.assignTo inner join admin on request.assignBy=admin.adminID inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category  WHERE subadmin.subAdminID='$id' and request.requestID='$reqID' and request.sentCategory=1 order by requestID desc");}
      }
    else if($shows['sentCategory']==0 ) {
        $slADM=mysqli_query($connect,"SELECT * FROM request inner join subadmin on subadmin.subAdminID=request.assignTo inner join admin on request.assignBy=admin.adminID inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID WHERE subadmin.subAdminID='$id' and request.requestID='$reqID' and request.sentCategory=0 order by requestID desc");}

    else if($shows['sentCategory']==2 ) {
        $slADM=mysqli_query($connect,"SELECT * FROM request inner join subadmin on subadmin.subAdminID=request.assignTo inner join admin on request.assignBy=admin.adminID  inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category  WHERE subadmin.subAdminID='$id' and request.requestID='$reqID' order by requestID desc");}
  
  if(mysqli_num_rows($slADM)>0){
    $show=mysqli_fetch_array($slADM);
    $sid=$show['sentBy'];
        $kll=mysqli_query($connect,"SELECT * FROM admin where adminID='$sid'");
        $sn=mysqli_fetch_array($kll);
        $sname=$sn['admin_fname'].' '.$sn['admin_lname'];
    $urlHs=(14967*$show['requestID'])+225649;
    $urlHsM=(24967*$show['requestID'])+325649;
?>

    <div class="modal fade"  <?php  echo 'id="resolve'.$show['requestID'].'ers"';?> tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header"><p class="modal-title" id="exampleModalLabel">BDF Tickets <span class="text-muted"> | Resolve Ticket</span></p></div>
          <div class="modal-body">
           <div class="" style="padding-right: 10px;padding-left: 10px;">
              <form method="post" action="" class="form-group" style="shape-margin: 20px;">
              <div class="row">
                <input type="text" name="category"  value="<?php echo $show['ticket_no'];?>" required="" autofocus="" class="col-md-9 form-control" readonly>
              </div><br>
              <div class="row">
                <input type="text" name="category"  value="<?php echo $show['ticket_category_name'];?>"  required="" autofocus="" class="col-md-9 form-control" readonly>
              </div><br>
              <div class="row">
                <input type="text" name="category"  value="<?php echo $show['request_subject'];?>"  required="" autofocus="" class="col-md-9 form-control" readonly>
              </div><br>
              <input type="test" hidden="" name="requestID"  value="<?php echo $show['requestID'];?>">
              <div class="row">
                <label class="col-md-9">Description</label>
                <textarea name="Description" class="col-md-12 textarea" placeholder="Details" required=""></textarea>
              </div><br>
              <center><button class="btn btn-secondary btn-default" type="button" data-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-sm btn-primary" name="Update" value="Resolve Ticket"></center>
            </form>
           </div>
          </div>
        </div>
      </div>
    </div>

 
  <?php  } } } ?>
    <!--end  add new user-->
</body>
</html>

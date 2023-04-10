<?php 
include("header.php");
include('config_database.php'); 
    
if(isset($_POST['assignTicket'])){
  //keep values 
  $assignTo=$_POST['assignTo'];
  $request_id=$_POST['request_id'];
  $Description=$_POST['Description'];
  $assignBy=$_SESSION['nn'];
  $status=2;

  $lsk=mysqli_query($connect,"SELECT * FROM subadmin where subAdminID='$assignTo'");
  $lskt=mysqli_query($connect,"SELECT * FROM request where requestID='$request_id'");
  $st=mysqli_fetch_array($lsk);
  $stt=mysqli_fetch_array($lskt);
  $subAdmin=$st['subAdmin_fname'].' '.$st['subAdmin_lname'];
  $ticket_no=$stt['ticket_no'];
  
  //Register
  $reg=mysqli_query($connect,"UPDATE request SET assignTo='$assignTo', assignBy='$assignBy', assignOn=NOW(), assignComment='$Description', status='$status' where requestID='$request_id'");
  if($reg) { 
      $type=2;
      $inmail=mysqli_query($connect,"INSERT into mailBox(requestID,ticketID,sid,category,message,type,c_date) values('$request_id','$ticket_no','$id','$category','$Description','$type',NOW())");
          if($inmail) {echo '<script>alert("The Ticket '.$ticket_no.' has been Assigned to '.$subAdmin.' Successfully! ")</script>'; echo '<script>document.location="tickets.php";</script>';}
  } 
  else { echo '<script>alert("Error! Please try again.")</script>';}
}

    
if(isset($_POST['reassignTicket'])){
  //keep values 
  $assignTo=$_POST['assignTo'];
  $request_id=$_POST['request_id'];
  $Description=$_POST['Description'];
  $assignBy=$_SESSION['nn'];
  $status=2;

  $lsk=mysqli_query($connect,"SELECT * FROM subadmin where subAdminID='$assignTo'");
  $lskt=mysqli_query($connect,"SELECT * FROM request where requestID='$request_id'");
  $st=mysqli_fetch_array($lsk);
  $stt=mysqli_fetch_array($lskt);
  $subAdmin=$st['subAdmin_fname'].' '.$st['subAdmin_lname'];
  $ticket_no=$stt['ticket_no'];
  
  //Register
  $reg=mysqli_query($connect,"UPDATE request SET assignTo='$assignTo', assignBy='$assignBy', assignOn=NOW(), assignComment='$Description', status='$status' where requestID='$request_id'");
  if($reg) { 
      $type=2;
      $inmail=mysqli_query($connect,"INSERT into mailBox(requestID,ticketID,sid,category,message,type,c_date) values('$request_id','$ticket_no','$id','$category','$Description','$type',NOW())");
          if($inmail) {echo '<script>alert("The Ticket '.$ticket_no.' has been Reassigned to '.$subAdmin.' Successfully! ")</script>'; echo '<script>document.location="tickets.php";</script>';}
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
        <small> Tickets</small>
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
                  <th>Branch</th>
                  <th>Sent On</th>
                  <th>Sent By</th>
                  <th>Assigned On</th>
                  <th>Assigned To</th>
                  <th>Status</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
<?php 
$count=1;
$slADMr=mysqli_query($connect,"SELECT *,date_format(request.sentOn,'%d/%m/%Y') as sentOndate,date_format(request.assignOn,'%d/%m/%Y') as assignOndate FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category  inner join location on request.branchLocation = location.locationID order by requestID desc");
if(mysqli_num_rows($slADMr)>0){
  while($showr=mysqli_fetch_array($slADMr)){
    $ikd=$showr['requestID'];
if($showr['status']==1)
 { 
    if($showr['sentCategory']==0)
     {
      $slADM=mysqli_query($connect,"SELECT *,date_format(request.sentOn,'%d/%m/%Y') as sentOndate,date_format(request.assignOn,'%d/%m/%Y') as assignOndate FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category  inner join end_users on end_users.userID=request.sentBy inner join location on request.branchLocation = location.locationID where requestID='$ikd' and sentCategory=0 order by requestID desc");
      }
      else if($showr['sentCategory']==1)
     {
      $slADM=mysqli_query($connect,"SELECT *,date_format(request.sentOn,'%d/%m/%Y') as sentOndate,date_format(request.assignOn,'%d/%m/%Y') as assignOndate FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join subadmin on subadmin.subAdminID=request.sentBy inner join location on request.branchLocation = location.locationID where requestID='$ikd' and sentCategory=1 order by requestID desc");
      }
      else if($showr['sentCategory']==2)
     {
      $slADM=mysqli_query($connect,"SELECT *,date_format(request.sentOn,'%d/%m/%Y') as sentOndate,date_format(request.assignOn,'%d/%m/%Y') as assignOndate FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category  inner join admin on admin.adminID=request.sentBy inner join location on request.branchLocation = location.locationID where requestID='$ikd' and sentCategory=2 order by requestID desc");
      }
 }
 else{
    if($showr['sentCategory']==0)
     {
      $slADM=mysqli_query($connect,"SELECT *,date_format(request.sentOn,'%d/%m/%Y') as sentOndate,date_format(request.assignOn,'%d/%m/%Y') as assignOndate FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category  inner join end_users on end_users.userID=request.sentBy inner join subadmin on subadmin.subAdminID=request.assignTo inner join location on request.branchLocation = location.locationID where requestID='$ikd' and sentCategory=0 order by requestID desc");
      }
      else if($showr['sentCategory']==1)
     {
      $slADM=mysqli_query($connect,"SELECT *,date_format(request.sentOn,'%d/%m/%Y') as sentOndate,date_format(request.assignOn,'%d/%m/%Y') as assignOndate FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join subadmin on subadmin.subAdminID=request.sentBy inner join location on request.branchLocation = location.locationID where requestID='$ikd' and sentCategory=1 order by requestID desc");
      }
      else if($showr['sentCategory']==2)
     {
      $slADM=mysqli_query($connect,"SELECT *,date_format(request.sentOn,'%d/%m/%Y') as sentOndate,date_format(request.assignOn,'%d/%m/%Y') as assignOndate FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category  inner join admin on admin.adminID=request.sentBy inner join subadmin on subadmin.subAdminID=request.assignTo inner join location on request.branchLocation = location.locationID where requestID='$ikd' and sentCategory=2 order by requestID desc");
      }
 }
    if(mysqli_num_rows($slADM)>0)
    {
      $show=mysqli_fetch_array($slADM);
      $sid=$show['assignTo'];
        $kll=mysqli_query($connect,"SELECT * FROM subadmin where subAdminID='$sid'");
        $sn=mysqli_fetch_array($kll);
        $sname=$sn['subAdmin_fname'].' '.$sn['subAdmin_lname'];
      $urlHs=(24967*$show['requestID'])+325649;
?>
                <tr>
                  <td><?php echo $count;?></td>
                  <td><?php echo $show['ticket_no'];?> </td>
                  <td><?php echo $show['ticket_category_name'];?></td>
                  <td><?php echo $show['location_name'];?></td>
                  <td><?php echo $show['sentOndate'];?></td>
          <?php if($show['sentCategory']==0) { ?><td><?php echo $show['user_fname'].' '.$show['user_lname'];?></td> <?php } else if($show['sentCategory']==1)  { ?><td><?php echo $show['subAdmin_fname'].' '.$show['subAdmin_lname'];?></td><?php } else if($show['sentCategory']==2)  { ?><td><?php echo $show['admin_fname'].' '.$show['admin_lname'];?></td><?php } ?>

                <?php if($show['status']!=1) { ?>  <td><?php echo $show['assignOndate'];?></td> <?php } else { ?><td>-</td><?php } ?>
             <?php if($show['status']!=1) { ?>  <td><?php if($show['sentCategory']==1) echo $sname; else echo $show['subAdmin_fname'].' '.$show['subAdmin_lname']; ?></td><?php } else { ?><td>-</td><?php } ?>

                  <td><?php if($show['status']==1) echo '<strong class="text-danger">Open</strong>';   if($show['status']==2) echo '<strong class="text-warning">Pending...</strong>'; else if($show['status']==3) echo '<strong class="text-success">Fixed<strong/>'; else if($show['status']==4) echo '<strong class="text-danger">Closed<strong/>'; ?>
                  <td><a href="read-mail.php?rSh=<?php echo $urlHs;?>" class="btn btn-default btn-xs glyphicon glyphicon-pencil"></a>
              <?php if($show['status']==1) { ?><a href="" class="btn btn-default btn-xs btn-primary " data-toggle="modal" <?php  echo 'data-target="#assign'.$show['requestID'].'ers"'; ?> > <small>Assign</small></a> <?php } else   if($show['status']==2) { ?><a href="" class="btn btn-default btn-diseabled btn-xs btn-default " data-toggle="modal" <?php  echo 'data-target="#reassign'.$show['requestID'].'ers"'; ?> > <small>Reassign</small></a> <?php } ?>
                   </td>
                </tr>



 <div class="modal fade"  <?php  echo 'id="assign'.$show['requestID'].'ers"';?> tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header"><p class="modal-title" id="exampleModalLabel">BDF Tickets <span class="text-muted"> | Assign Ticket</span></p></div>
          <div class="modal-body">
           <div class="" style="padding-right: 10px;padding-left: 10px;">
              <form method="post" action="" class="form-group" style="shape-margin: 20px;">
              <div class="row">
                <input type="text" name="category"  value="<?php echo $show['ticket_no'];?>" required="" autofocus="" class="col-md-9 form-control" readonly>
                <input type="hidden" name="request_id"   value="<?php echo $show['requestID'];?>" required="" autofocus="" class="col-md-9 form-control" readonly>
              </div><br>
             
              <div class="row">
                <input type="text" name="category"  value="<?php echo $show['request_subject'];?>"  required="" autofocus="" class="col-md-9 form-control" readonly>
              </div><br>
              <div class="row">
                  <select name="assignTo" required=""  style="width: 100%;" class="form-control select2">
                    <option hidden="" value="">Assign This Ticket To ...</option>
                <?php 
                $slc=mysqli_query($connect,"SELECT * FROM subadmin");
                while($get=mysqli_fetch_array($slc)){
                ?>
                      <option value="<?php echo $get['subAdminID'];?>"><?php echo $get['subAdmin_fname'];?> <?php echo $get['subAdmin_lname'];?> </option>
              <?php } ?>
                  </select>
                </div><br>
              <input type="test" hidden="" name="requestID"  value="<?php echo $show['requestID'];?>">
              <div class="row">
                <textarea name="Description" rows="4" class="col-md-12 textarea" placeholder="Assign with Description..." required=""></textarea>
              </div><br>
              <center><button class="btn btn-secondary btn-default" type="button" data-dismiss="modal">Cancel</button>
                <input type="submit" name="assignTicket" class=" btn btn-primary" value="Assign This Ticket" >
            </form>
           </div>
          </div>
        </div>
      </div>
    </div>


 <div class="modal fade"  <?php  echo 'id="reassign'.$show['requestID'].'ers"';?> tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header"><p class="modal-title" id="exampleModalLabel">BDF Tickets <span class="text-muted"> | Rassign Ticket</span></p></div>
          <div class="modal-body">
           <div class="" style="padding-right: 10px;padding-left: 10px;">
               <form method="post" action="" class="form-group" style="shape-margin: 20px;">
              <div class="row">
                <input type="text" name="category"  value="<?php echo $show['ticket_no'];?>" required="" autofocus="" class="col-md-9 form-control" readonly>
                <input type="hidden" name="request_id"   value="<?php echo $show['requestID'];?>" required="" autofocus="" class="col-md-9 form-control" readonly>
              </div><br>
             
              <div class="row">
                <input type="text" name="category"  value="<?php echo $show['request_subject'];?>"  required="" autofocus="" class="col-md-9 form-control" readonly>
              </div><br>
              <div class="row">
                  <select name="assignTo" required=""  style="width: 100%;" class="form-control select2">
                    <option hidden="" value="">Assign This Ticket To ...</option>
                <?php 
                $slc=mysqli_query($connect,"SELECT * FROM subadmin");
                while($get=mysqli_fetch_array($slc)){
                ?>
                      <option value="<?php echo $get['subAdminID'];?>"><?php echo $get['subAdmin_fname'];?> <?php echo $get['subAdmin_lname'];?> </option>
              <?php } ?>
                  </select>
                </div><br>
              <input type="test" hidden="" name="requestID"  value="<?php echo $show['requestID'];?>">
              <div class="row">
                <textarea name="Description" rows="4" class="col-md-12 textarea" placeholder="Assign with Description..." required=""></textarea>
              </div><br>
              <center><button class="btn btn-secondary btn-default" type="button" data-dismiss="modal">Cancel</button>
                <input type="submit" name="reassignTicket" class=" btn btn-primary" value="Reassign This Ticket" >
            </form>
           </div>
          </div>
        </div>
      </div>
    </div>
<?php
$count++;
 } } } ?>
              </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>

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
</body>
</html>

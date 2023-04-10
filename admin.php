<?php 
include("header.php");
include('config_database.php'); 
?>
 <?php 
  if(isset($_POST['delete'])){
    $adminID=htmlspecialchars($_POST['adminID']);
    $Delete=mysqli_query($connect,"DELETE from admin where adminID='$adminID'");
    if($Delete) { 
          echo '<script>alert("Admininstrator was Deleted Succsesffuly! ")</script>';
  } 
  else { echo '<script>alert("Error! Please try again.")</script>';}
  }

   if(isset($_POST['resetP'])){
    $adminID=htmlspecialchars($_POST['adminID']);
    $psswd='BDF@2019';
    $Password=sha1($psswd);
    $reset=mysqli_query($connect,"UPDATE admin SET admin_password='$Password',admin_pin=0 where adminID='$adminID'");
    if($reset) { 
          echo '<script>alert("Admin\'s Password was Reseted Succsesffuly! Default Password : BDF@2019")</script>';
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
                  <th>Names</th>
                  <th>Email</th>
                  <th>Telephone</th>
                  <th>Adress</th>
                  <th>Location</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
<?php 
$count=1;
$slADM=mysqli_query($connect,"SELECT * FROM admin inner join location on location.locationID=admin.location where admin.type!=123 order by adminID desc");
if(mysqli_num_rows($slADM)>0){
  while($show=mysqli_fetch_array($slADM)){
    $urlHs=(14967*$show['adminID'])+225649;
?>
                <tr>
                  <td><?php echo $count;?></td>
                  <td><?php echo $show['admin_fname'].' '.$show['admin_lname'];?> </td>
                  <td><?php echo $show['admin_email'];?></td>
                  <td><?php echo $show['admin_telephone'];?></td>
                  <td><?php echo $show['admin_adress'];?></td>
                  <td><?php echo $show['location_name'];?></td>
                  <td><?php if($show['admin_status']==1) echo 'Activated'; else if($show['admin_status']==0) echo 'Desactivated'; ?></td>
                  <td><a href="editAdmin.php?rSh=<?php echo $urlHs;?>" class="btn btn-default btn-xs glyphicon glyphicon-pencil"></a> <a href="" class="btn btn-default btn-xs glyphicon glyphicon-remove" data-toggle="modal" <?php  echo 'data-target="#remove'.$show['adminID'].'ers"'; ?>></a> <a href="" class="btn btn-default btn-xs glyphicon glyphicon-refresh"  data-toggle="modal" <?php  echo 'data-target="#reset'.$show['adminID'].'ers"'; ?>> Reset</a></td>
                </tr>
<?php $count++;}} ?>
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
<?php 
$count=1;
$slADM=mysqli_query($connect,"SELECT * FROM admin order by adminID desc");
if(mysqli_num_rows($slADM)>0){
  while($show=mysqli_fetch_array($slADM)){
    $urlHs=(14967*$show['adminID'])+225649;
?>
    <div class="modal fade"  <?php  echo 'id="remove'.$show['adminID'].'ers"';?> tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header"><p class="modal-title" id="exampleModalLabel">BDF Tickets <span class="text-muted"> | Delete Admin Account</span></p></div>
          <div class="modal-body">
           <div class="" style="padding-right: 10px;padding-left: 10px;">
              <form method="post" action="" class="form-group" style="shape-margin: 20px;">
              <center><label>Do you want To delete This Admin ?</label><br>
              <input type="test" hidden="" value="<?php echo $show['adminID'];?>" name="adminID">
              <button class="btn btn-secondary btn-default" type="button" data-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-sm btn-primary" name="delete" value="Delete"></center>
            </form>
           </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade"  <?php  echo 'id="reset'.$show['adminID'].'ers"';?> tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header"><p class="modal-title" id="exampleModalLabel">BDF Tickets <span class="text-muted"> | Reset Password</span></p></div>
          <div class="modal-body">
           <div class="" style="padding-right: 10px;padding-left: 10px;">
              <form method="post" action="" class="form-group" style="shape-margin: 20px;">
              <center><label>Do you want To Reset the Password of  This Admin ?</label><br>
              <input type="test" hidden="" value="<?php echo $show['adminID'];?>" name="adminID">
              <button class="btn btn-secondary btn-default" type="button" data-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-sm btn-primary" name="resetP" value="Reset Password"></center>
            </form>
           </div>
          </div>
        </div>
      </div>
    </div>
  <?php }}?>
</body>
</html>

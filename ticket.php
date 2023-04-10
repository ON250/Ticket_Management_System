<?php 
include("header.php");
include('config_database.php'); 
$id=$_SESSION['nn'];
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
                  <th>Assigned On</th>
                  <th>Assigned By</th>
                  <th>Assigned To</th>
                  <th>Status</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
<?php 
$count=1;
$slADM=mysqli_query($connect,"SELECT * FROM request inner join end_users on end_users.userID=request.sentBy inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category WHERE end_users.userID='$id' and request.sentCategory=0 order by requestID desc");
if(mysqli_num_rows($slADM)>0){
  while($show=mysqli_fetch_array($slADM)){
    $urlHs=(24967*$show['requestID'])+325649;
      if($show['status']!=1) {
        $slFF=mysqli_query($connect,"SELECT * FROM request inner join end_users on end_users.userID=request.sentBy inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join admin on admin.adminID=request.assignBy inner join subadmin on subadmin.subAdminID=request.assignTo WHERE end_users.userID='$id' and requestID='".$show['requestID']."' order by requestID desc");
        $gett=mysqli_fetch_array($slFF);
      } 
?>
                <tr>
                  <td><?php echo $count;?></td>
                  <td><?php echo $show['ticket_no'];?> </td>
                  <td><?php echo $show['ticket_category_name'];?></td>
                  <td><?php echo $show['request_subject'];?></td>
            <?php if($show['status']!=1){?>
                  <td><?php echo $gett['assignOn'];?></td>
                  <td><?php echo $gett['admin_fname'].' '.$gett['admin_fname'];?></td>
                  <td><?php echo $gett['subAdmin_fname'].' '.$gett['subAdmin_fname'];?></td>
              <?php }
              else { ?>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                <?php } ?>
                  <td><?php if($show['status']==1) echo '<strong class="text-red">Open</strong>';   if($show['status']==2) echo '<strong class="text-warning">Pending...</strong>'; else if($show['status']==3) echo '<strong class="text-success">Fixed<strong/>'; ?></td>
                  <td><a href="read-mail.php?rSh=<?php echo $urlHs;?>" class="btn btn-default btn-xs glyphicon glyphicon-pencil"></a></td>
                </tr>
<?php $count++; } } ?>
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
</body>
</html>

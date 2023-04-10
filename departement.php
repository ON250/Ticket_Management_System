<?php 
include("header.php");
include('config_database.php'); 
?>
     <?php 
  if(isset($_POST['delete'])){
    $departID=htmlspecialchars($_POST['departID']);
    $Delete=mysqli_query($connect,"DELETE from department where departID='$departID'");
    if($Delete) { 
          echo '<script>alert("Deparment Deleted Succsesffuly! ")</script>';
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
        <small> Deparment</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Ticket</a></li>
        <li class="active"> Categories</li>
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
                  <th>Deparment name</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
<?php 
$count=1;
$sDepart=mysqli_query($connect,"SELECT * FROM department order by departID desc");
if(mysqli_num_rows($sDepart)>0){
  while($show=mysqli_fetch_array($sDepart)){
    $urlHs=(14967*$show['departID'])+225649;
?>
                <tr>
                  <td><?php echo $count;?></td>
                  <td><?php echo $show['depart_name'];?> </td>
                  <td><a href="editDeparment.php?rSh=<?php echo $urlHs;?>" class="btn btn-default btn-xs glyphicon glyphicon-pencil"></a> </td>
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

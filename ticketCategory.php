<?php 
include("header.php");
include('config_database.php'); 
?>
<?php 
  if(isset($_POST['delete'])){
    $ticket_category_id=htmlspecialchars($_POST['ticket_category_id']);
    $Delete=mysqli_query($connect,"DELETE from tickect_category where ticket_category_id='$ticket_category_id'");
    if($Delete) { 
          echo '<script>alert("Ticket Deleted Succsesffuly! ")</script>';
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
        <small> Ticket Categories</small>
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
                  <th>Ticket Category</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
<?php 
$count=1;
$slADM=mysqli_query($connect,"SELECT * FROM tickect_category order by ticket_category_id desc");
if(mysqli_num_rows($slADM)>0){
  while($show=mysqli_fetch_array($slADM)){
    //$urlHs=(14967*$show['adminID'])+225649;
?>
                <tr>
                  <td><?php echo $count;?></td>
                  <td><?php echo $show['ticket_category_name'];?> </td>
                  <td><?php echo $show['ticket_category_description'];?></td>
                  <td><a href="" class="btn btn-default btn-xs glyphicon glyphicon-pencil"></a> <a href="" class="btn btn-default btn-xs glyphicon glyphicon-remove" data-toggle="modal" <?php  echo 'data-target="#remove'.$show['ticket_category_id'].'ers"'; ?>></a></td>
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
  <!-- /.content-wrapper -->
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
$slADM=mysqli_query($connect,"SELECT * FROM tickect_category order by ticket_category_id desc");
if(mysqli_num_rows($slADM)>0){
  while($show=mysqli_fetch_array($slADM)){
    //$urlHs=(14967*$show['adminID'])+225649;
?>
 <div class="modal fade"  <?php  echo 'id="remove'.$show['ticket_category_id'].'ers"';?> tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header"><p class="modal-title" id="exampleModalLabel">BDF Tickets <span class="text-muted"> | Delete Ticket Category</span></p></div>
          <div class="modal-body">
           <div class="" style="padding-right: 10px;padding-left: 10px;">
              <form method="post" action="" class="form-group" style="shape-margin: 20px;">
              <center><label>Do you want To delete This Ticket?</label><br>
              <input type="test" hidden="" value="<?php echo $show['ticket_category_id'];?>" name="ticket_category_id">
              <button class="btn btn-secondary btn-default" type="button" data-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-sm btn-primary" name="delete" value="Delete"></center>
            </form>
           </div>
          </div>
        </div>
      </div>
    </div>
  <?php } }?>
</body>
</html>

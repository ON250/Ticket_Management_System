<?php 
include("header.php");
include('config_database.php'); 
if($_SESSION['category_id']!=3) header("location: dashboard.php");
$subNames=$_SESSION['names'];

$dgdl=mysqli_query($connect,"SELECT * FROM end_users inner join  location ON location.locationID=end_users.user_branch inner join department on department.departID=end_users.user_department where end_users.userID='$id'");
$gtl=mysqli_fetch_array($dgdl);
$location_name=$gtl['location_name'];
$department=$gtl['depart_name'];
$gett=getdate(); $jour= $gett['mday']; $mois=$gett['mon']; $an=$gett['year'];
?>
 <script type="text/javascript">
     var XMLHttpRequestObject=false;
    if(window.XMLHttpRequest){
      XMLHttpRequestObject=new XMLHttpRequest();
    }else if(window.ActiveXObject){
      XMLHttpRequestObject=new ActiveXObject("Microsoft.XMLHTTP");
    }
    //the function for the history of the  vente operations  
    
    //the function for the history of the  vente operations  
    function getreport(){
      if(XMLHttpRequestObject){
        XMLHttpRequestObject.open("POST","getreport.php");
        XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        XMLHttpRequestObject.onreadystatechange=function(){

        var report=document.getElementById("departreport").value;
        if(XMLHttpRequestObject.readyState==4 && XMLHttpRequestObject.status==200){
          if(report!=""){
          var datar=XMLHttpRequestObject.responseText;
          var divsee=document.getElementById("getreport");
          divsee.innerHTML=datar;

          var datarx='<a href="excels.php" class="btn btn-primary btn-sm pull-right glyphicon glyphicon-print"> Print</a>';
          var divseex=document.getElementById("getreportPrint");
          divseex.innerHTML=datarx;
        }


        }
        
        }
        var report=document.getElementById("departreport").value;
        var dat1=document.getElementById("date1").value;
        var stat=document.getElementById("status").value;
        var dat2=document.getElementById("date2").value;
        var data=report+'|'+stat+'|'+dat1+'|'+dat2+'|';

        XMLHttpRequestObject.send("data=" + data);
      }
      return false;
    }

    function getreportS(){
      if(XMLHttpRequestObject){
        XMLHttpRequestObject.open("POST","getreportUsers.php");
        XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        XMLHttpRequestObject.onreadystatechange=function(){

        if(XMLHttpRequestObject.readyState==4 && XMLHttpRequestObject.status==200){
          var datar=XMLHttpRequestObject.responseText;
          var divsee=document.getElementById("getreport");
          divsee.innerHTML=datar;

          var datarx='<a href="excels.php" class="btn btn-primary btn-sm pull-right glyphicon glyphicon-print"> Print</a>';
          var divseex=document.getElementById("getreportPrint");
          divseex.innerHTML=datarx;
          
        }
        
      }
        var stat=document.getElementById("status").value;
        XMLHttpRequestObject.send("data=" + stat);
      }
      return false;
    }
</script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        All 
        <small> Repport</small>
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
                <div class="row ">
                    
                      <div class="col-md-2">
                      <select name="status" id="status" onchange="getreportS();" class=" form-control">
                        <option value="0">Show All Status</option>
                        <option value="1">Open</option>
                        <option value="2">Pending</option>
                        <option value="3">Fixed</option>
                      </select>
                    </div>
                    <div class="col-md-10" id="getreportPrint">
                        <a href="excels.php" class="btn btn-primary btn-sm pull-right glyphicon glyphicon-print"> Print</a>
                    </div>
                 </div>
            </div>
            <div class="box-body" id="getreport">
      <?php        $output='
   <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" border="1" id="example">
                                  <thead>';

                       $title='
                                  <tr>
                                      <th colspan="9"><center><B>BDF Tickets Report</B></center></th>
                                   </tr>
                                   <tr>
                                      <th colspan="9"><center><B>Branch Location : '.$location_name.'</B></center></th>
                                   </tr>
                                   <tr>
                 <th colspan="9"><B>User : '.$subNames.'</B></th>
               </tr>';
                                   //Final Output is 
                                   $outputs=$output.''.$title;
                                $output.='
                                     <tr>
                  <th>#No</th>
                  <th>Ticket No#</th>
                  <th>Ticket Category</th>
                  <th>Subject</th>
                  <th>Assigned On</th>
                  <th>Assigned By</th>
                  <th>Assigned To</th>
                  <th>Resolved On</th>
                  <th>Status</th>
                </tr>
                                  </thead>
                                  <tbody>';

$count=1;
$slADM=mysqli_query($connect,"SELECT * FROM request inner join end_users on end_users.userID=request.sentBy inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category WHERE end_users.userID='$id' and request.sentCategory=0 order by requestID desc");
if(mysqli_num_rows($slADM)>0){
  while($show=mysqli_fetch_array($slADM)){
    $urlHs=(24967*$show['requestID'])+325649;
      if($show['status']!=1) {
        $slFF=mysqli_query($connect,"SELECT * FROM request inner join end_users on end_users.userID=request.sentBy inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join admin on admin.adminID=request.assignBy inner join subadmin on subadmin.subAdminID=request.assignTo WHERE end_users.userID='$id' and requestID='".$show['requestID']."' order by requestID desc");
        $gett=mysqli_fetch_array($slFF);
      } 

                        $output.='
                                        <tr>
                  <td>'.$count.'</td>
                  <td>'.$show['ticket_no'].'</td>
                  <td>'.$show['ticket_category_name'].'</td>
                  <td>'.$show['request_subject'].'</td>';
                  
           if($show['status']!=1){
               $output.=' <td>'.$gett['assignOn'].'</td>';
               $output.='    <td>'.$gett['admin_fname'].' '.$gett['admin_lname'].'</td>';
               $output.='    <td>'.$gett['subAdmin_fname'].' '.$gett['subAdmin_lname'].'</td>';
               if($show['status']==2) { $output.=' <td>-</td>'; } else if($show['status']==3) { $output.=' <td>'.$gett['feedBackOn'].'</td>'; }
            }
              else {
              $output.=' 
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                ';
              }

              $output.='<td>';
                  if($show['status']==1) $output.=' <strong class="text-danger">Open</strong>';   if($show['status']==2) $output.= '<strong class="text-warning">Pending...</strong>'; else if($show['status']==3) $output.= '<strong class="text-success">Fixed<strong/>';
                  
             $output.='</td>   </tr>';

         $count++;  }
         
           $output.=' </tbody>';
          $gett=getdate(); $jour= $gett['mday']; $mois=$gett['mon']; $an=$gett['year'];
          $foot='<table><tfooter>
                <tr>
                 <th colspan="9" style="text-align: right">Date : '.$jour.'/'.$mois.'/'.$an.'</th>
               </tr>
               </tfooter></table>
          ';
                   $output.='             </table>';
                                //Final Outputs is   
                            ///Display the result
                                echo $output;
                            // keep the result
                                $outputs.=$output;
                                $outputs.=$foot;
                                $_SESSION['output']=$outputs;


              }
            ?>
          

            </div>
            </div>
            <!-- /.box-body -->
          </div>

          <!-- /.box -->


    </section>
    <!-- /.content -->
  </div>

<?php //include('footer.php');?>  <!-- /.control-sidebar -->
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
          <div class="modal-header"><p class="modal-title" id="exampleModalLabel">BDF Tickets <span class="text-muted"> | Resolve Ticket</span></p></div>
          <div class="modal-body">
           <div class="" style="padding-right: 10px;padding-left: 10px;">
              <form method="post" action="" class="form-group" style="shape-margin: 20px;">
              <center><label>Do you want To delete This Admin?</label><br>
              <input type="test" hidden="" value="<?php echo $show['adminID'];?>" name="adminID">
              <button class="btn btn-secondary btn-default" type="button" data-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-sm btn-primary" name="delete" value="Delete"></center>
            </form>
           </div>
          </div>
        </div>
      </div>
    </div>
  <?php }}?>
</body>
</html>

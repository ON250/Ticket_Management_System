<?php 
include("header.php");
include('config_database.php'); 
if($_SESSION['category_id']!=1) header("location: dashboard.php");
$adminName=$_SESSION['names'];
$gett=getdate(); $jour= $gett['mday']; $mois=$gett['mon']; $an=$gett['year'];
?>
 <script type="text/javascript">
     var XMLHttpRequestObject=false;
    if(window.XMLHttpRequest){
      XMLHttpRequestObject=new XMLHttpRequest();
    }else if(window.ActiveXObject){
      XMLHttpRequestObject=new ActiveXObject("Microsoft.XMLHTTP");
    }
    //the function for the 
    function getreportB(){
      if(XMLHttpRequestObject){
        XMLHttpRequestObject.open("POST","getreportBsubAdmin.php");
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

        var reportl=document.getElementById("locationBranch").value;
        var dat1=document.getElementById("date1").value;
        var stat=document.getElementById("status").value;
        var dat2=document.getElementById("date2").value;
        var data=reportl+'|'+stat+'|'+dat1+'|'+dat2+'|';

        XMLHttpRequestObject.send("data=" + data);
      }
      return false;
    }

    function getreportS(){
      if(XMLHttpRequestObject){
        XMLHttpRequestObject.open("POST","getreportS.php");
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
        var reportl=document.getElementById("locationBranch").value;
        var dat1=document.getElementById("date1").value;
        var stat=document.getElementById("status").value;
        var dat2=document.getElementById("date2").value;
        var data=reportl+'|'+stat+'|'+dat1+'|'+dat2+'|';

        XMLHttpRequestObject.send("data=" + data);
      }
      return false;
    }

    function getreportF(){
      if(XMLHttpRequestObject){
        XMLHttpRequestObject.open("POST","getreportS.php");
        XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        XMLHttpRequestObject.onreadystatechange=function(){

        if(XMLHttpRequestObject.readyState==4 && XMLHttpRequestObject.status==200){
          var datar=XMLHttpRequestObject.responseText;
          var divsee=document.getElementById("getreport");
          divsee.innerHTML=datar;

          var datarx='<a href="excels.php" class="btn btn-primary btn-sm pull-right glyphicon glyphicon-print"> Print</a>';
          var divseex=document.getElementById("getreportPrint");

        }
        
        }
        var report=document.getElementById("departreport").value;
        var reportl=document.getElementById("locationBranch").value;
        var dat1=document.getElementById("date1").value;
        var stat=document.getElementById("status").value;
        var dat2=document.getElementById("date2").value;
        var data=report+'|'+reportl+'|'+stat+'|'+dat1+'|'+dat2+'|';

        XMLHttpRequestObject.send("data=" + data);
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
                      <select name="selectDepart" id="locationBranch" onchange="getreportB();" class="col-md-4 form-control" class="">>
                        <option value="">--Branch Location--</option>
                   <?php
$sloc=mysqli_query($connect,"SELECT * from location");
if(mysqli_num_rows($sloc)>0){
  while($showloc=mysqli_fetch_array($sloc)){
?>
                  <option value="<?php echo $showloc['locationID'];?>"><?php echo $showloc['location_name'];?></option>
<?php } } ?>
                      </select>
                      </div>
                      <div class="col-md-2">
                      <select name="status" id="status" onchange="getreportB();" class=" form-control">
                        <option value="0">Show All Status</option>
                        <option value="1">Open</option>
                        <option value="2">Pending</option>
                        <option value="3">Fixed</option>
                      </select>
                    </div>
                    <div class="col-md-2">
                      <input type="date" id="date1" name="from" class="col-md-4 form-control">
                    </div>
                    <div class="col-md-2">
                      <input type="date" id="date2" name="from" class="col-md-4 form-control">
                    </div>
                      <button type="button" onclick="getreportB();" class="btn btn-default glyphicon glyphicon-search btn-sm col-md-1" name=""> Search</button> 
                      <a href="" class="btn btn-default btn-sm glyphicon glyphicon-refresh"></a>
                    <div class="col-md-1" id="getreportPrint">
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
                                      <th colspan="9"><center><B>Tickets sent by Sub Administrators from all  Branch Locations </B></center></th>
                                   </tr>
                                   <tr>
                 <th colspan="9"><B>Administrator : '.$adminName.'</B></th>
               </tr>';
                                   //Final Output is 
                                   $outputs=$output.''.$title;
                                $output.='
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
                </tr>
                                  </thead>
                                  <tbody>';

              //select data from tables users user_type and department
$count=1;
$slADMr=mysqli_query($connect,"SELECT *,date_format(request.sentOn,'%d/%m/%Y') as sentOndate,date_format(request.assignOn,'%d/%m/%Y') as assignOndate FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category  inner join location on request.branchLocation = location.locationID inner join subadmin on subadmin.subAdminID=request.sentBy where request.sentCategory=1  order by requestID desc");


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
                        $output.='
                                  <tr>
                  <td>'.$count.'</td>
                  <td>'.$show['ticket_no'].'</td>
                  <td>'.$show['ticket_category_name'].'</td>
                  <td>'.$show['location_name'].'</td>
                  <td>'.$show['sentOndate'].'</td>';
         if($show['sentCategory']==0) {  $output.=' <td>'.$show['user_fname'].' '.$show['user_fname'].'</td>';  } else if($show['sentCategory']==1)  {  $output.='<td>'.$show['subAdmin_fname'].' '.$show['subAdmin_fname'].'</td>'; } else if($show['sentCategory']==2)  {  $output.='<td>'.$show['admin_fname'].' '.$show['admin_fname'].'</td>'; } 


                if($show['status']!=1) { $output.='  <td>'.$show['assignOndate'];$output.='</td> '; } else { $output.='<td>-</td>'; }
            if($show['status']!=1) { $output.='  <td>'; if($show['sentCategory']==1) $output.= $sname; else $output.= $show['subAdmin_fname'].' '.$show['subAdmin_lname']; $output.='</td>'; } else { $output.='<td>-</td>'; }

              $output.='    <td> '; if($show['status']==1) $output.= '<strong class="text-danger">Open</strong>';   if($show['status']==2) $output.= '<strong class="text-warning">Pending...</strong>'; else if($show['status']==3) $output.= '<strong class="text-success">Fixed<strong/>'; else if($show['status']==4) $output.= '<strong class="text-danger">Closed<strong/>'; 
                  
             $output.='   </tr>';

         $count++;  }  
         }

          $output.=' </tbody>';
          
                   $output.='             </table>';
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

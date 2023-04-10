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
        var reportloc=document.getElementById("locationBranch").value;
        var dat1=document.getElementById("date1").value;
        var stat=document.getElementById("status").value;
        var dat2=document.getElementById("date2").value;
        var data=report+'|'+stat+'|'+dat1+'|'+dat2+'|'+reportloc+'|';

        XMLHttpRequestObject.send("data=" + data);
      }
      return false;
    }

    function getreportB(){
      if(XMLHttpRequestObject){
        XMLHttpRequestObject.open("POST","getreportB.php");
        XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        XMLHttpRequestObject.onreadystatechange=function(){

        var reportloc=document.getElementById("locationBranch").value;
        if(XMLHttpRequestObject.readyState==4 && XMLHttpRequestObject.status==200){
          if(reportloc!=""){
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
        var reportl=document.getElementById("locationBranch").value;
        var dat1=document.getElementById("date1").value;
        var stat=document.getElementById("status").value;
        var dat2=document.getElementById("date2").value;
        var data=report+'|'+reportl+'|'+stat+'|'+dat1+'|'+dat2+'|';

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
                      <select name="selectDepart" id="departreport" onchange="getreport();" class="col-md-4 form-control" class="">>
                        <option value="">--Select Department--</option>
                    <?php
                      $hj=mysqli_query($connect,"SELECT * FROM department");
                      while($sho=mysqli_fetch_array($hj)){
                    ?>
                        <option value="<?php echo $sho['departID'];?>"><?php echo $sho['depart_name'];?></option>
                    <?php }
                    ?>
                      </select>
                      </div>
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
                      <div class="col-md-1">
                      <select name="status" id="status" onchange="getreportS();" class=" form-control">
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
                      <button type="button" onclick="getreportS();" class="btn btn-default glyphicon glyphicon-search btn-sm col-md-1" name=""> Search</button> 
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
                                      <th colspan="8"><center><B>BDF Tickets Report</B></center></th>
                                   </tr>
                                   <tr>
                                      <th colspan="8"><center><B>All Branch and All Departments</B></center></th>
                                      
                                   </tr>
                                   <tr>
                 <th colspan="8"><B>Administrator : '.$adminName.'</B></th>
                                   </tr>
                                   ';
                                   //Final Output is 
                                   $outputs=$output.''.$title;
                                $output.='
                                    <tr>
                                      <th>#No.<?php echo $date1;?></th>
                                      <th>Department</th>
                                      <th>Branch Location</th>
                                      <th>End-Users</th>
                                      <th>Total Tickets</th>
                                      <th>Open</th>
                                      <th>Pending</th>
                                      <th>Fixed</th>
                                    </tr>
                                  </thead>
                                  <tbody>';

              //select data from tables users user_type and department
          $counter=1;
          //Dates conditionss
    $sqliD=mysqli_query($connect,"SELECT *  FROM  end_users inner join department on department.departID=end_users.user_department inner join location on end_users.user_branch=location.locationID ");
    if(mysqli_num_rows($sqliD)>0){
              while($resD=mysqli_fetch_array($sqliD))
              {
                $userID=$resD['userID'];
               $sqli=mysqli_query($connect,"SELECT *,COUNT(*) AS totTicket  FROM request inner join end_users on request.sentBy=end_users.userID where sentBy='$userID' ");
               
                if(mysqli_num_rows($sqli)>0){
                  $res=mysqli_fetch_array($sqli);
               
                       if($res['totTicket']!=0){
                         $sqli1=mysqli_query($connect,"SELECT *,COUNT(*) AS totTicket1  FROM request inner join end_users on request.sentBy=end_users.userID where sentBy='$userID' and request.status=1  ");
                                          $sqli2=mysqli_query($connect,"SELECT *,COUNT(*) AS totTicket2  FROM request inner join end_users on request.sentBy=end_users.userID where sentBy='$userID' and request.status=2  ");
                                          $sqli3=mysqli_query($connect,"SELECT *,COUNT(*) AS totTicket3  FROM request inner join end_users on request.sentBy=end_users.userID where sentBy='$userID' and request.status=3  ");
                                          $sqli4=mysqli_query($connect,"SELECT *,COUNT(*) AS totTicket4  FROM request inner join end_users on request.sentBy=end_users.userID where sentBy='$userID' and request.status=4  ");

                          
                  $res1=mysqli_fetch_array($sqli1);
                  $res2=mysqli_fetch_array($sqli2);
                  $res3=mysqli_fetch_array($sqli3);
                  $res4=mysqli_fetch_array($sqli4);

                        $output.='
                                    <tr class="gradeU">
                                      <td>'.$counter.'</td>
                                      <td>'.$resD['depart_name'].'</td>
                                      <td>'.$resD['location_name'].'</td>
                                      <td>'.$resD['user_fname'].' '.$resD['user_lname'].'</td>
                                      <td>'.$res['totTicket'].'</td>
                                      <td>'.$res1['totTicket1'].'</td>
                                      <td>'.$res2['totTicket2'].'</td>
                                      <td>'.$res3['totTicket3'].'</td>
                                     
                                    </tr>';

         $counter++;  }
         }
        } 
          $output.=' </tbody>
                                </table>';
                           $foot='<table><tfooter>
                <tr>
                 <th colspan="8" style="text-align: right">Date : '.$jour.'/'.$mois.'/'.$an.'</th>
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

<?php
session_start();
include('config_database.php');
if($_SESSION['nn']=='') header("location: index.php");
if($_SESSION['category_id']!=3) header("location: dashboard.php");
$subNames=$_SESSION['names'];
$id=$_SESSION['nn'];
$status=$_POST['data'];

$dgdl=mysqli_query($connect,"SELECT * FROM end_users inner join  location ON location.locationID=end_users.user_branch inner join department on department.departID=end_users.user_department where end_users.userID='$id'");
$gtl=mysqli_fetch_array($dgdl);
$location_name=$gtl['location_name'];
$department=$gtl['depart_name'];
//Achats
if($status==0)
{
	   $output='
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
            
          

}
//When the Status is selected 
else 
{
         $output='
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
$slADM=mysqli_query($connect,"SELECT * FROM request inner join end_users on end_users.userID=request.sentBy inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category WHERE end_users.userID='$id' and request.sentCategory=0 and request.status='$status' order by requestID desc");
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
}
                               ?>
                                 


<?php
session_start();
include('config_database.php');
if($_SESSION['nn']=='') header("location: index.php");
if($_SESSION['category_id']!=2) header("location: dashboard.php");
$id=$subID=$_SESSION['nn'];
$status=$_POST['data'];
$subNames=$_SESSION['names'];
$dgdl=mysqli_query($connect,"SELECT * FROM subadmin inner join  location ON location.locationID=subadmin.location where subadmin.subAdminID='$subID'");
$gtl=mysqli_fetch_array($dgdl);
$location_name=$gtl['location_name'];
$gett=getdate(); $jour= $gett['mday']; $mois=$gett['mon']; $an=$gett['year'];
//Achats
if($status==0)
{
    $output='
   <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" border="1" id="example">
                                  <thead>';

                       $title='
                                  <tr>
                                      <th colspan="10"><center><B>BDF Tickets Report</B></center></th>
                                   </tr>
                                   <tr>
                                      <th colspan="10"><center><B>All Branch and All Departments</B></center></th>
                                   </tr>
                                   <tr>
                 <th colspan="10"><B>Sub Administrator : '.$subNames.'</B></th>
               </tr>';
                                   //Final Output is 
                                   $outputs=$output.''.$title;
                                $output.='
                                    <tr>
                  <th>#No</th>
                  <th>Ticket No#</th>
                  <th>Ticket Category</th>
                  <th>Subject</th>
                  <th>Sent On</th>
                  <th>Sent By</th>
                  <th>Assigned On</th>
                  <th>Assigned By</th>
                  <th>Resolved On</th>
                  <th>Status</th>
                </tr>
                                  </thead>
                                  <tbody>';

              //select data from tables users user_type and department
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

                        $output.='
                                   <tr>
                  <td>'.$count.'</td>
                  <td>'.$show['ticket_no'].' </td>
                  <td>'.$show['ticket_category_name'].'</td>
                  <td>'.$show['request_subject'].'</td>
                  <td>'.$show['sentOn'].'</td>';

                  $output.=' <td>'; if($show['sentCategory']==1) $output.= $snames; else if($show['sentCategory']==0) $output.= $show['user_fname'].' '.$show['user_fname']; else if($show['sentCategory']==2) $output.= $sname; $output.='</td>'; 
                 $output.='
                  <td>'; if($show['status']==1) $output.= '-'; else if($show['status']!=1) $output.= $show['assignOn'];$output.='</td>
                  <td>'; if($show['status']==1) $output.= '-'; else if($show['status']!=1) { $output.=$asname;} $output.='</td>
                  <td>'; if($show['status']!=3) $output.= '-'; else if($show['status']==3) $output.= $show['feedBackOn'];$output.='</td>
                 <td>'; if($show['status']==1) $output.= '<strong class="text-red">Open</strong>'; if($show['status']==2) $output.= '<strong class="text-warning">Pending...</strong>'; else if($show['status']==3) $output.=  '<strong class="text-success">Fixed<strong/>';
                 $output.=' 
                    </td>
                </tr>';

         $count++;  } 
         }
          $output.=' </tbody>';
          
                   $output.='             </table>';
            $foot='<table><tfooter>
                <tr>
                 <th colspan="10" style="text-align: right">Date : '.$jour.'/'.$mois.'/'.$an.'</th>
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
                                      <th colspan="10"><center><B>BDF Tickets Report</B></center></th>
                                   </tr>
                                   <tr>
                                      <th colspan="10"><center><B>Branch Location : '.$location_name.'</B></center></th>
                                   </tr>
                                   <tr>
                 <th colspan="10"><B>Sub Administrator : '.$subNames.'</B></th>
               </tr>';
                                   //Final Output is 
                                   $outputs=$output.''.$title;
                                $output.='
                                    <tr>
                  <th>#No</th>
                  <th>Ticket No#</th>
                  <th>Ticket Category</th>
                  <th>Subject</th>
                  <th>Sent On</th>
                  <th>Sent By</th>
                  <th>Assigned On</th>
                  <th>Assigned By</th>
                  <th>Resolved On</th>
                  <th>Status</th>
                </tr>
                                  </thead>
                                  <tbody>';

              //select data from tables users user_type and department
 $count=1;

$slADMs=mysqli_query($connect,"SELECT * FROM request WHERE status='$status'  order by requestID desc");
if(mysqli_num_rows($slADMs)>0){
  while($shows=mysqli_fetch_array($slADMs)){
    $reqID=$shows['requestID'];
  if($shows['status']==1){
          $slADM=mysqli_query($connect,"SELECT * FROM request inner join subadmin on subadmin.subAdminID=request.sentBy   inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category  WHERE subadmin.subAdminID='$subID' and request.requestID='$reqID' and sentCategory=1 order by requestID desc");
  }
  else if($shows['status']!=1){
        if($shows['sentCategory']==1){
          $slADM=mysqli_query($connect,"SELECT * FROM request inner join subadmin on subadmin.subAdminID=request.assignTo   inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category  WHERE subadmin.subAdminID='$subID' and request.requestID='$reqID' and sentCategory=1 order by requestID desc");
        }
        else if($shows['sentCategory']==2){
          $slADM=mysqli_query($connect,"SELECT * FROM request inner join subadmin on subadmin.subAdminID=request.assignTo   inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category  WHERE subadmin.subAdminID='$subID' and request.requestID='$reqID' and sentCategory=2 order by requestID desc");
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

                        $output.='
                                   <tr>
                  <td>'.$count.'</td>
                  <td>'.$show['ticket_no'].' </td>
                  <td>'.$show['ticket_category_name'].'</td>
                  <td>'.$show['request_subject'].'</td>
                  <td>'.$show['sentOn'].'</td>';

                  $output.=' <td>'; if($show['sentCategory']==1) $output.= $snames; else if($show['sentCategory']==0) $output.= $show['user_fname'].' '.$show['user_lname']; else if($show['sentCategory']==2) $output.= $sname; $output.='</td>'; 
                 $output.='
                  <td>'; if($show['status']==1) $output.= '-'; else if($show['status']!=1) $output.= $show['assignOn'];$output.='</td>
                  <td>'; if($show['status']==1) $output.= '-'; else if($show['status']!=1) { $output.=$asname;} $output.='</td>
                  <td>'; if($show['status']!=3) $output.= '-'; else if($show['status']==3) $output.= $show['feedBackOn'];$output.='</td>
                  <td>'; if($show['status']==1) $output.= '<strong class="text-red">Open</strong>'; if($show['status']==2) $output.= '<strong class="text-warning">Pending...</strong>'; else if($show['status']==3) $output.=  '<strong class="text-success">Fixed<strong/>';
                 $output.=' 
                    </td>
                </tr>';

         $count++;  } 
         }
          $output.=' </tbody>';
          
                   $output.='             </table>';
            $foot='<table><tfooter>
                <tr>
                 <th colspan="10" style="text-align: right">Date : '.$jour.'/'.$mois.'/'.$an.'</th>
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
                                 


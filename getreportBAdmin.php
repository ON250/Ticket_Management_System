<?php
session_start();
include('config_database.php');
if($_SESSION['nn']=="") header("location: index.php");
if($_SESSION['category_id']!=1) header("location: dashboard.php");
$adminName=$_SESSION['names'];
$data=$_POST['data'];
list($location,$status,$date1,$date2)=explode('|', $data);
$dgdl=mysqli_query($connect,"SELECT * FROM location where locationID='$location'");
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
                                      <th colspan="9"><center><B>BDF Tickets Report</B></center></th>
                                   </tr>
                                   <tr>
                                      <th colspan="9"><center><B>Tickets sent by Administrators from '; if($location=="") $title.=' all  Branch Locations'; else $title.=' : '.$location_name; $title.='</B></center></th>
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
if($location!=""){
if($date1=="" and $date2==""){
$slADMr=mysqli_query($connect,"SELECT *,date_format(request.sentOn,'%d/%m/%Y') as sentOndate,date_format(request.assignOn,'%d/%m/%Y') as assignOndate FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category  inner join location on request.branchLocation = location.locationID inner join admin on admin.adminID=request.sentBy where request.sentCategory=2 and admin.location='$location' order by requestID desc");}
else if($date1!="" and $date2==""){
$slADMr=mysqli_query($connect,"SELECT *,date_format(request.sentOn,'%d/%m/%Y') as sentOndate,date_format(request.assignOn,'%d/%m/%Y') as assignOndate FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category  inner join location on request.branchLocation = location.locationID inner join admin on admin.adminID=request.sentBy where request.sentCategory=2 and admin.location='$location' and '$date1' <= sentOn  order by requestID desc");}
else if($date1=="" and $date2!=""){
$slADMr=mysqli_query($connect,"SELECT *,date_format(request.sentOn,'%d/%m/%Y') as sentOndate,date_format(request.assignOn,'%d/%m/%Y') as assignOndate FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category  inner join location on request.branchLocation = location.locationID inner join admin on admin.adminID=request.sentBy where request.sentCategory=2 and admin.location='$location' and  sentOn <= '$date2' order by requestID desc");}
else if($date1!="" and $date2!=""){
$slADMr=mysqli_query($connect,"SELECT *,date_format(request.sentOn,'%d/%m/%Y') as sentOndate,date_format(request.assignOn,'%d/%m/%Y') as assignOndate FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category  inner join location on request.branchLocation = location.locationID inner join admin on admin.adminID=request.sentBy where request.sentCategory=2 and admin.location='$location' and '$date1' <= sentOn and sentOn <= '$date2' order by requestID desc");}
}
else if($location==""){
if($date1=="" and $date2==""){
$slADMr=mysqli_query($connect,"SELECT *,date_format(request.sentOn,'%d/%m/%Y') as sentOndate,date_format(request.assignOn,'%d/%m/%Y') as assignOndate FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category  inner join location on request.branchLocation = location.locationID inner join admin on admin.adminID=request.sentBy where request.sentCategory=2  order by requestID desc");}
else if($date1!="" and $date2==""){
$slADMr=mysqli_query($connect,"SELECT *,date_format(request.sentOn,'%d/%m/%Y') as sentOndate,date_format(request.assignOn,'%d/%m/%Y') as assignOndate FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category  inner join location on request.branchLocation = location.locationID inner join admin on admin.adminID=request.sentBy where request.sentCategory=2  and '$date1' <= sentOn  order by requestID desc");}
else if($date1=="" and $date2!=""){
$slADMr=mysqli_query($connect,"SELECT *,date_format(request.sentOn,'%d/%m/%Y') as sentOndate,date_format(request.assignOn,'%d/%m/%Y') as assignOndate FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category  inner join location on request.branchLocation = location.locationID inner join admin on admin.adminID=request.sentBy where request.sentCategory=2  and  sentOn <= '$date2' order by requestID desc");}
else if($date1!="" and $date2!=""){
$slADMr=mysqli_query($connect,"SELECT *,date_format(request.sentOn,'%d/%m/%Y') as sentOndate,date_format(request.assignOn,'%d/%m/%Y') as assignOndate FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category  inner join location on request.branchLocation = location.locationID inner join admin on admin.adminID=request.sentBy where request.sentCategory=2 and  '$date1' <= sentOn and sentOn <= '$date2' order by requestID desc");}
}
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
         if($show['sentCategory']==0) {  $output.=' <td>'.$show['user_fname'].' '.$show['user_lname'].'</td>';  } else if($show['sentCategory']==1)  {  $output.='<td>'.$show['subAdmin_fname'].' '.$show['subAdmin_lname'].'</td>'; } else if($show['sentCategory']==2)  {  $output.='<td>'.$show['admin_lname'].' '.$show['admin_fname'].'</td>'; } 


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
                                      <th colspan="9"><center><B>Tickets sent by Administrators from '; if($location=="") $title.=' all  Branch Locations'; else $title.=' : '.$location_name; $title.='</B></center></th>
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
if($location!=""){
if($date1=="" and $date2==""){
$slADMr=mysqli_query($connect,"SELECT *,date_format(request.sentOn,'%d/%m/%Y') as sentOndate,date_format(request.assignOn,'%d/%m/%Y') as assignOndate FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category  inner join location on request.branchLocation = location.locationID inner join admin on admin.adminID=request.sentBy where admin.location='$location' and request.status='$status' and request.sentCategory=2 order by requestID desc");}
else if($date1!="" and $date2==""){
$slADMr=mysqli_query($connect,"SELECT *,date_format(request.sentOn,'%d/%m/%Y') as sentOndate,date_format(request.assignOn,'%d/%m/%Y') as assignOndate FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category  inner join location on request.branchLocation = location.locationID inner join admin on admin.adminID=request.sentBy where admin.location='$location' and request.status='$status' and request.sentCategory=2 and '$date1' <= sentOn  order by requestID desc");}
else  if($date1=="" and $date2!=""){
$slADMr=mysqli_query($connect,"SELECT *,date_format(request.sentOn,'%d/%m/%Y') as sentOndate,date_format(request.assignOn,'%d/%m/%Y') as assignOndate FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category  inner join location on request.branchLocation = location.locationID inner join admin on admin.adminID=request.sentBy where admin.location='$location' and request.status='$status' and request.sentCategory=2 and  sentOn <= '$date2' order by requestID desc");}
else  if($date1!="" and $date2!=""){
$slADMr=mysqli_query($connect,"SELECT *,date_format(request.sentOn,'%d/%m/%Y') as sentOndate,date_format(request.assignOn,'%d/%m/%Y') as assignOndate FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category  inner join location on request.branchLocation = location.locationID inner join admin on admin.adminID=request.sentBy where admin.location='$location' and request.status='$status' and request.sentCategory=2 and '$date1' <= sentOn and sentOn <= '$date2' order by requestID desc");}
}
else if($location==""){
if($date1=="" and $date2==""){
$slADMr=mysqli_query($connect,"SELECT *,date_format(request.sentOn,'%d/%m/%Y') as sentOndate,date_format(request.assignOn,'%d/%m/%Y') as assignOndate FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category  inner join location on request.branchLocation = location.locationID inner join admin on admin.adminID=request.sentBy where  request.status='$status' and request.sentCategory=2 order by requestID desc");}
else if($date1!="" and $date2==""){
$slADMr=mysqli_query($connect,"SELECT *,date_format(request.sentOn,'%d/%m/%Y') as sentOndate,date_format(request.assignOn,'%d/%m/%Y') as assignOndate FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category  inner join location on request.branchLocation = location.locationID inner join admin on admin.adminID=request.sentBy where request.status='$status' and request.sentCategory=2 and '$date1' <= sentOn  order by requestID desc");}
else  if($date1=="" and $date2!=""){
$slADMr=mysqli_query($connect,"SELECT *,date_format(request.sentOn,'%d/%m/%Y') as sentOndate,date_format(request.assignOn,'%d/%m/%Y') as assignOndate FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category  inner join location on request.branchLocation = location.locationID inner join admin on admin.adminID=request.sentBy where  request.status='$status' and request.sentCategory=2 and  sentOn <= '$date2' order by requestID desc");}
else  if($date1!="" and $date2!=""){
$slADMr=mysqli_query($connect,"SELECT *,date_format(request.sentOn,'%d/%m/%Y') as sentOndate,date_format(request.assignOn,'%d/%m/%Y') as assignOndate FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category  inner join location on request.branchLocation = location.locationID inner join admin on admin.adminID=request.sentBy where  request.status='$status' and request.sentCategory=2 and '$date1' <= sentOn and sentOn <= '$date2' order by requestID desc");}
}
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
           if($show['sentCategory']==0) {  $output.=' <td>'.$show['user_fname'].' '.$show['user_lname'].'</td>';  } else if($show['sentCategory']==1)  {  $output.='<td>'.$show['subAdmin_fname'].' '.$show['subAdmin_lname'].'</td>'; } else if($show['sentCategory']==2)  {  $output.='<td>'.$show['admin_fname'].' '.$show['admin_lname'].'</td>'; } 

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
      }
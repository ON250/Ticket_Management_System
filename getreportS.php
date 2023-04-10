<?php
session_start();
include('config_database.php');
if($_SESSION['nn']=="") header("location: index.php");
if($_SESSION['category_id']!=1) header("location: dashboard.php");
$adminName=$_SESSION['names'];
$data=$_POST['data'];
list($depart,$location,$status,$date1,$date2)=explode('|', $data);
if($depart!=""){
$dgd=mysqli_query($connect,"SELECT * FROM department where departID='$depart'");
$gt=mysqli_fetch_array($dgd);
$department=$gt['depart_name']; }
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
                                      <th colspan="7"><center><B>BDF Tickets Report</B></center></th>
                                   </tr>';
                                if($depart!="" and $location!=""){
                                      $title.=' <tr>
                                      <th colspan="7"><center><B>'; if($location!=""){ $title.='Branch Location : '.$location_name;} if($depart!=""){$title.='and Department of '.$department; } $title.='</B></center></th>
                                   </tr>';
                                  }
                                  $title.='
                                     <tr>
                                        <th colspan="7"><B>Administrator : '.$adminName.'</B></th>
                                                          </tr>';
                              
                                   //Final Output is 
                                   $outputs=$output.''.$title;
                                $output.='
                                    <tr>
                                      <th>#No.<?php echo $date1;?></th>
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
    if($depart!="" and $location!="") $sqliD=mysqli_query($connect,"SELECT *  FROM  end_users where user_department='$depart' and user_branch='$location' ");
    else if($depart!="" and $location=="") $sqliD=mysqli_query($connect,"SELECT *  FROM  end_users where user_department='$depart'");
    else if($depart=="" and $location!="") $sqliD=mysqli_query($connect,"SELECT *  FROM  end_users where user_branch='$location' ");
    else if($depart=="" and $location=="") $sqliD=mysqli_query($connect,"SELECT *  FROM  end_users ");
    if(mysqli_num_rows($sqliD)>0){
              while($resD=mysqli_fetch_array($sqliD))
              {
                $userID=$resD['userID'];
              if($date1=="" and $date2==""){ $sqli=mysqli_query($connect,"SELECT *,COUNT(*) AS totTicket  FROM request inner join end_users on request.sentBy=end_users.userID where sentBy='$userID' ");}
              else if($date1!="" and $date2==""){ $sqli=mysqli_query($connect,"SELECT *,COUNT(*) AS totTicket  FROM request inner join end_users on request.sentBy=end_users.userID where sentBy='$userID' and '$date1' <= sentOn ");}
              else if($date1=="" and $date2!=""){ $sqli=mysqli_query($connect,"SELECT *,COUNT(*) AS totTicket  FROM request inner join end_users on request.sentBy=end_users.userID where sentBy='$userID' and  sentOn <= '$date2' ");}
              else if($date1!="" and $date2!=""){ $sqli=mysqli_query($connect,"SELECT *,COUNT(*) AS totTicket  FROM request inner join end_users on request.sentBy=end_users.userID where sentBy='$userID' and '$date1' <= sentOn and sentOn <= '$date2' ");}
               
                if(mysqli_num_rows($sqli)>0){
                  $res=mysqli_fetch_array($sqli);
               
              	       if($res['totTicket']!=0){
                         if($date1=="" and $date2=="") {$sqli1=mysqli_query($connect,"SELECT *,COUNT(*) AS totTicket1  FROM request inner join end_users on request.sentBy=end_users.userID where sentBy='$userID' and request.status=1  ");
                                          $sqli2=mysqli_query($connect,"SELECT *,COUNT(*) AS totTicket2  FROM request inner join end_users on request.sentBy=end_users.userID where sentBy='$userID' and request.status=2  ");
                                          $sqli3=mysqli_query($connect,"SELECT *,COUNT(*) AS totTicket3  FROM request inner join end_users on request.sentBy=end_users.userID where sentBy='$userID' and request.status=3  ");
                                          $sqli4=mysqli_query($connect,"SELECT *,COUNT(*) AS totTicket4  FROM request inner join end_users on request.sentBy=end_users.userID where sentBy='$userID' and request.status=4  ");}

                          else if($date1!="" and $date2=="") {$sqli1=mysqli_query($connect,"SELECT *,COUNT(*) AS totTicket1  FROM request inner join end_users on request.sentBy=end_users.userID where sentBy='$userID' and request.status=1 and '$date1' <= sentOn ");
                                          $sqli2=mysqli_query($connect,"SELECT *,COUNT(*) AS totTicket2  FROM request inner join end_users on request.sentBy=end_users.userID where sentBy='$userID' and request.status=2 and '$date1' <= sentOn ");
                                          $sqli3=mysqli_query($connect,"SELECT *,COUNT(*) AS totTicket3  FROM request inner join end_users on request.sentBy=end_users.userID where sentBy='$userID' and request.status=3 and '$date1' <= sentOn ");
                                          $sqli4=mysqli_query($connect,"SELECT *,COUNT(*) AS totTicket4  FROM request inner join end_users on request.sentBy=end_users.userID where sentBy='$userID' and request.status=4  and '$date1' <= sentOn");}

                        else if($date1=="" and $date2!="") {$sqli1=mysqli_query($connect,"SELECT *,COUNT(*) AS totTicket1  FROM request inner join end_users on request.sentBy=end_users.userID where sentBy='$userID' and request.status=1 and sentOn <= '$date2'  ");
                                          $sqli2=mysqli_query($connect,"SELECT *,COUNT(*) AS totTicket2  FROM request inner join end_users on request.sentBy=end_users.userID where sentBy='$userID' and request.status=2 and sentOn <= '$date2'  ");
                                          $sqli3=mysqli_query($connect,"SELECT *,COUNT(*) AS totTicket3  FROM request inner join end_users on request.sentBy=end_users.userID where sentBy='$userID' and request.status=3 and sentOn <= '$date2' ");
                                          $sqli4=mysqli_query($connect,"SELECT *,COUNT(*) AS totTicket4  FROM request inner join end_users on request.sentBy=end_users.userID where sentBy='$userID' and request.status=4  and sentOn <= '$date2' ");}

                        else if($date1!="" and $date2!="") {$sqli1=mysqli_query($connect,"SELECT *,COUNT(*) AS totTicket1  FROM request inner join end_users on request.sentBy=end_users.userID where sentBy='$userID' and request.status=1 and '$date1' <= sentOn and sentOn <= '$date2'  ");
                                          $sqli2=mysqli_query($connect,"SELECT *,COUNT(*) AS totTicket2  FROM request inner join end_users on request.sentBy=end_users.userID where sentBy='$userID' and request.status=2 and '$date1' <= sentOn and sentOn <= '$date2'  ");
                                          $sqli3=mysqli_query($connect,"SELECT *,COUNT(*) AS totTicket3  FROM request inner join end_users on request.sentBy=end_users.userID where sentBy='$userID' and request.status=3 and '$date1' <= sentOn and sentOn <= '$date2' ");
                                          $sqli4=mysqli_query($connect,"SELECT *,COUNT(*) AS totTicket4  FROM request inner join end_users on request.sentBy=end_users.userID where sentBy='$userID' and request.status=4  and '$date1' <= sentOn and sentOn <= '$date2' ");}
                  $res1=mysqli_fetch_array($sqli1);
                  $res2=mysqli_fetch_array($sqli2);
                  $res3=mysqli_fetch_array($sqli3);
                  $res4=mysqli_fetch_array($sqli4);

                        $output.='
                                    <tr class="gradeU">
                                      <td>'.$counter.'</td>
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
                                 if($status==1){
                                                          $foot='<table><tfooter>
                                            <tr>
                                             <th colspan="7" style="text-align: right">Date : '.$jour.'/'.$mois.'/'.$an.'</th>
                                           </tr>
                                           </tfooter></table>
                                      ';}
                            else if($status==2) {
                                 $foot='<table><tfooter>
                                            <tr>
                                             <th colspan="10" style="text-align: right">Date : '.$jour.'/'.$mois.'/'.$an.'</th>
                                           </tr>
                                           </tfooter></table>
                                      ';}
                             else if($status==3) {
                                 $foot='<table><tfooter>
                                            <tr>
                                             <th colspan="11" style="text-align: right">Date : '.$jour.'/'.$mois.'/'.$an.'</th>
                                           </tr>
                                           </tfooter></table>
                                      ';}
                              else if($status==0) {
                                 $foot='<table><tfooter>
                                            <tr>
                                             <th colspan="7" style="text-align: right">Date : '.$jour.'/'.$mois.'/'.$an.'</th>
                                           </tr>
                                           </tfooter></table>
                                      ';}
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

                              if($status==1){
                                 $title='
                                  <tr>
                                      <th colspan="7"><center><B>BDF Tickets Report</B></center></th>
                                   </tr>';
                                    if($depart!="" or $location!=""){
                                      $title.=' <tr>
                                      <th colspan="7"><center><B>'; if($location!=""){ $title.='Branch Location : '.$location_name;} if($depart!=""){$title.='and Department of '.$department; } $title.='</B></center></th>
                                   </tr>';
                                  }
                                  else {
                                      $title.=' <tr>
                                      <th colspan="7"><center><B>All Branch Locations and All Departments</B></center></th>
                                   </tr>';
                                  }
                                  $title.='
                                     <tr>
                                        <th colspan="7"><B>Administrator : '.$adminName.'</B></th>
                                                          </tr>';
                              }
                             else  if($status==2){
                                 $title='
                                  <tr>
                                      <th colspan="10"><center><B>BDF Tickets Report</B></center></th>
                                   </tr>';
                                    if($depart!="" or $location!=""){
                                      $title.=' <tr>
                                      <th colspan="7"><center><B>'; if($location!=""){ $title.='Branch Location : '.$location_name;} if($depart!=""){$title.='and Department of '.$department; } $title.='</B></center></th>
                                   </tr>';
                                  }
                                  else {
                                      $title.=' <tr>
                                      <th colspan="10"><center><B>All Branch Locations and All Departments</B></center></th>
                                   </tr>';
                                  }
                                  $title.='
                                     <tr>
                                        <th colspan="10"><B>Administrator : '.$adminName.'</B></th>
                                                          </tr>';
                              }
                              else if($status==3){
                                 $title='
                                  <tr>
                                      <th colspan="11"><center><B>BDF Tickets Report</B></center></th>
                                   </tr>';
                                    if($depart!="" or $location!=""){
                                      $title.=' <tr>
                                      <th colspan="11"><center><B>'; if($location!=""){ $title.='Branch Location : '.$location_name;} if($depart!=""){$title.='and Department of '.$department; } $title.='</B></center></th>
                                   </tr>';
                                  }
                                  else {
                                      $title.=' <tr>
                                      <th colspan="11"><center><B>All Branch Locations and All Departments</B></center></th>
                                   </tr>';
                                  }
                                  $title.='
                                     <tr>
                                        <th colspan="11"><B>Administrator : '.$adminName.'</B></th>
                                                          </tr>';
                              }
                                   //Final Output is 
                                   $outputs=$output.''.$title;
                                $output.='
                                    <tr>
                  <th>#No</th>
                  <th>Ticket No#</th>
                  <th>Ticket Category</th>
                  <th>Ticket Subject</th>
                  <th>Sent On</th>
                  <th>Sent By</th>';
              if($status!=1){
                $output.='<th>Assigned On</th>
                  <th>Assigned By</th>
                  <th>Assigned To</th>';
              }
              if($status==3){
                $output.='<th>FeedBack On</th>';
              }

               $output.='  <th>Status</th>
                </tr>
                                  </thead>
                                  <tbody>';

              //select data from tables users user_type and department
          $counter=1;
        if($depart!="" and $location!=""){
          if($status==1){
              if($date1=="" and $date2==""){ $sqli=mysqli_query($connect,"SELECT * FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID  where request.status='$status' and end_users.user_department='$depart' and end_users.user_branch='$location' order by requestID desc ");}
              else if($date1!="" and $date2==""){ $sqli=mysqli_query($connect,"SELECT * FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID  where request.status='$status' and end_users.user_department='$depart' and end_users.user_branch='$location' and '$date1' <= sentOn order by requestID desc");}
              else if($date1=="" and $date2!=""){ $sqli=mysqli_query($connect,"SELECT * FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID  where request.status='$status' and end_users.user_department='$depart' and end_users.user_branch='$location' and  sentOn <= '$date2' order by requestID desc ");}
              else if($date1!="" and $date2!=""){ $sqli=mysqli_query($connect,"SELECT * FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID  where request.status='$status' and end_users.user_department='$depart' and end_users.user_branch='$location' and '$date1' <= sentOn and sentOn <= '$date2' order by requestID desc ");}
          }
          else{
              if($date1=="" and $date2==""){ $sqli=mysqli_query($connect,"SELECT * FROM request inner join subadmin on subadmin.subAdminID=request.assignTo inner join admin on request.assignBy=admin.adminID inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID  where request.status='$status' and end_users.user_department='$depart' and end_users.user_branch='$location' order by requestID desc ");}
              else if($date1!="" and $date2==""){ $sqli=mysqli_query($connect,"SELECT * FROM request inner join subadmin on subadmin.subAdminID=request.assignTo inner join admin on request.assignBy=admin.adminID inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID  where request.status='$status' and end_users.user_department='$depart' and end_users.user_branch='$location' and '$date1' <= sentOn order by requestID desc");}
              else if($date1=="" and $date2!=""){ $sqli=mysqli_query($connect,"SELECT * FROM request inner join subadmin on subadmin.subAdminID=request.assignTo inner join admin on request.assignBy=admin.adminID inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID  where request.status='$status' and end_users.user_department='$depart' and end_users.user_branch='$location' and  sentOn <= '$date2' order by requestID desc ");}
              else if($date1!="" and $date2!=""){ $sqli=mysqli_query($connect,"SELECT * FROM request inner join subadmin on subadmin.subAdminID=request.assignTo inner join admin on request.assignBy=admin.adminID inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID  where request.status='$status' and end_users.user_department='$depart' and end_users.user_branch='$location' and '$date1' <= sentOn and sentOn <= '$date2' order by requestID desc");}
          }    
        } 
        else  if($depart!="" and $location==""){
          if($status==1){
              if($date1=="" and $date2==""){ $sqli=mysqli_query($connect,"SELECT * FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID  where request.status='$status' and end_users.user_department='$depart'  order by requestID desc ");}
              else if($date1!="" and $date2==""){ $sqli=mysqli_query($connect,"SELECT * FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID  where request.status='$status' and end_users.user_department='$depart'  and '$date1' <= sentOn order by requestID desc");}
              else if($date1=="" and $date2!=""){ $sqli=mysqli_query($connect,"SELECT * FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID  where request.status='$status' and end_users.user_department='$depart'  and  sentOn <= '$date2' order by requestID desc ");}
              else if($date1!="" and $date2!=""){ $sqli=mysqli_query($connect,"SELECT * FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID  where request.status='$status' and end_users.user_department='$depart'  and '$date1' <= sentOn and sentOn <= '$date2' order by requestID desc ");}
          }
          else{
              if($date1=="" and $date2==""){ $sqli=mysqli_query($connect,"SELECT * FROM request inner join subadmin on subadmin.subAdminID=request.assignTo inner join admin on request.assignBy=admin.adminID inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID  where request.status='$status' and end_users.user_department='$depart'  order by requestID desc ");}
              else if($date1!="" and $date2==""){ $sqli=mysqli_query($connect,"SELECT * FROM request inner join subadmin on subadmin.subAdminID=request.assignTo inner join admin on request.assignBy=admin.adminID inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID  where request.status='$status' and end_users.user_department='$depart'  and '$date1' <= sentOn order by requestID desc");}
              else if($date1=="" and $date2!=""){ $sqli=mysqli_query($connect,"SELECT * FROM request inner join subadmin on subadmin.subAdminID=request.assignTo inner join admin on request.assignBy=admin.adminID inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID  where request.status='$status' and end_users.user_department='$depart'  and  sentOn <= '$date2' order by requestID desc ");}
              else if($date1!="" and $date2!=""){ $sqli=mysqli_query($connect,"SELECT * FROM request inner join subadmin on subadmin.subAdminID=request.assignTo inner join admin on request.assignBy=admin.adminID inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID  where request.status='$status' and end_users.user_department='$depart'  and '$date1' <= sentOn and sentOn <= '$date2' order by requestID desc");}
          }    
        } 
        else  if($depart=="" and $location!=""){
          if($status==1){
              if($date1=="" and $date2==""){ $sqli=mysqli_query($connect,"SELECT * FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID  where request.status='$status'  and end_users.user_branch='$location' order by requestID desc ");}
              else if($date1!="" and $date2==""){ $sqli=mysqli_query($connect,"SELECT * FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID  where request.status='$status'  and end_users.user_branch='$location' and '$date1' <= sentOn order by requestID desc");}
              else if($date1=="" and $date2!=""){ $sqli=mysqli_query($connect,"SELECT * FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID  where request.status='$status'  and end_users.user_branch='$location' and  sentOn <= '$date2' order by requestID desc ");}
              else if($date1!="" and $date2!=""){ $sqli=mysqli_query($connect,"SELECT * FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID  where request.status='$status'  and end_users.user_branch='$location' and '$date1' <= sentOn and sentOn <= '$date2' order by requestID desc ");}
          }
          else{
              if($date1=="" and $date2==""){ $sqli=mysqli_query($connect,"SELECT * FROM request inner join subadmin on subadmin.subAdminID=request.assignTo inner join admin on request.assignBy=admin.adminID inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID  where request.status='$status'  and end_users.user_branch='$location' order by requestID desc ");}
              else if($date1!="" and $date2==""){ $sqli=mysqli_query($connect,"SELECT * FROM request inner join subadmin on subadmin.subAdminID=request.assignTo inner join admin on request.assignBy=admin.adminID inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID  where request.status='$status'  and end_users.user_branch='$location' and '$date1' <= sentOn order by requestID desc");}
              else if($date1=="" and $date2!=""){ $sqli=mysqli_query($connect,"SELECT * FROM request inner join subadmin on subadmin.subAdminID=request.assignTo inner join admin on request.assignBy=admin.adminID inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID  where request.status='$status'  and end_users.user_branch='$location' and  sentOn <= '$date2' order by requestID desc ");}
              else if($date1!="" and $date2!=""){ $sqli=mysqli_query($connect,"SELECT * FROM request inner join subadmin on subadmin.subAdminID=request.assignTo inner join admin on request.assignBy=admin.adminID inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID  where request.status='$status'  and end_users.user_branch='$location' and '$date1' <= sentOn and sentOn <= '$date2' order by requestID desc");}
          }    
        } 
        else  if($depart=="" and $location==""){
          if($status==1){
              if($date1=="" and $date2==""){ $sqli=mysqli_query($connect,"SELECT * FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID  where request.status='$status'  order by requestID desc ");}
              else if($date1!="" and $date2==""){ $sqli=mysqli_query($connect,"SELECT * FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID  where request.status='$status'  and '$date1' <= sentOn order by requestID desc");}
              else if($date1=="" and $date2!=""){ $sqli=mysqli_query($connect,"SELECT * FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID  where request.status='$status'  and  sentOn <= '$date2' order by requestID desc ");}
              else if($date1!="" and $date2!=""){ $sqli=mysqli_query($connect,"SELECT * FROM request inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID  where request.status='$status'  and '$date1' <= sentOn and sentOn <= '$date2' order by requestID desc ");}
          }
          else{
              if($date1=="" and $date2==""){ $sqli=mysqli_query($connect,"SELECT * FROM request inner join subadmin on subadmin.subAdminID=request.assignTo inner join admin on request.assignBy=admin.adminID inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID  where request.status='$status'  order by requestID desc ");}
              else if($date1!="" and $date2==""){ $sqli=mysqli_query($connect,"SELECT * FROM request inner join subadmin on subadmin.subAdminID=request.assignTo inner join admin on request.assignBy=admin.adminID inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID  where request.status='$status' and '$date1' <= sentOn order by requestID desc");}
              else if($date1=="" and $date2!=""){ $sqli=mysqli_query($connect,"SELECT * FROM request inner join subadmin on subadmin.subAdminID=request.assignTo inner join admin on request.assignBy=admin.adminID inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID  where request.status='$status'  and  sentOn <= '$date2' order by requestID desc ");}
              else if($date1!="" and $date2!=""){ $sqli=mysqli_query($connect,"SELECT * FROM request inner join subadmin on subadmin.subAdminID=request.assignTo inner join admin on request.assignBy=admin.adminID inner join tickect_category on tickect_category.ticket_category_id=request.ticket_category inner join end_users  on request.sentBy=end_users.userID  where request.status='$status'  and '$date1' <= sentOn and sentOn <= '$date2' order by requestID desc");}
          }    
        } 
                if(mysqli_num_rows($sqli)>0){
                  while($show=mysqli_fetch_array($sqli)){
               
                      


                        $output.='
                                    <tr>
                  <td>'. $counter.'
                  <td>'. $show['ticket_no'].' </td>
                  <td>'. $show['ticket_category_name'].'</td>
                  <td>'. $show['request_subject'].'</td>
                  <td>'.  $show['sentOn'].'</td>
                  <td>'.  $show['user_fname'].' '.$show['user_lname'].'</td>';
              if($status!=1){
                $output.='
                  <td>'.  $show['assignOn'].'</td>
                  <td>'.  $show['admin_fname'].' '.$show['admin_lname'].'</td>
                  <td>'.  $show['subAdmin_fname'].' '.$show['subAdmin_lname'].'</td>';
                  if($status==3){
                    $output.='
                  <td>'.  $show['feedBackOn'].'</td>
                  ';
                  }
              }
                  
              $output.='    <td>';
                   if($show['status']==1) $output.= '<strong class="text-primary">Open</strong>'; if($show['status']==2) $output.= '<strong class="text-warning">Pending...</strong>'; else if($show['status']==3) $output.= '<strong class="text-success">Fixed<strong/>'; $output.='</td>
                </tr>';

         $counter++; } 
          $output.=' </tbody>
                                </table>';
                               if($status==1){
                                                          $foot='<table><tfooter>
                                            <tr>
                                             <th colspan="7" style="text-align: right">Date : '.$jour.'/'.$mois.'/'.$an.'</th>
                                           </tr>
                                           </tfooter></table>
                                      ';}
                            else if($status==2) {
                                 $foot='<table><tfooter>
                                            <tr>
                                             <th colspan="10" style="text-align: right">Date : '.$jour.'/'.$mois.'/'.$an.'</th>
                                           </tr>
                                           </tfooter></table>
                                      ';}
                             else if($status==3) {
                                 $foot='<table><tfooter>
                                            <tr>
                                             <th colspan="11" style="text-align: right">Date : '.$jour.'/'.$mois.'/'.$an.'</th>
                                           </tr>
                                           </tfooter></table>
                                      ';}
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
                                 


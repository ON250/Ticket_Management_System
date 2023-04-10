<?php
session_start();
include('config_database.php');
if($_SESSION['nn']=="") header("location: index.php");
if($_SESSION['category_id']!=1) header("location: dashboard.php");
$adminName=$_SESSION['names'];
$data=$_POST['data'];
list($depart,$status,$date1,$date2,$location)=explode('|', $data);

$dgd=mysqli_query($connect,"SELECT * FROM department where departID='$depart'");
$gt=mysqli_fetch_array($dgd);
$department=$gt['depart_name'];
if($location!=""){
  $dgdl=mysqli_query($connect,"SELECT * FROM location where locationID='$location'");
$gtl=mysqli_fetch_array($dgdl);
$loc_name=$gtl['location_name'];
}
$gett=getdate(); $jour= $gett['mday']; $mois=$gett['mon']; $an=$gett['year'];
//Achats
if($status==0)
{
	$output='
	 <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" border="1" id="example">
                                  <thead>';
                            if($location==""){
                               $title='
                                  <tr>
                                      <th colspan="7"><center><B>BDF Tickets Report</B></center></th>
                                   </tr>
                                   <tr>
                                      <th colspan="7"><center><B>All Branch Locations and  Department of '.$department.'</B></center></th>
                                       </tr>
                                   <tr>
                 <th colspan="7"><B>Administrator : '.$adminName.'</B></th>
                                   </tr>
                                   ';
                            }
                            else {
                                $title='
                                  <tr>
                                      <th colspan="6"><center><B>BDF Tickets Report</B></center></th>
                                   </tr>
                                   <tr>
                                      <th colspan="6"><center><B>Branch Location : '.$loc_name.' and  Department of '.$department.'</B></center></th>
                                    <tr>
                 <th colspan="6"><B>Administrator : '.$adminName.'</B></th>
                                   </tr>
                                   ';
                            }
                                   //Final Output is 
                                   $outputs=$output.''.$title;
                                $output.='
                                    <tr>
                                      <th>#No.<?php echo $date1;?></th>';
                                    if($location==""){ $output.='
                                                                          <th>Branch Location</th>';}
                                    $output.='
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
   if($location!=""){ $sqliD=mysqli_query($connect,"SELECT *  FROM  end_users inner join location on end_users.user_branch=location.locationID  where user_department='$depart' and end_users.user_branch='$location' ");}
   else { $sqliD=mysqli_query($connect,"SELECT *  FROM  end_users inner join location on end_users.user_branch=location.locationID  where user_department='$depart' ");}
    if(mysqli_num_rows($sqliD)>0){
              while($resD=mysqli_fetch_array($sqliD))
              {
                $userID=$resD['userID'];
                $branchLocation=$resD['location_name'];
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
                                      <td>'.$counter.'</td>';
                                  if($location==""){ $output.='<td>'.$resD['location_name'].'</td>'; }
                                $output.='
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
                          if($location==""){
                                                       $foot='<table><tfooter>
                                          <tr>
                                           <th colspan="7" style="text-align: right">Date : '.$jour.'/'.$mois.'/'.$an.'</th>
                                         </tr>
                                         </tfooter></table>
                                    ';}
                            else {
                                                       $foot='<table><tfooter>
                                          <tr>
                                           <th colspan="6" style="text-align: right">Date : '.$jour.'/'.$mois.'/'.$an.'</th>
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
                                 


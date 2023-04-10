<?php 
session_start();
include('config_database.php');
$readID=$_SESSION['readID'];
$id=$_SESSION['nn'];
$category=$_SESSION['category_id'];

$hhmail=mysqli_query($connect,"SELECT *, mailbox.message as messageM,request.status as stsR FROM mailbox inner join request on mailbox.requestID=request.requestID where mailbox.requestID='$readID'");
$nh=mysqli_fetch_array($hhmail);
$tno=$nh['ticket_no'];
//Insert the message
if(isset($_POST['replyM'])){
  $mes=$_POST['messages'];
  $type=3;
  $enC=($readID*24967)+325649;
  $inmail=mysqli_query($connect,"INSERT into mailBox(requestID,ticketID,sid,category,message,type,c_date) values('$readID','$tno','$id','$category','$mes','$type',NOW())");
  if($inmail) header("location:read-mail.php?rSh=".$enC."");

}
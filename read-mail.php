<?php 
include("header.php");
include('config_database.php');
if($_GET['rSh']=='') header("location: index.php");
$_SESSION['readID']=$readID=($_GET['rSh']-325649)/24967;
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
    function getMsg(){
      if(XMLHttpRequestObject){
        XMLHttpRequestObject.open("POST","getMsg.php");
        XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        XMLHttpRequestObject.onreadystatechange=function(){

        var msS=document.getElementById("msgS").value;
        if(XMLHttpRequestObject.readyState==4 && XMLHttpRequestObject.status==200){
          if(msS!=""){
          var datar=XMLHttpRequestObject.responseText;
          var divsee=document.getElementById("msgV");
          divsee.innerHTML=datar;
        }


        }
        
        }
        var ms=document.getElementById("msgS").value;
        var data=ms;

        XMLHttpRequestObject.send("data=" + data);
      }
      return false;
    }
  </script>
<?php
//select every thikg from mailbox

$hhmail=mysqli_query($connect,"SELECT *, mailbox.message as messageM,request.status as stsR FROM mailbox inner join request on mailbox.requestID=request.requestID where mailbox.requestID='$readID'");
$nh=mysqli_fetch_array($hhmail);
$tno=$nh['ticket_no'];
$mailIDD=$nh['mailID'];

$smail=mysqli_query($connect,"SELECT *, mailbox.message as messageM,request.status as stsR FROM mailbox inner join request on mailbox.requestID=request.requestID where mailbox.requestID='$readID'  order by mailbox.mailID DESC");

//Insert the message
if(isset($_POST['replyM'])){
  $mes=htmlspecialchars($_POST['messages']);
  $type=3;
  $enC=($readID*24967)+325649;
  $inmail=mysqli_query($connect,"INSERT into mailBox(requestID,ticketID,sid,category,message,type,c_date) values('$readID','$tno','$id','$category','$mes','$type',NOW())");
  if($inmail) header("location:read-mail.php?rSh=".$enC."");

}

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="msgV">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Read Mail
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Mailbox</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <!-- /.col -->
        <div class="col-md-12 ">
          <div class="box box-primary" style="height: 510px;" >
           <div style="height: 500px; overflow: auto;">
              <div class="box-header with-border">
              <h3 class="box-title text-primary"><?php echo $tno;?></h3>

              <div class="box-tools pull-right">
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
              </div>
            </div>
      <?php 
if(mysqli_num_rows($smail)){
  while($show=mysqli_fetch_array($smail)){
      $mailIDD=$show['mailID'];
      $idss=mysqli_query($connect,"SELECT * FROM mailbox where requestID='$readID' and mailID='$mailIDD'");
      $getss=mysqli_fetch_array($idss);
      $aaID=$getss['sid'];
      if($getss['category']==1)  $ids=mysqli_query($connect,"SELECT * FROM admin  where adminID='$aaID'");
      else if($getss['category']==2)  $ids=mysqli_query($connect,"SELECT * FROM  subadmin where subAdminID='$aaID'");
      else if($getss['category']==3)  $ids=mysqli_query($connect,"SELECT * FROM  end_users  where userID='$aaID'");
      $showT=mysqli_fetch_array($ids);
      ?>
            <!-- /.box-header -->
            <div class="box-body no-padding" >
              <div  style="border: 1px solid lightgray;margin-right: 0.5%;margin-left: 0.5%;margin-bottom: 1%;">
                <div class="mailbox-read-info text-info">
                <em><?php if($show['category']==1) {echo "Admin  : <a href='mailto:". $showT['admin_email']."'>" . $showT['admin_email']."</a>";} else if($show['category']==2) {echo "Sub-Admin  : <a href='mailto:". $showT['subAdmin_email']."'>" . $showT['subAdmin_email'] ."</a>"; } else if($show['category']==3) {echo "User  : <a href='mailto:". $showT['user_email']."'>" . $showT['user_email']."</a>"; }  ?> 
                  <span class="mailbox-read-time pull-right"><?php echo $show['c_date'];?></span></em>
              </div>

              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                <?php if($show['type']==1) { ?><b><?php echo $show['subject'];?></b> <?php } ?>
                <p style="text-align: justify;"><?php echo $show['messageM'];?></p>
              </div>
              <!-- /.mailbox-read-message -->
              </div>
            </div>
            <!-- /.box-body -->
    <?php
}
}
    ?>
           </div>
            <!-- /.box-footer -->
            <div class="box-footer">
              <form method="post" action="getMsg.php" style="margin-right: 1%; margin-left: 1%;">
              <div class="row">
               <textarea required="" class="col-md-12 col-xs-9 col-sm-11" id="msgS" name="messages" autofocus="">
                 
               </textarea>
                <a href="mailbox.php" class="btn btn-default">Go back To Mailbox</a> 
                <button type="submit" name="replyM" class="btn btn-default pull-right" style=""><i class="fa fa-reply"></i> Reply</button>
              </div>
            </form>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

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
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>

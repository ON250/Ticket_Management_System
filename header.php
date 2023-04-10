<?php
    session_start();
    if($_SESSION['nn']=='') header("location: index.php");
    include('config_database.php'); 
    $id=$_SESSION['nn'];
$category=$_SESSION['category_id'];
if($category==1) { $query=mysqli_query($connect,"SELECT * FROM admin where adminID='$id'");
  $view=mysqli_fetch_array($query);
  $img=$view['photoprofile'];
  $fname=$view['admin_fname'];
  $lname=$view['admin_lname'];
}
else if($category==2) { $query=mysqli_query($connect,"SELECT * FROM subadmin where subAdminID='$id'");
  $view=mysqli_fetch_array($query);
  $img=$view['photoprofile'];
  $fname=$view['subAdmin_fname'];
  $lname=$view['subAdmin_lname'];
  }
else if($category==3){ $query=mysqli_query($connect,"SELECT * FROM end_users where userID='$id'");
  $view=mysqli_fetch_array($query);
  $img=$view['photoprofile'];
  $fname=$view['user_fname'];
  $lname=$view['user_lname'];
}
?>

   <?php
//Pick numbers of tickets from database
if($category==1){
 $q1=mysqli_query($connect,"SELECT COUNT(*) AS nb_allT from request"); 
 $q2=mysqli_query($connect,"SELECT COUNT(*) AS nb_allTFx from request where status=3");
 $q3=mysqli_query($connect,"SELECT COUNT(*) AS nb_alTlPend from request where  status=2");
 $q4=mysqli_query($connect,"SELECT COUNT(*) AS nb_allTClosed from request where status=1");}
else if($category==2){
 $q1=mysqli_query($connect,"SELECT COUNT(*) AS nb_allT from request where assignTo='$id' ");
 $q2=mysqli_query($connect,"SELECT COUNT(*) AS nb_allTFx from request where status=3   and assignTo='$id'");
 $q3=mysqli_query($connect,"SELECT COUNT(*) AS nb_alTlPend from request where  status=2  and assignTo='$id'");
 $q4=mysqli_query($connect,"SELECT COUNT(*) AS nb_allTClosed from request where status=1  and assignTo='$id'");
 $q1e=mysqli_query($connect,"SELECT COUNT(*) AS nb_allTe from request where sentBy='$id' and sentCategory=1");
 $q2e=mysqli_query($connect,"SELECT COUNT(*) AS nb_allTFxe from request where status=3  and sentCategory!=1 and sentBy='$id' and sentCategory=1");
 $q3e=mysqli_query($connect,"SELECT COUNT(*) AS nb_alTlPende from request where  status=2 and sentCategory!=1 and sentBy='$id' and sentCategory=1");
 $q4e=mysqli_query($connect,"SELECT COUNT(*) AS nb_allTClosede from request where status=1 and  sentBy='$id' and sentCategory=1");}
else if($category==3) {                                          
 $q1=mysqli_query($connect,"SELECT COUNT(*) AS nb_allT from request where sentBy='$id' and sentCategory=0");
 $q2=mysqli_query($connect,"SELECT COUNT(*) AS nb_allTFx from request where status=3 and sentCategory=0 and sentBy='$id'");
 $q3=mysqli_query($connect,"SELECT COUNT(*) AS nb_alTlPend from request where   status=2 and sentCategory=0 and sentBy='$id'");
 $q4=mysqli_query($connect,"SELECT COUNT(*) AS nb_allTClosed from request where status=1 and sentCategory=0 and sentBy='$id'"); }


$f1=mysqli_fetch_array($q1);
$f2=mysqli_fetch_array($q2);
$f3=mysqli_fetch_array($q3);
$f4=mysqli_fetch_array($q4);

if($_SESSION['category_id']==2){
  $f1e=mysqli_fetch_array($q1e);
$f2e=mysqli_fetch_array($q2e);
$f3e=mysqli_fetch_array($q3e);
$f4e=mysqli_fetch_array($q4e);
}


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BDF | Tickets System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>BDF</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>BDF</b> Tickect</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
         
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">3</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 3 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <?php
                        $ta=mysqli_query($connect,"SELECT COUNT(*) AS ta from admin where type
                          !=123");
                        $sta=mysqli_fetch_array($ta);
                      ?>
                      <i class="fa fa-users text-aqua"></i> <?php echo $sta['ta'];?> Registered Administrators
                    </a>
                  </li>
                 <li>
                    <a href="#">
                      <?php
                        $ts=mysqli_query($connect,"SELECT COUNT(*) AS ts from subadmin");
                        $sts=mysqli_fetch_array($ts);
                      ?>
                      <i class="fa fa-users text-info"></i> <?php echo $sts['ts'];?> Registered Sub Administrators
                    </a>
                  </li>
                 <li>
                    <a href="#">
                      <?php
                        $tu=mysqli_query($connect,"SELECT COUNT(*) AS tu from end_users");
                        $stu=mysqli_fetch_array($tu);
                      ?>
                      <i class="fa fa-users text-dark"></i> <?php echo $stu['tu'];?> Registered Users
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
         

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img <?php echo  'src="'.$img.'"';?> class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $fname.' '.$lname;?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img <?php echo  'src="'.$img.'"';?> class="img-circle" alt="User Image">

                <p>
                  <?php echo $fname.' '.$lname.'  -  '; if($_SESSION['category_id']==1) echo 'System Administrator'; else if($_SESSION['category_id']==2) echo 'Sub Administrator'; else if($_SESSION['category_id']==3) echo 'User';?>
                  <small>Member since March. 2019</small>
                </p>
              </li>
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="settings.php" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="settings.php" ><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img <?php echo  'src="'.$img.'"';?> class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['names'];?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form 
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="">
          <a href="dashboard.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
<?php
if($_SESSION['category_id']==1){
?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Administrator</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="addAdmin.php"><i class="fa fa-plus"></i> New Administrator</a></li>
            <li><a href="admin.php"><i class="fa fa-list"></i> All Administrators</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Sub-Administrator</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="addSubAdmin.php"><i class="fa fa-plus"></i> New Sub-Administrator</a></li>
            <li><a href="subAdmin.php"><i class="fa fa-list"></i> All Sub-Administrators</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Users</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="addUser.php"><i class="fa fa-plus"></i> New User</a></li>
            <li><a href="user.php"><i class="fa fa-list"></i> All Users</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-list"></i>
            <span>Tickets Manage</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="sendTickets.php"><i class="fa fa-plus"></i> Send Ticket</a></li>
            <li><a href="assignTickets.php"><i class="fa fa-list"></i> Assign Ticket</a></li>
            <li><a href="tickets.php"><i class="fa fa-list"></i> All Tickets</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-list"></i>
            <span>Tickets Category</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="addTicketCategory.php"><i class="fa fa-plus"></i> New Tickect Category</a></li>
            <li><a href="ticketCategory.php"><i class="fa fa-list"></i> All Ticket Categories</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-list"></i>
            <span>Departments</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="addDepartment.php"><i class="fa fa-plus"></i> New Department</a></li>
            <li><a href="department.php"><i class="fa fa-list"></i> All Departments</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-list"></i>
            <span>Locations</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="addLocation.php"><i class="fa fa-plus"></i> New Location</a></li>
            <li><a href="location.php"><i class="fa fa-list"></i> All Locations</a></li>
          </ul>
        </li>
         <li>
          <a href="mailbox.php">
            <i class="fa fa-envelope"></i> <span>Mailbox</span>
            <span class="pull-right-container">
                <?php
                  if($_SESSION['category_id']==2) { ?><small class="label pull-right bg-green"><?php echo ($f2['nb_allTFx']+$f2e['nb_allTFxe']);?></small>
              <small class="label pull-right bg-yellow"><?php echo ($f3['nb_alTlPend']+$f3e['nb_alTlPende']);?></small>
              <small class="label pull-right bg-red"><?php echo ($f4['nb_allTClosed']+$f4e['nb_allTClosede']);?></small>
              <small class="label pull-right bg-aqua"><?php echo ($f1['nb_allT']+$f1e['nb_allTe']);?></small> <?php } 

              else { ?><small class="label pull-right bg-green"><?php echo ($f2['nb_allTFx']);?></small>
              <small class="label pull-right bg-yellow"><?php echo ($f3['nb_alTlPend']);?></small>
              <small class="label pull-right bg-red"><?php echo ($f4['nb_allTClosed']);?></small>
              <small class="label pull-right bg-aqua"><?php echo ($f1['nb_allT']);?></small>
            <?php }
              ?>
            </span>
          </a>
        </li>
        <li>
          <a href="calendar.php">
            <i class="fa fa-calendar"></i> <span>Calendar</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-tasks"></i>
            <span>Report</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="adminReport.php"><i class="fa fa-list"></i> Administrators</a></li>
            <li><a href="subAdminReport.php"><i class="fa fa-list"></i> Sub-Administrators</a></li>
            <li><a href="report.php"><i class="fa fa-list"></i> End-Users</a></li>
          </ul>
        </li>

        
<?php
}
else if($_SESSION['category_id']==2){
?>
     <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Tickets Manage</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="sendTickets.php"><i class="fa fa-plus"></i> Send Ticket</a></li>
            <li><a href="viewTickets.php"><i class="fa fa-list"></i> All Tickets</a></li>
          </ul>
    </li>   
     <li>
          <a href="mailbox.php">
            <i class="fa fa-envelope"></i> <span>Mailbox</span>
            <span class="pull-right-container">
                <?php
                  if($_SESSION['category_id']==2) { ?><small class="label pull-right bg-green"><?php echo ($f2['nb_allTFx']+$f2e['nb_allTFxe']);?></small>
              <small class="label pull-right bg-yellow"><?php echo ($f3['nb_alTlPend']+$f3e['nb_alTlPende']);?></small>
              <small class="label pull-right bg-red"><?php echo ($f4['nb_allTClosed']+$f4e['nb_allTClosede']);?></small>
              <small class="label pull-right bg-aqua"><?php echo ($f1['nb_allT']+$f1e['nb_allTe']);?></small> <?php } 

              else { ?><small class="label pull-right bg-green"><?php echo ($f2['nb_allTFx']);?></small>
              <small class="label pull-right bg-yellow"><?php echo ($f3['nb_alTlPend']);?></small>
              <small class="label pull-right bg-red"><?php echo ($f4['nb_allTClosed']);?></small>
              <small class="label pull-right bg-aqua"><?php echo ($f1['nb_allT']);?></small>
            <?php }
              ?>
            </span>
          </a>
        </li>
        <li>
          <a href="calendar.php">
            <i class="fa fa-calendar"></i> <span>Calendar</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li>
          <a href="reportsubAdmin.php">
            <i class="fa fa-th"></i> <span>Report</span>
          </a>
        </li>
<?php
}
else if($_SESSION['category_id']==3){
?>
     <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Tickets Manage</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="sendTickets.php"><i class="fa fa-plus"></i> Send Ticket</a></li>
            <li><a href="ticket.php"><i class="fa fa-list"></i> All Tickets</a></li>
          </ul>
    </li>   
     <li>
          <a href="mailbox.php">
            <i class="fa fa-envelope"></i> <span>Mailbox</span>
            <span class="pull-right-container">
                <?php
                  if($_SESSION['category_id']==2) { ?><small class="label pull-right bg-green"><?php echo ($f2['nb_allTFx']+$f2e['nb_allTFxe']);?></small>
              <small class="label pull-right bg-yellow"><?php echo ($f3['nb_alTlPend']+$f3e['nb_alTlPende']);?></small>
              <small class="label pull-right bg-red"><?php echo ($f4['nb_allTClosed']+$f4e['nb_allTClosede']);?></small>
              <small class="label pull-right bg-aqua"><?php echo ($f1['nb_allT']+$f1e['nb_allTe']);?></small> <?php } 

              else { ?><small class="label pull-right bg-green"><?php echo ($f2['nb_allTFx']);?></small>
              <small class="label pull-right bg-yellow"><?php echo ($f3['nb_alTlPend']);?></small>
              <small class="label pull-right bg-red"><?php echo ($f4['nb_allTClosed']);?></small>
              <small class="label pull-right bg-aqua"><?php echo ($f1['nb_allT']);?></small>
            <?php }
              ?>
            </span>
          </a>
        </li>
        <li>
          <a href="calendar.php">
            <i class="fa fa-calendar"></i> <span>Calendar</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li>
          <a href="reportUser.php">
            <i class="fa fa-th"></i> <span>Report</span>
          </a>
        </li>
<?php
}
?>
        
       
       <li>
          <a href="settings.php">
            <i class="fa fa-cogs"></i> <span>Settings</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>


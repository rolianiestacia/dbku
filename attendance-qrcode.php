<?php
#The framework is from Start Bootstrap
#(Source: https://github.com/startbootstrap/startbootstrap-sb-admin-2 retrieved in February 2022)

?>

<?php
require_once "vendor/autoload.php";

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

include('connection.php');
include('authorize.php');

$conn = mysqli_connect($dbServerName,$dbUsername,$dbPassword,$dbName);
$id = $_GET['id'];

$sql = mysqli_query($conn,"SELECT * FROM event WHERE qrcode_id = '$id' LIMIT 1");
$row=mysqli_fetch_assoc($sql);
$qrcode_id = $row['qrcode_id'];
$url = "https://1217-183-171-119-212.ngrok-free.app/dbku/view-event-details.php?id=".$qrcode_id;
$qr_image = (new QRCode)->render($url);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DAMS - Attendance</title>
    <link href="assets/img/dbku-logo.png" rel="icon">
    <link href="assets/img/dbku-logo.png" rel="apple-touch-icon">
    <link rel="stylesheet" type="text/css" href="assets/css/notice.css" />
    <link href="assets/css/simple-datatables.css" rel="stylesheet" />
    <!-- Custom fonts for this template-->
    <script src="https://kit.fontawesome.com/31301147d5.js" crossorigin="anonymous"></script>
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

     <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script src='assets/class/bootstrap/js/bootstrap.bundle.min.js' type='text/javascript'></script>

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
     <link href="assets/css/breadcrumb.css" rel="stylesheet">
    <style>
        input,select, option{
            border:1px solid #e6e6e6 !important;
        }
        input:focus,select:focus {
            outline: none !important;
            border:1px solid red;
            box-shadow: 0 0 10px #719ECE;
          }
          table{
            font-size: 15px;
          }
          .no-border{
            border: 0px solid white !important;
          }
         .close {
          float: right; 
          color: red; 
          font-size: 20px;  
          font-weight: bold;
          border-color: transparent;
        }
        .close:hover {
          color: darkgray;
        }  
    
         #thistable{
        width: 100%;
        border-spacing: 10px;

    }

    #thistable td{
        border: 1px solid;
        border-color: #d9d9d9;
        height:50px; 
        padding: 15px;
    }
    #thistable td:hover{
        background-color: #f2f2f2;
    }

    </style>

</head>

<body id="page-top">

    <div class="jquery-script-ads" style="display: none" align="center">
        <script type="text/javascript"><!--
            google_ad_client = "ca-pub-2783044520727903";
            /* jQuery_demo */
            google_ad_slot = "2780937993";
            google_ad_width = 728;
            google_ad_height = 90;
            //-->
        </script>
        <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
    </div>

    <?php
    if(isset($_SESSION['success']))
    {
        $message=$_SESSION['success'];
        unset($_SESSION['success']);
        echo "<script> window.onload = function() {display('".$message."');}; </script>";
    }
    else if(isset($_SESSION['error']))
    {
         $message=$_SESSION['error'];
         unset($_SESSION['error']);
         echo "<script> window.onload = function() {display2('".$message."');}; </script>";
    }
    ?>   
     <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <div style="background-color:rgba(52, 58, 64, 0.1);">
                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center" href="dashboard-admin.php">
                    <div class="sidebar-brand-icon">
                        <img src="assets/img/dbku-logo.png" style="width:45px">
                    </div>
                    <div class="sidebar-brand-text"><span style="text-transform: capitalize;">&nbsp;DAMS</span></div>
                </a>
            </div>

            <!-- Divider -->


            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard-admin.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Features
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-users"></i>
                    <span>Employee</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="employee-mgt.php">Employee Details</a>
                        <a class="collapse-item" href="attendance-record.php">Attendance Records</a>
                         <a class="collapse-item" href="employee-event-mgt.php">Employee Events</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="far fa-calendar-alt"></i>
                    <span>Event</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item active" href="event-mgt.php">Event Records</a>
                        <a class="collapse-item" href="caleactivendar.php">Calendar View</a>
                        <a class="collapse-item" href="attendee.php">Attendees</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="room-mgt.php">
                    <i class="fas fa-university"></i>
                    <span>Room</span>
                </a>
            </li>
            

        
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                     <div class="text-center">
                        <a class="btn btn-link" id="sidebarToggleTop"><i style="font-size: 1.4rem;line-height: 2rem;color: #b3b3b3; " class="fa fa-bars"></i></a>
                    </div>

                    <!-- Topbar Search 
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>


                       

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small" style="text-transform: capitalize;"><?php echo $_SESSION['admin']; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="assets/img/user.png">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="profile-admin.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="change-pw-admin.php">
                                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Change Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
    

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h5 class="h4 mb-0 text-gray-800">Attendance <i class="fas fa-check-square"></i></h5>
                         <span class="d-none d-sm-inline-block">
                             <div class="row page-titles mx-0">
                                <div class="col p-md-0">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a style="text-decoration: none;font-size:14px" href="event-mgt.php" target="_parent">Event Records</a></li>
                                        <li class="breadcrumb-item active"><a style="text-decoration: none;font-size:14px" href="javascript:void(0)">Attendance</a></li>
                                    </ol>
                                </div>
                            </div> 
                        </span>  

                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>
                    <div class="card shadow mb-4" >
                        <div class="card-header py-3">
                            <table style="width: 100%">
                                    <tr>
                                        <td><i class="fas fa-calendar-alt"></i>&nbsp;&nbsp;&nbsp;<b>Event ID: <?php echo $row['id'];?></b></td>
                                        

                                    </tr>
                                </table>
                        </div>
                        <div class="card-body">  
                          <!-- Modal -->
                                <div class="modal fade" id="addSubjectModal" role="dialog">
                                    <div class="modal-dialog">
                                    
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Add Employee to Event</h4>
                                              <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                              
                                            </div>
                                            <div class="modal-body">
                                              
                                            </div>
                                        </div>
                                      
                                    </div>
                                </div>

                            
                    
                        <div class="card-body">
                        <div class="row">
                        	<div class="col-md-4">
                        		<img src="<?php echo $qr_image; ?>" /> 
                        	</div>
                        	<div class="col">
                        		<?php
                        				$rname = $row['room_num'];
                        				$thisq = mysqli_query($conn,"SELECT * FROM room WHERE room_num='$rname'");
                        				$thisres = mysqli_fetch_assoc($thisq);
                        				$venue = $thisres['room_name'];
                        			?>
                        		<table id="thistable" width="100%">
                        			<tr>
                        				<th>ID:</th>
                        				<td><?php echo $row['id'];?></td>
                        			</tr>
                        			<tr>
                        				<th>Event Name: </th>
                        				<td><?php echo $row['event_name'];?></td>	
                        			</tr>
                        			<tr>
                        				<th>Venue</th>
                        				<td><?php echo $venue;?></td>
                        			</tr>
                        			<tr>
                        				<th>Time</th>            
                        				<td><?php echo $row['start_datetime'];?> ~ <?php echo $row['end_datetime'];?></td>                  				
                        			</tr>
                        		</table>
                        	</div>
                        </div>  
                            
                        </div>
                            
                        <div style="height: 50px"></div>
                    </div>


                </div>
                <!-- /.container-fluid -->

            </div>
        </div>
            <!-- End of Main Content -->
            <br><br>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; DBKU Attendance Management System - Rolianie Stacia Anak Peron</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div style="padding: 20px;border: 0px solid;">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" style="background-color:#1d809f;border-color: #1d809f;" href="dashboard-admin.php?logout='1'">Logout</a>
                </div>
            </div>
        </div>
    </div>

<!-- Bootstrap core JavaScript-->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="assets/js/sb-admin-2.min.js"></script>

<script src="assets/js/bootstrap-dt.js" crossorigin="anonymous"></script>

<!-- Page level custom scripts -->
<script src="assets/js/simple-datatables.js" crossorigin="anonymous"></script>
<script src="assets/js/datatables-simple-demo.js"></script>

</body>
</html>
<?php
#The framework is from Start Bootstrap
#(Source: https://github.com/startbootstrap/startbootstrap-sb-admin-2 retrieved in February 2022)

?>

<?php
include('authorize-employee.php');

$query=mysqli_query($conn,"SELECT * FROM event");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>DAMS - Event</title>
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
        select, option{
            border:1px solid #e6e6e6 !important;
        }
        input{
            border:1px solid #d2d2e0 !important;
        }
        input:focus,select:focus {
            outline: none !important;
            border:1px solid red;
            box-shadow: 0 0 10px #719ECE;
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
        table{
            font-size: 13px;
        }  
        th{
            background-color: #ecf8f2;
        }

    </style>

</head>

<body id="page-top">
   <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <div style="background-color:rgba(52, 58, 64, 0.1);">
                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center" href="dashboard-employee.php">
                    <div class="sidebar-brand-icon">
                        <img src="assets/img/dbku-logo.png" style="width:45px">
                    </div>
                    <div class="sidebar-brand-text"><span style="text-transform: capitalize;">&nbsp;DAMS</span></div>
                </a>
            </div>

            <!-- Divider -->


            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard-employee.php">
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
                    <span>Attendance</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="attendance-record-employee.php">Attendance Records</a>
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
                        <a class="collapse-item active" href="event-mgt-employee.php">Event Records</a>
                        <a class="collapse-item" href="calendar-employee.php">Calendar View</a>
                        <a class="collapse-item" href="attendee-employee.php">Attendees</a>
                    </div>
                </div>
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small" style="text-transform: capitalize;"><?php echo $_SESSION['name']; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="assets/img/user.png">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="profile-employee.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="change-pw-employee.php">
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
                        <h2 class="h4 mb-0 text-gray-800">Event <i class="fas fa-calendar-alt"></i></h2>
                         
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>
                    <div class="card shadow mb-4" >
                        <div class="card-header py-3">
                            <table style="width: 100%" >
                                    <tr>
                                        <td><span style="display: block;width: 30px;height: 30px;"> </span></td>
                                        <td> 
                                            <span style="float: right">
                                                <form id="myform" method="post" action="myevent-mgt-employee.php" >
                                                    <input type="hidden" name="user" value="<?php echo $_SESSION['user'];?>">
                                                    <button type="submit" id="mybtn" class="btn btn-primary" style="background-color:#1d809f;border:1px solid #1d809f;font-size: 13px;width:100px"><i class="fa-solid fa-calendar"></i> My Event</button>
                                                    
                                                </form>
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                        </div>
                       
                        <div class="card-body">  
                         
                            <div style="overflow-x: auto">
                                <table class="table table-bordered" style="border: 0px;width:99%" align="center" id="datatablesSimple" cellspacing="0">
                                    <thead>
                                        <th><center>No.</center></th>
                                        <th><center>Event ID</center></th>
                                        <th><center>Event Name</center></th>
                                        <th><center>Venue</center></th>
                                        <th><center>Quota</center></th>
                                        <th><center>Time</center></th>
                                        <th><center>Description</center></th>
                                        <th><center>Registration Closed</center></th>
                                        <th><center>Status</center></th>
                                        
                                    </thead>
                                 <tbody>
                                     <?php
                                     
                                        $count=1;
                                        if(mysqli_num_rows($query)>0)
                                        {

                                            while($row=mysqli_fetch_assoc($query))
                                            {   
                                                $eid = $row['id'];
                                                $sql = mysqli_query($conn, "SELECT * FROM employee_event WHERE event_id='$eid'");

                                                $rnum = $row['room_num'];
                                                $q = mysqli_query($conn, "SELECT * FROM room WHERE room_num='$rnum'");
                                                $r = mysqli_fetch_assoc($q);
                                                $roomname = $r['room_name'];
                                                
                                                echo '<tr>
                                                        <td align="center" style="vertical-align: middle;">'.$count.'</td>
                                                        <td align="center" style="vertical-align: middle;">'.$row['id'].'</td>
                                                        <td align="center" style="vertical-align: middle;">'.$row['event_name'].'</td>
                                                        <td align="center" style="vertical-align: middle;">'.$roomname.'</td>
                                                        <td align="center" style="vertical-align: middle;">'.$row['event_attendees_quota'].'</td>
                                                        <td style="vertical-align: middle;"><b>Start</b>: '.$row['start_datetime'].'<br><br>
                                                        <b>End</b>: '.$row['end_datetime'].'</td>
                                                        <td align="center" style="vertical-align: middle;">'.$row['description'].'</td>
                                                        <td align="center" style="vertical-align: middle;">'.$row['endreg_datetime'].'</td>
                                                        
                                                  <td align="center" style="vertical-align: middle;">'.$row['status'].'</td>
                                                
                                                     </tr>';
                                    
                                                $count++;    
                                            }
                                        }

                    
                                        
                                    ?>
 
                                 </tbody>
                              </table>

                            </div>
                             <div style="height: 150px"></div>
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
                    <a class="btn btn-primary" style="background-color:#1d809f;border-color: #1d809f;" href="dashboard-employee.php?logout='1'">Logout</a>
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
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.notice.js"></script>
<script type="text/javascript">
    function myfunc()
    {
        document.getElementById('mybtn').style.display = "none";

    }
</script>
</body>
</html>
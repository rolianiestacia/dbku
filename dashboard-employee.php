<?php
#The framework is from Start Bootstrap
#(Source: https://github.com/startbootstrap/startbootstrap-sb-admin-2 retrieved in February 2022)

include('authorize-employee.php');

$emp_id = $_SESSION['user'];
$query2=mysqli_query($conn,"SELECT * FROM employee_event WHERE emp_id='$emp_id'");
$event2=mysqli_num_rows($query2);

$query=mysqli_query($conn,"SELECT * FROM event");
$event=mysqli_num_rows($query);
$count=0;

    if(mysqli_num_rows($query)>0)
    {
        while($row=mysqli_fetch_assoc($query))
        {
             if($row['start_datetime'] !='' && $row['end_datetime'])
            {
              date_default_timezone_set("Asia/Kuching");
              $rem = strtotime($row['start_datetime']) - time();
              $rem2 = strtotime($row['end_datetime']) - time();
              $day = floor($rem / 86400);
              $day2 = floor($rem2 / 86400);
             
              $due=date("Y-m-d",strtotime($row['start_datetime']));
              $end=date("Y-m-d",strtotime($row['end_datetime']));

              $current=time();
              $curr_date=strtotime(date("Y-m-d",$current));
              $due_date=strtotime($due);
              $due_date2=strtotime($end);

              if($due_date==$curr_date || $due_date2==$curr_date)
              {
                 $count++;
              }
              
            }

    
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DAMS - Dashboard</title>
    <link href="assets/img/dbku-logo.png" rel="icon">
    <link href="assets/img/dbku-logo.png" rel="apple-touch-icon">

   <!-- Custom fonts for this template-->
    <script src="https://kit.fontawesome.com/31301147d5.js" crossorigin="anonymous"></script>
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="assets/css/simple-datatables.css" rel="stylesheet" />
    <link href="assets/css/dashboard.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <style type="text/css">
        #cardhover1:hover{
            color: transparent;
            background-color:#6A5ACD;  
        }
        #cardhover2:hover{
            color: transparent;
            background-color:#CD5C5C; 
        }
        #cardhover3:hover{
            color: transparent;
            background-color:#FFA500; 
        }
        #cardhover4:hover{
            color: transparent;
            background-color:#0000FF; 
        }
        select, option,th{
            border:1px solid #e6e6e6 !important;
        }
        input{
            border:1px solid #c2c2d6 !important;
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
            font-size: 15px;
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
            <li class="nav-item active">
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
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="far fa-calendar-alt"></i>
                    <span>Event</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="event-mgt-employee.php">Event Records</a>
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
                        <h1 class="h3 mb-0 text-gray-800">Dashboard <i class="fas fa-fw fa-tachometer-alt"></i></h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>
                    <!--
                     <div class="row page-titles mx-0">
                        <div class="col p-md-0">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a style="text-decoration: none" href="javascript:void(0)">Dashboard</a></li>
                                <li class="breadcrumb-item active"><a style="text-decoration: none" href="javascript:void(0)">Home</a></li>
                            </ol>
                        </div>
                    </div> -->

                     <!-- Content Row -->
                  <div class="row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="card gradient-1">
                         <div id="cardhover1">
                              <a href="#today" style="text-decoration: none"><div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <h3 class="card-title text-white">
                                            Today's Event</h3>
                                        <h1 class="text-white"><strong><?php echo $count;?></strong></h1>
                                    </div>
                                    <div class="col-auto">
                                        <i style="font-size: 3rem;opacity: 0.5;color: white" class="fas fa-calendar-check"></i>
                                    </div>
                                </div>
                            </div></a>
                         </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card gradient-2">
                             <div id="cardhover2">
                              <a href="#myevent" style="text-decoration: none"><div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <h3 class="card-title text-white">
                                            My Event</h3>
                                        <h1 class="text-white"><strong><?php echo $event2;?></strong></h1>
                                    </div>
                                    <div class="col-auto">
                                        <i style="font-size: 3rem;opacity: 0.5;color: white" class="fas fa-calendar-alt"></i>
                                    </div>
                                </div>
                            </div></a>
                         </div>
                     </div>
                   </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card gradient-3">
                            <div id="cardhover3">
                              <a href="#allevent" style="text-decoration: none"><div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <h3 class="card-title text-white">
                                                All Event</h3>
                                        <h1 class="text-white"><strong><strong><?php echo $event;?></strong></h1>
                                    </div>
                                    <div class="col-auto">
                                        <i style="font-size: 3rem;opacity: 0.5;color: white" class="fas fa-calendar"></i>
                                    </div>
                                </div>
                            </div></a>
                         </div>
                        </div>
                    </div>
                     
                </div>


             <!-- Content Row -->
            <div class="row">

                <!-- Calendar -->
                <!--

                Calendar codes is adapted from https://www.sourcecodester.com/tutorial/php/15122/event-crud-fullcalendar-using-php-and-jquery-tutorial retrieved in March 2022


                -->
                <div class="col-xl-8">
                    <div class="card shadow mb-4" id="myevent">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">My Event</h6>
                            
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                             <iframe onload="resizeIframe(this)" style="border: 0px;width: 100%;height: 640px;" src="dashboard-calendar-employee.php"></iframe>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card shadow mb-4" id="today">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Today's Event</h6>
                            
                        </div>
                         <!-- Card Body -->
                        <div class="card-body">
                            <iframe src="today-event.php" style="width: 100%;border: 0px;height:640px"></iframe>
                        </div>
                    </div>
                </div>
            </div>

             <!-- Content Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card shadow mb-4" id="allevent">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">DBKU Events</h6>
                            
                        </div>
                        <!-- Card Body -->
                    <div class="card-body">
                   <iframe src="dashboard-dbku-events.php" style="width: 100%;border: 0px;min-height:500px" onload="resizeIframe(this)" scrolling="no"></iframe>
                     
                    </div>
                    </div>
                </div>
            </div>

             <!-- Content Row -->
            <div class="row">
                <div class="col-xl-12">
                    <!-- Illustrations -->
                    <div class="card shadow mb-4" id="attendance">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Attendance Records</h6>
                            
                        </div>
                        <div class="card-body">
                           <iframe src="dashboard-attendance records.php"  scrolling="no" onload="resizeIframe(this)" style="width: 100%;border: 0px;min-height:500px"></iframe>
                        </div>
                    </div>

                </div>
                <!--
                Class tab codes adapted from https://www.w3schools.com/bootstrap/bootstrap_tabs_pills.asp
                (Source: https://www.w3schools.com/bootstrap/tryit.asp?filename=trybs_tabs&stacked=h retrieved in March 2022)
                -->
                 
            </div>

        

        </div>
        <!-- /.container-fluid -->
    
   


    <!-- End of Main Content -->

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
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
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

    <!-- Page level plugins -->
    <script src="assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/chart-area-demo.js"></script>
    <script src="assets/js/demo/chart-pie-demo.js"></script>
    <script src="assets/js/simple-datatables.js" crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>

</body>
<script type="text/javascript">
     function resizeIframe(iframe) {
        iframe.height = iframe.contentWindow.document.body.scrollHeight + "px";
  }
</script>
</html>
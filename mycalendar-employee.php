<?php
#The framework is from Start Bootstrap
#(Source: https://github.com/startbootstrap/startbootstrap-sb-admin-2 retrieved in February 2022)

# Calendar codes is adapted from https://www.sourcecodester.com/tutorial/php/15122/event-crud-fullcalendar-using-php-and-jquery-tutorial retrieved in March 2022

?>

<?php
include('authorize-employee.php');

$schedules = $conn->query("SELECT * FROM event");
$sched_res = [];

if($schedules)
{
    foreach($schedules->fetch_all(MYSQLI_ASSOC) as $row){
        $row['sdate'] = date("F d, Y h:i A",strtotime($row['start_datetime']));
        $row['edate'] = date("F d, Y h:i A",strtotime($row['end_datetime']));
        $row['erdate'] = date("F d, Y h:i A",strtotime($row['endreg_datetime']));
        $sched_res[$row['id']] = $row;
    }

} 

$sql="SELECT * FROM room";
$result = mysqli_query($conn,$sql);
if(isset($conn)) $conn->close();

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

     <title>DAMS - Calendar</title>
    <link href="assets/img/dbku-logo.png" rel="icon">
    <link href="assets/img/dbku-logo.png" rel="apple-touch-icon">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- Custom styles for this template-->
    
    <link rel="stylesheet" type="text/css" href="assets/css/notice.css" />
    <link rel="stylesheet" href="assets/calendar/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/calendar/fullcalendar/lib/main.min.css">
    <script src="assets/calendar/js/jquery-3.6.0.min.js"></script>
    <script src="assets/calendar/js/bootstrap.min.js"></script>
    <script src="assets/calendar/fullcalendar/lib/main.min.js"></script>

    <!-- Custom fonts for this template-->
    <script src="https://kit.fontawesome.com/31301147d5.js" crossorigin="anonymous"></script>
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <script>
        var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')
    </script>
    <script src="assets/calendar/js/script.js"></script>
    <style>
        :root {
            --bs-success-rgb: 71, 222, 152 !important;
        }

        html,
        body {
            height: 100% !important;
            width: 100% !important;
             
            text-decoration: none !important;
            
        }
        a:not([href]):not([tabindex]){
            color: inherit;
            text-decoration: auto;
        }

        .btn-info.text-light:hover,
        .btn-info.text-light:focus {
            background: #000;
        }
        table, tbody, td, tfoot, th, thead, tr {
            border-color: #d2d2e0 !important;
            border-style: solid;
            border-width: 1px !important;
        }
        #thistable table,#thistable  td,#thistable tr,#thistable tbody,#thistable tfoot,#thistable thead{
            border:0px solid white !important;
        }
        #showform{
            display: none;
        }
        #thebutton{
            display:none;
        }
        #titleform{
            display: none;
        }
        #showform2{
            display: none;
        }
        #thebutton2{
            display:none;
        }
        #titleform2{
            display: none;
        }
        .no-margin{
            margin:0px !important;
        }
       .fc-day-today {background-color: #e6f5ff !important;}
       .fc button{
         background-color: #1d809f;
         font-size: 15px;
       }
       .fc button:active{
         background-color: #1d809f;
       }
       .fc{
        size: 13px;
        width: 100%;
        height:550px;
       }
       .this-btn{
        font-size:12px;
       }
        input,select, option{
            border:1px solid #e6e6e6 !important;
        }
        input:focus,select:focus {
            outline: none !important;
            border:1px solid red;
            box-shadow: 0 0 10px #719ECE;
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
                        <a class="collapse-item" href="event-mgt-employee.php">Event Records</a>
                        <a class="collapse-item active" href="calendar-employee.php">Calendar View</a>
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
                <div class="container">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Calendar <i class="fas fa-solid fa-calendar-alt"></i></h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>
                    
                    <div class="card shadow mb-4" >
                        <div class="card-header py-3">
                            <a href="mycalendar-employee.php"><button class="btn btn-primary" style="float:right"><i class="fas fa-calendar"></i>&nbsp;My Calendar</button></a>
                        </div>
                        <div class="container py-4" id="page-container">
                        <div class="row no-margin">
                            <div class="col-md-12 fc-btn">
                                <div id="calendar"></div>
                            </div>
                            <div style="height:100px"></div>
                        </div>
                    </div>
                    </div>
                    

                    <!-- Event Details Modal -->
                    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
                        <div class="modal-dialog">
                            <div class="modal-content rounded-0">
                                <div class="modal-header rounded-0">
                                    <h5 class="modal-title">Event Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body rounded-0">
                                    <div class="container-fluid">
                                        <dl>
                                            <dt class="text-muted">Event ID</dt>
                                            <dd id="id" class=""></dd>
                                            <br>
                                            <dt class="text-muted">Event Name</dt>
                                            <dd id="title" class=""></dd>
                                            <br>
                                            <dt class="text-muted">Venue</dt>
                                            <dd id="venue" class=""></dd>
                                            <br>
                                            <dt class="text-muted">Quota</dt>
                                            <dd id="quota" class=""></dd>
                                            <br>
                                            <dt class="text-muted">Start</dt>
                                            <dd id="start" class=""></dd>
                                            <br>
                                            <dt class="text-muted">End</dt>
                                            <dd id="end" class=""></dd>
                                            <br>
                                            <dt class="text-muted">Description</dt>
                                            <dd id="description" class=""></dd>
                                            <br>
                                            <dt class="text-muted">Registration Until</dt>
                                            <dd id="endreg" class=""></dd>
                                            <br>
                                            <dt class="text-muted">Status</dt>
                                            <dd id="status" class=""></dd>
                                            <br>
                                        </dl>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <!-- Event Details Modal -->

                  
                </div>
                <!-- /.container-fluid -->

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
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.notice.js"></script>
    <script>
        $('.select2').select2();
    </script>
    <script>
         $.myjQuery = function(message) {
            $.notice({text: message,type: "success"});
         };

         $.myjQuery2 = function(message) {
            $.notice({text: message,type: "error"});
         };
        
        function display(message) {
         $.myjQuery(message);
        };

        function display2(message) {
         $.myjQuery2(message);
        };

        </script>
  
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</body>
<script type="text/javascript">
     function resizeIframe(iframe) {
        iframe.height = iframe.contentWindow.document.body.scrollHeight + "px";
  }
</script>
<script>
$(document).ready(function(){
  $("#new-event").click(function(){
    $("#bttn").hide();
    document.getElementById("add-edit").innerText="Add Event";  
    $("#titleform").show();
    $("#showform").show();
    $("#thebutton").show();

  });
  $("#btn-cancel").click(function(){
     $("#bttn").show();
     $("#titleform").hide();
    $("#showform").hide();
    $("#thebutton").hide();

  });
   $("#new-reminder").click(function(){
    $("#bttn").hide();
    document.getElementById("add-edit2").innerText="Add Reminder";  
    $("#titleform2").show();
    $("#showform2").show();
    $("#thebutton2").show();

  });
  $("#btn-cancel2").click(function(){
     $("#bttn").show();
     $("#titleform2").hide();
    $("#showform2").hide();
    $("#thebutton2").hide();

  });
  
});
</script>
</html>
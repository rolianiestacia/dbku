<?php
#The framework is from Start Bootstrap
#(Source: https://github.com/startbootstrap/startbootstrap-sb-admin-2 retrieved in February 2022)
?>

<?php
include('authorize-employee.php');


$sql = "SELECT * FROM employee WHERE emp_id = '$user'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$email_address = $row['emp_email'];
$name = $row['emp_name'];

$errors = array(); 
if(isset($_POST['submit']))
{
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);

  if($email_address == $email)
  {
    $_SESSION['savedmessage']='Saved!';

  }
  else
  {
     $res=mysqli_query($conn,"UPDATE employee SET emp_email='$email' WHERE emp_id='$user'");
     $_SESSION['savedmessage']='Saved!';
     header('location: profile-employee.php');
     exit;
        
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

    <title>DAMS - Profile</title>
    <link href="assets/img/dbku-logo.png" rel="icon">
    <link href="assets/img/dbku-logo.png" rel="apple-touch-icon">

    <!-- Custom fonts for this template-->
    <script src="https://kit.fontawesome.com/31301147d5.js" crossorigin="anonymous"></script>
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/error-success.css"/>
    <link rel="stylesheet" href="assets/css/profile.css"/>


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
                       
                   <div class="limiter">
                    <div class="row justify-content-center" style="font-family: 'Lucida Console', 'Courier New', monospace;">
                      <div class="wrap-login100" style="padding: 10px;box-shadow: 5px 10px 8px 10px #888888;">
                        <div class="login100-form-title" style="background-image: url(assets/img/profile.svg);">
                          <span class="login100-form-title-1">
                           My Profile
                          </span>
                        </div>
                        <br>
                        <?php if (isset($_SESSION['savedmessage'])) : ?>
                        <div class="success">
                        <h6>
                          <?php 
                              echo $_SESSION['savedmessage']; 
                              unset($_SESSION['savedmessage']);
                          ?>
                        </h6>
                        </div>
                      <?php endif ?>
                            <?php if (isset($_SESSION['error'])) : ?>
                            <div class="error">
                            <h6>
                              <?php 
                                  echo $_SESSION['error']; 
                                  unset($_SESSION['error']);
                              ?>
                            </h6>
                            </div>
                      <?php endif ?>
                        
                            <form action="profile-employee.php" class="login100-form validate-form" method="POST">
                              <div class="wrap-input100 validate-input m-b-26">
                                <span class="label-input100">ID</span>
                                <input class="input100" type="text" name="username" value="<?php echo $_SESSION['user'];?>" readonly >
                                <span class="focus-input100"></span>
                              </div><br>
                              <div class="wrap-input100 validate-input m-b-26">
                                <span class="label-input100">E-mail</span>
                                <input class="input100" type="email" name="email" value="<?php echo $row['emp_email'];?>" required>
                                <span class="focus-input100"></span>
                              </div>
                              <div align="right" style="width: 100%">

                                  <br>
                                  <div class="row form-group mt-4 mb-0" style="float: right">
                                            
                                    <div class="col"><a href="dashboard-employee.php"><button type="button" style="background-color: #f2f2f2;border-color: grey;color: black;" class="btn btn-primary" name="cancel">Cancel</button></a></div>
                                    <div class="col"> <input type="submit" name="submit" value="Save" class="btn btn-info" style="background-color: #1d809f;width: 100px;"> </div>


                                </div>
                                
                              </div>                              
                            </form>
                          </div>
                    </div>
                </div>
                       

                    </div>
                <!-- /.container-fluid -->
            <div style="height:100px"></div>
            </div>
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

</body>

</html>
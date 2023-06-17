<?php
#The framework is from Start Bootstrap
#(Source: https://github.com/startbootstrap/startbootstrap-sb-admin-2 retrieved in February 2022)

?>

<?php
include('connection.php');

$query=mysqli_query($conn,"SELECT * FROM employee");
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
            text-align: center;
        }   
         th{
            background-color: #ecf8f2;
        }

    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" style="background-color: white;">

                <!-- Begin Page Content -->
                <div class="container-fluid">

                   
                    <?php $query=mysqli_query($conn,"SELECT * FROM event"); ?>

                    <div style="overflow-x: auto">
                    <table class="table table-bordered" style="border: 0px;width:99%" align="center" id="datatablesSimple" cellspacing="0">
                        <thead>
                            <th><center>No.</center></th>
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
                                            <td align="center" style="vertical-align: middle;">'.$row['event_name'].'</td>
                                            <td align="center" style="vertical-align: middle;">'.$roomname.'</td>
                                            <td align="center" style="vertical-align: middle;">'.$row['event_attendees_quota'].'</td>
                                            <td style="vertical-align: middle;"><b>Start</b>: '.$row['start_datetime'].'<br><br>
                                            <b>End</b>: '.$row['end_datetime'].'</td>
                                            <td align="center" style="vertical-align: middle;">'.$row['description'].'</td>
                                            <td align="center" style="vertical-align: middle;">'.$row['endreg_datetime'].'</td>
                                            
                                      <td align="center" style="vertical-align: middle;">'.$row['status'].'</td></tr>';
                                      
                            
                                     
                                    $count++;    
                                }
                            }
                        ?>

                     </tbody>
                    </table>

                </div>

            </div>
        </div>
            <!-- End of Main Content -->
            <br><br>
           
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

 


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
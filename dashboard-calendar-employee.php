
<?php 
include('connection.php');
include('authorize-employee.php');

$id = $_SESSION['user'];
$schedules = $conn->query("SELECT * FROM employee_event WHERE emp_id = '$id'");
$sched_res = [];

if($schedules)
{
    foreach($schedules->fetch_all(MYSQLI_ASSOC) as $row2){

       $eid=$row2['event_id'];
       $schedules2 = $conn->query("SELECT * FROM event WHERE id = '$eid'");

       foreach($schedules2->fetch_all(MYSQLI_ASSOC) as $row){

            $row['sdate'] = date("F d, Y h:i A",strtotime($row['start_datetime']));
            $row['edate'] = date("F d, Y h:i A",strtotime($row['end_datetime']));
            $row['erdate'] = date("F d, Y h:i A",strtotime($row['endreg_datetime']));


            $sched_res[$row['id']] = $row;

       }
    }
}
 
if(isset($conn)) $conn->close();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>DAMS - Dashboard</title>
    <link href="assets/img/dbku-logo.png" rel="icon">
    <link href="assets/img/dbku-logo.png" rel="apple-touch-icon">
    <!-- Custom fonts for this template-->
    <script src="https://kit.fontawesome.com/31301147d5.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="assets/calendar/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/calendar/fullcalendar/lib/main.min.css">

    <script src="assets/calendar/js/jquery-3.6.0.min.js"></script>
    <script src="assets/calendar/js/bootstrap.min.js"></script>
    <script src="assets/calendar/fullcalendar/lib/main.min.js"></script>
    <link href="assets/css/styles.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/31301147d5.js" crossorigin="anonymous"></script>
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
            height: 100%;
            width: 100%;
             font-size: 14px;
             text-decoration: none !important;
            font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
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
            border-color: #ededed !important;
            border-style: solid;
            border-width: 1px !important;
        }
        #thistable table,#thistable  td,#thistable tr,#thistable tbody,#thistable tfoot,#thistable thead{
            border:0px solid white !important;
        }
        .dot {
          height: 15px;
          width: 15px;
          border-radius: 50%;
          display: inline-block;
        }
        .fc button{
            background-color: #1d809f;
        }
       .fc-day-today {background-color: #e6f5ff !important;}
    </style>
</head>

<body class="bg-light">
    <div class="container py-5" id="page-container">
        <div class="row">
            <div class="col-md-12">
                <div id="calendar"></div>
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


</body>
</html>
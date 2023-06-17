<?php
#The framework is from Start Bootstrap
#(Source: https://github.com/startbootstrap/startbootstrap-sb-admin-2 retrieved in February 2022)
?>
<?php
include('connection.php');

$query=mysqli_query($conn,"SELECT * FROM event");
$event=mysqli_num_rows($query);

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

    <link href="assets/css/dashboard.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <style type="text/css">
        .blink_me {
          animation: blinker 1s linear infinite;
        }

        @keyframes blinker {
          50% {
            opacity: 0;
          }
        }
    </style>

</head>

<body id="page-top">

  <div >
    <?php
    $i=0;
    if(mysqli_num_rows($query)>0)
    {
        while($row=mysqli_fetch_assoc($query))
        {
            $countdown='';
            $remind='';
            $due='';
            if($row['start_datetime'] !='')
            {
              date_default_timezone_set("Asia/Kuching");
              $rem = strtotime($row['start_datetime']) - time();
              $day = floor($rem / 86400);
             
              $due=date("Y-m-d",strtotime($row['start_datetime']));

              $current=time();
              $curr_date=strtotime(date("Y-m-d",$current));
              $due_date=strtotime($due);

              if($due_date==$curr_date)
              {
                 $remind='color:#668cff;';
                 $countdown ='D-day';
              }
              if($countdown=="D-day")
              {
                echo ' <div class="pb-2">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <h1 class="card-title text-black">
                                '.$row['event_name'].'</h1>
                            <h6 style="color:royalblue">'.$due.'</h6>
                        </div>
                        <div class="col-auto" style="padding-right:20px">
                            <br>
                            <h1 style="'.$remind.'" class="text-black blink_me"><strong>'.$countdown.'</strong></h1>
                            <br>
                        </div>                 
                </div>';
                $i++;

              }

            }
        }
    }
    if($i==0){
        echo '<div style="height:635px"><br><em>No event for today</em></div>';
    }
?>
  </div>

</body>
</html>
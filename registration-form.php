<script type="text/javascript">
  window.addEventListener( "pageshow", function ( event ) {
  var historyTraversal = event.persisted || ( typeof window.performance != "undefined" && window.performance.navigation.type === 2 );
  if ( historyTraversal ) {
    // Handle page restore.
    //alert('refresh');
    window.location.reload();
  }
});
</script>
<?php
include('connection.php');
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'assets/phpEmail/PHPMailer/src/Exception.php';
require 'assets/phpEmail/PHPMailer/src/PHPMailer.php';
require 'assets/phpEmail/PHPMailer/src/SMTP.php';

$errors = array(); 

if(isset($_GET['id']))
{
  $id = $_GET['id'];
  $sql = "SELECT * FROM event WHERE id='$id' LIMIT 1";
  $query = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($query);

  $room_num = $row['room_num'];
  $roomquery =  mysqli_query($conn,"SELECT * FROM room WHERE room_num='$room_num' LIMIT 1");
  $room_row = mysqli_fetch_assoc($roomquery);
  $room_name = $room_row['room_name'];

   if(isset($_POST['submit']))
  {
    $name = $_POST['name'];
    $mykad = $_POST['mykad'];
    $email = $_POST['email'];
    $contactnum = $_POST['contactnum'];

    $name = strtoupper($name);

    $a = mysqli_query($conn,"SELECT * FROM event_attendees WHERE attendee_mykad='$mykad'");
    if(mysqli_num_rows($a)>0)
    {
      array_push($errors, "Duplicate registration! You have registered to this event.");

    }

    if($mykad != "")
    {
      $len=strlen($mykad);
      if($len<12 || $len>12)
      {
        array_push($errors, "The employee MyKad is invalid!");
      
      }

    }

   if(count($errors) == 0)
   {
      $sql = mysqli_query($conn,"INSERT INTO event_attendees(event_id,attendee_mykad,attendee_name,attendee_email,attendee_contactnum) VALUES ('$id','$mykad','$name','$email','$contactnum')");
      $lastid = mysqli_insert_id($conn);

      if($sql)
      {
         $_SESSION['info']='You have successfully register to DBKU event!';
          header("location: print-registration.php?id=".$lastid."");

          $thisquery = mysqli_query($conn,"SELECT * FROM event WHERE id = '$id'");
          $countrows = mysqli_num_rows($thisquery);
          $thisrow = mysqli_fetch_assoc($thisquery);
          $quota = $thisrow['event_attendees_quota'];

          if($countrows >= $quota)
          {
            $status = "Full";
            mysqli_query($conn,"UPDATE event SET status = '$status' WHERE id = '$id'");
          }

           //send message
          $sender = htmlentities("DAMS - DBKU Attendance Management System");
          $fromemail = htmlentities("rolianiestacia@gmail.com");
          $subject = htmlentities("Registration Details for DBKU Event");
          $message = "<html>
                      <head>
                      <title>Registration Details for DBKU Event</title>
                      </head>
                      <body>
                      <p>You have registered to a DBKU event, <b>".$row['event_name']."</b> that will happen on <b>".$row['start_datetime']." to ".$row['end_datetime']."</b> at <b>".$room_name."</b>. Here are the details:</p><br>
                      
                      &emsp;&emsp;<b>Name: </b>".$name."<br>
                      &emsp;&emsp;<b>MyKad: </b>".$mykad."<br>
                      &emsp;&emsp;<b>Email: </b>".$email."<br>
                      &emsp;&emsp;<b>Contact No.: </b>".$contactnum."<br><br><br>
                      <b>Thank you,<br>
                      DEWAN BANDARAYA KUCHING UTARA<br>
                      Bukit Siol, Jalan Semariang Petra Jaya<br>
                      93050 Kuching Sarawak<br>
                      HP: 082-512200/ 082-512201 <br>
                      Email: aduandbku@dbku.gov.my
                      </b>
                      </body>
                      </html>
                      ";


          $mail = new PHPMailer(true);
          $mail->isSMTP();
          $mail->Host = 'smtp.gmail.com';
          $mail->SMTPAuth = true;
          $mail->Username = 'rolianiestacia@gmail.com';
          $mail->Password = 'pcgvnrsdjxwuxzkt';
          $mail->Port = 465;
          $mail->SMTPSecure = 'ssl';
          $mail->isHTML(true);
          $mail->setFrom($fromemail, $sender);
          $mail->addAddress($email);
          $mail->Subject = ($subject);
          $mail->Body = $message;
          $mail->send();




      }
      else{
          $_SESSION['info']='Register not success!';
          header("location: print-registration.php?id=".$lastid."");    }
     }
   }
}
else{
  header("Location: index.php");
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>DAMS</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/dbku-logo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="assets/css/simple-datatables.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/31301147d5.js" crossorigin="anonymous"></script>
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">


  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style-front.css" rel="stylesheet">
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="assets/css/front1.css" rel="stylesheet">
  <link href="assets/css/error-success.css" rel="stylesheet">


  <!-- =======================================================
  * Template Name: Yummy
  * Updated: May 30 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <style>
    input,select, option{
        border:1px solid #b3b3cc !important;
    }
    input:focus,select:focus {
        outline: none !important;
        border:1px solid red;
        box-shadow: 0 0 10px #719ECE;
      }
      .no-border{
        border: 0px solid white !important;
      }
    #main{
      background-color: #f0f0f5;
    }
    #this-table table,tr,td{
      border: 1px ridge #c1d7d7 !important;
      overflow-x: auto
      cellspacing: 0;
      text-align: left;
    }
    #this-table th{
      width: 50%;
    }
    ::placeholder { /* Recent browsers */
      text-transform: none;
    }

</style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <a href="index.php" style="text-decoration: none;" class="logo d-flex align-items-center me-auto me-lg-0">
        <img src="assets/img/dbku-logo.png" alt="">
        <h5 style="color:green">&nbsp; <b>Dewan Bandaraya Kuching Utara</b></h5>
      </a>
     
    </div>
  </header><!-- End Header -->

  <div style="height:70px"></div>

  
<main id="main">
  
  
<div class="container">
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header"><h5 class="text-center font-weight-light my-4">Register Event</h5></div>
            <div class="card-body">
      <form action="registration-form.php?id=<?php echo $id;?>" method="POST" autocomplete="off">
      <?php include('errors.php'); ?>
            <br>
            <div class="form-row">
                 <div class="col-md-6">
                    <div class="form-group">
                        <label class="small mb-1" for="name">Name</label>
                        <input class="form-control py-4 text-uppercase" name="name" id="name" type="text" placeholder="Enter your name" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="small mb-1" for="mykad">MyKad No.</label>
                        <input class="form-control py-4" onkeyup="myfunction()" name="mykad" id="mykad" type="text" placeholder="Enter your MyKad No."  /><p style="color: red" id="check"></p>
                    </div>
                </div>
        
            </div>
            <br>
             <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="small mb-1" for="email">E-mail</label>
                        <input class="form-control py-4" name="email" id="email" type="email" placeholder="Enter your email address" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="small mb-1" for="contactnum">Contact Number</label>
                        <input class="form-control py-4" name="contactnum" id="contactnum" type="text" placeholder="Enter your contact number" required />
                    </div>
                </div>
            </div>

            <div class="form-group mt-4 mb-0">
              <br>
               <div class="row">
                <div class="col">
                  <a href="index.php" style="float: left;color: blue;"><i class="fa-solid fa-arrow-left"></i> Back</a>
                </div>
                <div class="col"><button type="submit" class="btn btn-primary" style="width:120px;float: right;" name="submit">Register <i class="fa-solid fa-chevron-right" style="color: #ffffff;"></i></button></div>
              </div>
            </div>
        </form>
    </div>
      </div>
  </div>
</div>
</div>

  <div style="height:100px"></div>  


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="container">
      <div class="row gy-3">
        <div class="col-lg-4 col-md-6 d-flex">
          <i class="bi bi-geo-alt icon"></i>
          <div>
            <h4>Address</h4>
            <p>
              DEWAN BANDARAYA KUCHING UTARA<br>
              Bukit Siol, Jalan Semariang Petra Jaya<br>
              93050 Kuching Sarawak<br>
            </p>
          </div>

        </div>

        <div class="col-lg-4 col-md-6 footer-links d-flex">
          <i class="bi bi-telephone icon"></i>
          <div>
            <h4>Contact Us</h4>
            <p>
              <strong>Phone:</strong> 082-512200/ 082-512201<br>
              <strong>Email:</strong> aduandbku@dbku.gov.my<br>
            </p>
          </div>
        </div>


        <div class="col-lg-2 col-md-6 footer-links">
          <h4>Follow Us</h4>
          <div class="social-links d-flex">
            <a target="_blank" href="https://www.facebook.com/BandarayaKU/?wtsid=rdr_0WYobKaJEmVgLgrMF" class="facebook"><i class="bi bi-facebook"></i></a>
            <a target="_blank" href="https://www.youtube.com/channel/UCE5kAzxYiTvagYRBKUXm9ug" class="youtube"><i class="bi bi-youtube"></i></a>
          </div>
        </div>

         <div class="col-lg-2 col-md-6 footer-links d-flex">
          <div class="hoverlink">
            
          </div>
        </div>

      </div>
    </div>

    <div class="container">
      <div class="copyright" style="color: white !important;">
        &copy; Copyright <strong><span>Yummy</span></strong>. All Rights Reserved
      </div>
      <div class="credits" style="color: white !important;">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer><!-- End Footer -->
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/bootstrap-dt.js" crossorigin="anonymous"></script>

  <script src="assets/js/simple-datatables.js" crossorigin="anonymous"></script>
  <script src="assets/js/datatables-simple-demo.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script type="text/javascript" src="assets/js/jquery.notice.js"></script>
  <script src="assets/js/login-scripts.js"></script>
  <script>
  function myfunction() {
    var x,len;
    var text='';

    // Get the value of the input field with id="numb"
    x = document.getElementById("mykad").value;

    len=x.toString().length;

    // If x is Not a Number or less than one or greater than 10
    if (isNaN(x) || len != 12) {
      text = "*MyKad Invalid!";
    } 
    document.getElementById("check").innerHTML = text;
  }

  </script>

</body>

</html>
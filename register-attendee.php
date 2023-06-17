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
$errors = array(); 

if(isset($_GET['id']))
{
  $id = $_GET['id'];
  $sql = "SELECT * FROM event WHERE id='$id' LIMIT 1";
  $query = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($query);
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


  <!-- =======================================================
  * Template Name: Yummy
  * Updated: May 30 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <style>
    input,select, option{
        border:1px solid #e6e6e6 !important;
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

  <div style="height:25px"></div>

  <main id="main">
    <!-- =======  Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <header class="section-header">
          <br><br>
          <center><h2 style="font-size: 20px;color:#3d3d5c"></h2></center>
          <br>
        </header>

        <div class="row gy-4">
          <div class="col-lg-12 col-md-6" style="min-height: 700px;" data-aos="fade-up" data-aos-delay="400">
            <div class="service-box green">
              <div class="row" style="background-color:#40bf80;min-height:50px;padding: 70px 0;">
                <div class="col"> <h3 style="color:white"><?php echo $row['event_name'];?></h3></div>
              </div>
              <br>
              <?php
              $status = $row['status'];
              if($status == "Available")
              {
                echo ' <div class="row" style="background-color:green;max-height:25px;">
                          <div class="col"> <p style="color:white">Available</p></div>
                        </div>';
              }
              else if($status == "Full"){
                echo ' <div class="row" style="background-color:red;max-height:25px;">
                          <div class="col"> <p style="color:white">Full</p></div>
                        </div>';
              } 
              else{
                echo ' <div class="row" style="background-color:red;max-height:25px;">
                          <div class="col"> <p style="color:white">Closed</p></div>
                        </div>';
              }
              ?>
              <br>
              <div id="this-table">
                <table class="table " style="width:100%;">
                  <th>Event Name</th>
                  <td><?php echo $row['event_name'];?></td>
                </tr>
                <tr>
                  <?php
                  $room_num = $row['room_num'];
                  $q = mysqli_query($conn,"SELECT * FROM room WHERE room_num = '$room_num' LIMIT 1");
                  $res = mysqli_fetch_assoc($q);
                  $venue = $res['room_name'];

                  ?>
                  <th>Venue</th>
                  <td><?php echo $venue;?></td>
                </tr>
                <tr>
                  <th>Time</th>
                  <td><?php echo $row['start_datetime'];?> ~ <?php echo $row['end_datetime'];?></td>
                </tr>
                <tr>
                  <th>Description</th>
                  <td><?php echo $row['description'];?></td>
                </tr>
                <tr>
                  <th>Quota</th>
                  <td><?php echo $row['event_attendees_quota'];?></td>
                </tr>
                <tr>
                  <th>Registration Closed</th>
                  <td><?php 
                  $t=date("d-m-Y",strtotime($row['endreg_datetime']));
                  echo $t;
                   
                ?> 11:59PM</td>
                </tr>
              </table>
              <br>
              <div class="row">
                <div class="col">
                  <a href="index.php" style="float: left;color: blue;"><i class="fa-solid fa-arrow-left"></i> Back</a>
                </div>
                <?php
                if($status == "Available")
                {?>
                   <div class="col"><a href="registration-form.php?id=<?php echo $id; ?>" style="float: right;"><button class="btn btn-primary" style="width:120px" name="register">Register <i class="fa-solid fa-chevron-right" style="color: #ffffff;"></i></button></a></div>
<?php
                }
                ?>
              </div>
              </div>

              
            </div>
          </div>
        </div>
      </div>
    </section>

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


</body>

</html>
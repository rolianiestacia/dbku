<?php
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>DAMS - Attendance</title>
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
  <link href="assets/css/error-success.css" rel="stylesheet" />


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
    <div class="col-lg-5">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header"><h5 class="text-center font-weight-light my-4">Attendance Scan</h5></div>
            <div class="card-body">
      
        
            <br>
            <div class="success" style="padding: 0.4rem 0.4rem">
                <h6>Your attendance has been recorded. Thank you.</h6>
              </div>      
          
        <div style="height:90px"></div>  
        
    </div>
      </div>
  </div>
</div>
</div>

  <div style="height:160px"></div>  


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
            <a style="color: white;" href="">User Guide</a>
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

</body>

</html>
<?php
#Adapted from: https://www.codingnepalweb.com/login-signup-form-using-php-mysql/
#Retrieved in March 2022
?>
<?php require_once "server.php"; ?>
<?php 
$email = $_SESSION['email'];
if($email == false){
  header('Location: signin-employee.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>DAMS - Forgot Password (Employee)</title>
        <link href="assets/img/dbku-logo.png" rel="icon">
        <link href="assets/img/dbku-logo.png" rel="apple-touch-icon">
        <link href="assets/css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="assets/css/login-util.css">
        <link rel="stylesheet" type="text/css" href="assets/css/login-main.css">
        <link href="assets/css/error-success.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <style type="text/css">
            *{
                font-family: Arial, Helvetica, sans-serif;
            }
            a{
                 font-family: Arial, Helvetica, sans-serif;
            }
        
        </style>
    </head>

    <body style="background-color: #E6FFEE;">
         
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header"><h3 class="text-center font-weight-light my-4">Code Verification</h3></div>
                        <div class="card-body">
                            <form action="reset-code.php" method="POST" autocomplete="off">
                               <?php 
                                if(isset($_SESSION['info'])){
                                    ?>
                                    <br>
                                    <div class="success" style="padding: 0.4rem 0.4rem">
                                        <h6><?php echo $_SESSION['info']; ?></h6>
                                    </div>
                                    <?php
                                }
                                ?>
                                <?php
                                if(count($errors) > 0){
                                    ?>
                                    <br>
                                    <div class="error"><h6>
                                        <?php
                                        foreach($errors as $showerror){
                                            echo $showerror;
                                        }
                                        ?>
                                    </div></h6>
                                    <?php
                                }
                                ?>
                              <br>                                          


                                 <div class="form-group">
                                    <input class="form-control" type="number" name="otp" placeholder="Enter code" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control button" type="submit" style="background-color: #50B8B3;color: white" name="check-reset-otp" value="Submit">
                                </div>
                                 <center><a style="text-decoration: none;color:blue" href="forgotpw-employee.php">Back</a></center>
                            
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="assets/js/login-scripts.js"></script>
    </body>
</html>
<?php
#Adapted from: https://www.codingnepalweb.com/login-signup-form-using-php-mysql/
#Retrieved in March 2022
?>
<?php require_once "server.php"; ?>
<?php 
$email = $_SESSION['email'];
if($email == false){
  header('Location: signin-admin.php');
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
        <title>DAMS - New Password (Admin)</title>
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
            /* The message box is shown when the user clicks on the password field */
            #message {
              display:none;
              background: #f1f1f1;
              color: #000;
              position: relative;
              padding: 20px;
              margin-top: 10px;
            }

            #message p {
              padding: 10px 35px;
              font-size: 18px;
            }

            /* Add a green text color and a checkmark when the requirements are right */
            .valid {
              color: green;
            }

            .valid:before {
              position: relative;
              left: -35px;
              content: "✔";
            }

            /* Add a red text color and an "x" when the requirements are wrong */
            .invalid {
              color: red;
            }

            .invalid:before {
              position: relative;
              left: -35px;
              content: "✖";
            }
        
        </style>
    </head>

    <body style="background-color: #E6FFEE;">
         
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header"><h3 class="text-center font-weight-light my-4">New Password</h3></div>
                        <div class="card-body">
                            <form action="new-password-admin.php" method="POST" autocomplete="off">
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
                                    <input class="form-control" type="password" id="psw" name="password" placeholder="Create new password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                                </div>
                                <div id="message">
                                  <div class="error">
                                      <h6>Password must contain the following:</h6>
                                      <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                                      <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                                      <p id="number" class="invalid">A <b>number</b></p>
                                      <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                                    </div>
                                </div><br>
                                <div class="form-group">
                                    <input class="form-control" type="password" name="cpassword" placeholder="Confirm your password" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control button" type="submit" name="change-password-admin" style="background-color: #50B8B3;color: white" value="Change">
                                </div>
                                 <center><a style="text-decoration: none;color:blue" href="signin-admin.php">Return to sign in</a></center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="assets/js/login-scripts.js"></script>

        <script>
        var myInput = document.getElementById("psw");
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var length = document.getElementById("length");

        // When the user clicks on the password field, show the message box
        myInput.onfocus = function() {
          document.getElementById("message").style.display = "block";
        }

        // When the user clicks outside of the password field, hide the message box
        myInput.onblur = function() {
          document.getElementById("message").style.display = "none";
        }

        // When the user starts to type something inside the password field
        myInput.onkeyup = function() {
          // Validate lowercase letters
          var lowerCaseLetters = /[a-z]/g;
          if(myInput.value.match(lowerCaseLetters)) {  
            letter.classList.remove("invalid");
            letter.classList.add("valid");
          } else {
            letter.classList.remove("valid");
            letter.classList.add("invalid");
          }
          
          // Validate capital letters
          var upperCaseLetters = /[A-Z]/g;
          if(myInput.value.match(upperCaseLetters)) {  
            capital.classList.remove("invalid");
            capital.classList.add("valid");
          } else {
            capital.classList.remove("valid");
            capital.classList.add("invalid");
          }

          // Validate numbers
          var numbers = /[0-9]/g;
          if(myInput.value.match(numbers)) {  
            number.classList.remove("invalid");
            number.classList.add("valid");
          } else {
            number.classList.remove("valid");
            number.classList.add("invalid");
          }
          
          // Validate length
          if(myInput.value.length >= 8) {
            length.classList.remove("invalid");
            length.classList.add("valid");
          } else {
            length.classList.remove("valid");
            length.classList.add("invalid");
          }
        }
        </script>
    </body>
</html>
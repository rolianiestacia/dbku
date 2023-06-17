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
$conn=mysqli_connect("localhost","root","","dbku");
session_start();
$errors = array(); 

if(isset($_POST['submit'])){

  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $confirm_pw = mysqli_real_escape_string($conn, $_POST['confirm_pw']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Please enter your username!"); }
  if (empty($email)) { array_push($errors, "Please enter your email address"); }
  if (empty($password)) { array_push($errors, "Please enter your password!"); }
  if ($password != $confirm_pw) {
    array_push($errors, "The confirm password does not match the password!");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM admin WHERE username='$username' LIMIT 1";
  $result = mysqli_query($conn, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "The username is taken! Please use another username.");
    }
  }

   // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $pw = md5($password);//encrypt the password before saving in the database
    $code=0;
    mysqli_query($conn,"INSERT INTO admin(username,email,password,code) VALUES ('$username','$email','$pw','$code')");

    $_SESSION['login']='You have successfully sign up!';
    header("location: signin-admin.php");
  }
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
        <title>DAMS - Register Admin</title>
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
              background: white;
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
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Register Admin</h3></div>
                                    <div class="card-body">
                                        <form action="signup-admin.php" method="POST" autocomplete="off">
                                       <?php include('errors.php'); ?>
								        <?php if (isset($_SESSION['success'])) : ?>
								            <div class="error success">
								            <h3>
								              <?php 
								                  echo $_SESSION['success']; 
								                  unset($_SESSION['success']);
								              ?>
								            </h3>
								            </div>
								      <?php endif ?>
								      <br>
                                            <div class="form-row">
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="id">Username</label>
                                                        <input class="form-control py-4" name="username" id="username" type="text" placeholder="Enter your username" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="email">E-mail</label>
                                                        <input class="form-control py-4" name="email" id="email" type="email" placeholder="Enter your email address" required />
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="password">Password</label>
                                                        <input class="form-control py-4" name="password" id="password" type="password" placeholder="Enter your password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="confirm_pw">Confirm Password</label>
                                                        <input class="form-control py-4" name="confirm_pw" id="confirm_pw" type="password" placeholder="Confirm your Password" required />
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="message">
                                                      <div class="error">
                                                          <h6>Password must contain the following:</h6>
                                                          <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                                                          <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                                                          <p id="number" class="invalid">A <b>number</b></p>
                                                          <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                                                        </div>
                                                    </div>

                                            <div class="form-group mt-4 mb-0">
                                              <button type="submit" style="float:right; width: 30%;" class="btn btn-info" style="background-color: #50B8B3 !important" name="submit">Sign Up</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a style="color: blue" href="index.php">Back</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
           
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="assets/js/login-scripts.js"></script>

        <script>
        var myInput = document.getElementById("password");
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

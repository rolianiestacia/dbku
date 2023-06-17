<?php
session_cache_limiter('private, must-revalidate');
session_cache_expire(60);
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'assets/phpEmail/PHPMailer/src/Exception.php';
require 'assets/phpEmail/PHPMailer/src/PHPMailer.php';
require 'assets/phpEmail/PHPMailer/src/SMTP.php';


$email = "";
$name = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'dbku');

if (isset($_POST['login-admin'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
    array_push($errors, "Enter your username!");
  }
  if (empty($password)) {
    array_push($errors, "Enter your password!");
  }

  if (count($errors) == 0) {
    
 
          $pw= md5($password);
          $query = "SELECT * FROM admin WHERE username='$username' AND password='$pw'";
          $results = mysqli_query($db, $query);
          $resultCheck = mysqli_num_rows($results);
          $row = mysqli_fetch_assoc($results);
          if ($resultCheck == 1) {
              $_SESSION['admin']=$username;
              header('location: dashboard-admin.php');
          }else {
                  array_push($errors, "Bad credential!");
            }
  
  }
}

if (isset($_POST['login-employee'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
    array_push($errors, "Enter your username!");
  }
  if (empty($password)) {
    array_push($errors, "Enter your password!");
  }

  if (count($errors) == 0) {
    
 
          $pw= md5($password);
          $query = "SELECT * FROM employee WHERE emp_id='$username' AND emp_password='$pw'";
          $results = mysqli_query($db, $query);
          $resultCheck = mysqli_num_rows($results);
          $row = mysqli_fetch_assoc($results);
          if ($resultCheck == 1) {
              $_SESSION['user']=$username;
              header('location: dashboard-employee.php');
          }else {
                  array_push($errors, "Bad credential!");
            }
  
  }
}

if (isset($_POST['login-admin'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
    array_push($errors, "Enter your username!");
  }
  if (empty($password)) {
    array_push($errors, "Enter your password!");
  }

  if (count($errors) == 0) {
    
 
          $pw= md5($password);
          $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
          $results = mysqli_query($db, $query);
          $resultCheck = mysqli_num_rows($results);
          $row = mysqli_fetch_assoc($results);
          if ($resultCheck == 1) {
              $_SESSION['user']=$username;
              header('location: dashboard-admin.php');
          }else {
                  array_push($errors, "Bad credential!");
            }
  
  }
}

 //if user click continue button in forgot password form
     if(isset($_POST['check-email'])){
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $check_email = "SELECT * FROM employee WHERE emp_email='$email'";
        $run_sql = mysqli_query($db, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE employee SET emp_code = '$code' WHERE emp_email = '$email'";
            $run_query =  mysqli_query($db, $insert_code);
            if($run_query){    

                //send message
                $name = htmlentities("DAMS - DBKU Attendance Management System");
                $fromemail = htmlentities("rolianiestacia@gmail.com");
                $subject = htmlentities("Password Reset Code");
                $message = "<html>
                      <head>
                      <title>Password Reset Code</title>
                      </head>
                      <body>
                      <p>Your password reset code is <b>".$code."</b>.</p><br>
                      <br>
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
                $mail->setFrom($fromemail, $name);
                $mail->addAddress($email);
                $mail->Subject = ($subject);
                $mail->Body = $message;
                $mail->send();

                $info = "We've sent a password reset otp to your email ".$email;
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header('location: reset-code.php');
                exit();            

            }

        }
        else{
            $errors['email'] = "This email address does not exist!";
        }
    }


     if(isset($_POST['check-email-admin'])){
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $check_email = "SELECT * FROM admin WHERE email='$email'";
        $run_sql = mysqli_query($db, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE admin SET code = '$code' WHERE email = '$email'";
            $run_query =  mysqli_query($db, $insert_code);
            if($run_query){    

                //send message
                $name = htmlentities("DAMS - DBKU Attendance Management System");
                $fromemail = htmlentities("rolianiestacia@gmail.com");
                $subject = htmlentities("Password Reset Code");
                $message = "<html>
                      <head>
                      <title>Password Reset Code</title>
                      </head>
                      <body>
                      <p>Your password reset code is <b>".$code."</b>.</p><br>
                      <br>
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
                $mail->setFrom($fromemail, $name);
                $mail->addAddress($email);
                $mail->Subject = ($subject);
                $mail->Body = $message;
                $mail->send();

                $info = "We've sent a password reset otp to your email ".$email;
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header('location: reset-code-admin.php');
                exit();            

            }

        }
        else{
            $errors['email'] = "This email address does not exist!";
        }
    }


    //if user click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($db, $_POST['otp']);
        $check_code = "SELECT * FROM employee WHERE emp_code = '$otp_code'";
        $code_res = mysqli_query($db, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['emp_email'];
            $_SESSION['email'] = $email;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: new-password.php');
            exit();
        }else{
            unset($_SESSION['info']);
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if user click check reset otp button
    if(isset($_POST['check-reset-otp-admin'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($db, $_POST['otp']);
        $check_code = "SELECT * FROM admin WHERE code = '$otp_code'";
        $code_res = mysqli_query($db, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: new-password-admin.php');
            exit();
        }else{
            unset($_SESSION['info']);
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if user click change password button
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $cpassword = mysqli_real_escape_string($db, $_POST['cpassword']);

        $len = strlen($password);
        if($password !== $cpassword){
            unset($_SESSION['info']);
            $errors['password'] = "Confirm password not matched!";
        }
        else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = md5($password);
            $update_pass = "UPDATE employee SET emp_code = $code, emp_password = '$encpass' WHERE emp_email = '$email'";
            $run_query = mysqli_query($db, $update_pass);
            if($run_query){
                $info = "Your password changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: password-changed.php');
            }else{
                unset($_SESSION['info']);
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }

    if(isset($_POST['change-password-admin'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $cpassword = mysqli_real_escape_string($db, $_POST['cpassword']);
        if($password !== $cpassword){
            unset($_SESSION['info']);
            $errors['password'] = "Confirm password not matched!";
        }
        else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = md5($password);
            $update_pass = "UPDATE admin SET code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($db, $update_pass);
            if($run_query){
                $info = "Your password changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: password-changed-admin.php');
            }else{
                unset($_SESSION['info']);
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }
    
   //if login now button click
    if(isset($_POST['login-now-admin'])){
        header('Location: signin-admin.php');
    }

    //if login now button click
    if(isset($_POST['login-now-emp'])){
        header('Location: signin-employee.php');
    }

?>
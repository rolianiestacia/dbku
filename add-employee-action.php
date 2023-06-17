<?php
include_once 'connection.php';
include('authorize.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'assets/phpEmail/PHPMailer/src/Exception.php';
require 'assets/phpEmail/PHPMailer/src/PHPMailer.php';
require 'assets/phpEmail/PHPMailer/src/SMTP.php';
 
$errors = array(); 


$admin=$_SESSION['admin'];

if(isset($_POST['acid']))
{
  $id=$_POST['emp_id'];
  $mykad=$_POST['emp_mykad'];
  $name=$_POST['emp_name'];
  $email=$_POST['emp_email'];
  $code=0;
  $password=md5($_POST['emp_mykad']);
  $department=$_POST['emp_department'];

  $len=strlen($mykad);
  if($len<12 || $len>12)
  {
    array_push($errors, "The employee MyKad is invalid!");
    $_SESSION['error']="Insertion Failed! The employee MyKad has invalid value!"; 
    echo "<script> window.open('employee-mgt.php', '_parent'); </script>";
  }

  $sql="SELECT * FROM employee WHERE emp_id='$id' LIMIT 1";
  $result=mysqli_query($conn,$sql);
  $admin=mysqli_fetch_assoc($result);

  if($admin)
  {
      if ($admin['emp_id'] === $id) {
        array_push($errors, "The employee ID already exist!");
        $_SESSION['error']="Insertion Failed! The employee ID already exist!"; 
        echo "<script> window.open('employee-mgt.php', '_parent'); </script>";
      }
      
  }

  $sql="SELECT * FROM employee WHERE emp_mykad='$mykad' LIMIT 1";
  $result=mysqli_query($conn,$sql);
  $admin=mysqli_fetch_assoc($result);

  if($admin)
  {
      if ($admin['emp_mykad'] === $mykad) {
        array_push($errors, "The employee MyKad already exist!");
        $_SESSION['error']="Insertion Failed! The employee MyKad already exist!"; 
        echo "<script> window.open('employee-mgt.php', '_parent'); </script>";
      }
      
  }

  if (count($errors) == 0){

    $query=mysqli_query($conn,"INSERT INTO employee (emp_id,emp_mykad,emp_name,emp_password,emp_email,emp_department,emp_code) VALUES ('$id','$mykad','$name','$password','$email','$department','$code')");

    if($query)
    {

      //send message
      $sender = htmlentities("DAMS - DBKU Attendance Management System");
      $fromemail = htmlentities("rolianiestacia@gmail.com");
      $subject = htmlentities("Update Password on DBKU Attendance Management System");
      $message = "<html>
                      <head>
                      <title>Update Password on DBKU Attendance Management System</title>
                      </head>
                      <body>
                      <p>Your DBKU Attendance Management Account has been created. Please update your password as soon as possible. Your ID is <b>".$id."</b> and your temporary password is <b>your MyKad number</b>.</p><br>
                      <br><br>
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

      $_SESSION['success']="New employee has successfully added!"; 
      echo "<script> window.open('employee-mgt.php', '_parent'); </script>";
    }
    else{
      $_SESSION['error']="Insertion failed!"; 
      echo "<script> window.open('employee-mgt.php', '_parent'); </script>";
    }

  }
  
}
?>
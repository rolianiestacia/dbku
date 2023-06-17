<?php
include('connection.php');
include('authorize.php');

$errors = array(); 

$admin=$_SESSION['admin'];

if(isset($_POST['save']))
{
  $mykad=$_POST['emp_mykad'];
  $getmykad=$_POST['getmykad'];
  $name=$_POST['emp_name'];
  $email=$_POST['emp_email'];
  $department=$_POST['emp_department'];
  $id=$_POST['emp_id'];
  
  $len=strlen($mykad);
  if($len<12 || $len>12)
  {
    array_push($errors, "The employee MyKad is invalid!");
    $_SESSION['error']="Updation Failed! The employee MyKad has invalid value!"; 
    echo "<script> window.open('employee-mgt.php', '_parent'); </script>";
  }

  if($mykad != $getmykad)
  {
     $sql="SELECT * FROM employee WHERE emp_mykad='$mykad' LIMIT 1";
    $result=mysqli_query($conn,$sql);
    $admin=mysqli_fetch_assoc($result);

    if($admin)
    {
        if ($admin['emp_mykad'] === $mykad) {
          array_push($errors, "The employee MyKad already exist!");
          $_SESSION['error']="Updation Failed! The employee MyKad already exist!"; 
          echo "<script> window.open('employee-mgt.php', '_parent'); </script>";
        }
        
    }

  }

  if (count($errors) == 0){
     $query=mysqli_query($conn,"UPDATE employee SET emp_mykad='$mykad',emp_name='$name',emp_email='$email',emp_department='$department' WHERE emp_id='$id'");
    if($query)
    {
      $_SESSION['success'] = "Employee details successfully updated!";
      echo "<script> window.open('employee-mgt.php', '_parent'); </script>";
    }
    else{
      $_SESSION['error'] = "Updation failed!";
      echo "<script> window.open('employee-mgt.php', '_parent'); </script>";   
    }

  }
  
}
?>
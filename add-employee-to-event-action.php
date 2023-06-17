<?php
include_once 'connection.php';
include('authorize.php');
 
$errors = array(); 


$admin=$_SESSION['admin'];

if(isset($_POST['acid']))
{
  $emp_id=$_POST['employee'];
  $event_id=$_POST['eid'];
 
 

  $sql="SELECT * FROM employee WHERE emp_id='$emp_id' LIMIT 1";
  $result=mysqli_query($conn,$sql);
  $res=mysqli_fetch_assoc($result);

  $sql2="SELECT * FROM employee_event WHERE emp_id='$emp_id' AND event_id='$event_id'";
  $result2=mysqli_query($conn,$sql2);


  if(mysqli_num_rows($result2)>0)
  {
     $_SESSION['error']="Duplicate employee has been entered!"; 
      echo "<script> window.open('employee-event.php?id=".$event_id."', '_parent'); </script>";
  }
  else
  {
    $query=mysqli_query($conn,"INSERT INTO employee_event (emp_id,event_id) VALUES ('$emp_id','$event_id')");

    if($query)
    {
      $_SESSION['success']="New employee has been successfully added to the event!"; 
      echo "<script> window.open('employee-event.php?id=".$event_id."', '_parent'); </script>";
    }
    else{
      $_SESSION['error']="Insertion failed!"; 
      echo "<script> window.open('employee-event.php?id=".$event_id."'', '_parent'); </script>";
    }
  }
  
}

?>
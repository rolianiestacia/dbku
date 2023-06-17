<?php
include('connection.php');
include('authorize.php');

$errors = array(); 

$admin=$_SESSION['admin'];

if(isset($_POST['save']))
{
  $id=$_POST['id'];
  $ename=$_POST['event_name'];
  $evenue=$_POST['venue'];
  $quota=$_POST['quota'];
  $stime=$_POST['start_datetime'];
  $etime=$_POST['end_datetime'];
  $ertime=$_POST['endreg_datetime'];
  $status=$_POST['status'];
  $description=$_POST['description'];

  $query=mysqli_query($conn,"UPDATE event SET event_name='$ename',room_num='$evenue',event_attendees_quota='$quota',start_datetime='$stime', end_datetime='$etime', endreg_datetime='$ertime',status='$status',description='$description' WHERE id='$id'");

  if($query)
  {
    $_SESSION['success'] = "Event details successfully updated!";
    echo "<script> window.open('event-mgt.php', '_parent'); </script>";
  }
  else{
    $_SESSION['error'] = "Updation failed!";
    echo "<script> window.open('event-mgt.php', '_parent'); </script>";   
  }
}
?>
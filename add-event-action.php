<?php
require_once "vendor/autoload.php";

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

include_once 'connection.php';
include('authorize.php');

$qrcode_id = time().uniqid();
 
$errors = array(); 


$admin=$_SESSION['admin'];

if(isset($_POST['acid']))
{
  $ename=$_POST['event_name'];
  $evenue=$_POST['venue'];
  $quota=$_POST['quota'];
  $stime=$_POST['start_datetime'];
  $etime=$_POST['end_datetime'];
  $ertime=$_POST['endreg_datetime'];
  $status=$_POST['status'];
  $description=$_POST['description'];

  $query=mysqli_query($conn,"INSERT INTO event (event_name,room_num,event_attendees_quota,start_datetime,end_datetime,endreg_datetime,status,description,qrcode_id) VALUES ('$ename','$evenue','$quota','$stime','$etime','$ertime','$status','$description','$qrcode_id')");

  if($query)
  {
    $_SESSION['success']="New event has successfully created!"; 
    echo "<script> window.open('event-mgt.php', '_parent'); </script>";
  }
  else{
    $_SESSION['error']="Insertion failed!"; 
    echo "<script> window.open('event-mgt.php', '_parent'); </script>";
  }

  
}
?>
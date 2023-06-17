<?php 
session_start(); 
include_once 'connection.php';


  if (!isset($_SESSION['admin'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: signin-admin.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['admin']);
    header("location: index.html");
  }

$user=$_SESSION['admin'];

if($_SERVER['REQUEST_METHOD'] !='POST'){
    $_SESSION['error'] = "Error: No data to save.";
    echo "<script> window.open('calendar.php', '_parent'); </script>";
    $conn->close();
    exit;
}
extract($_POST);
$allday = isset($allday);

if(empty($id)){
    $sql = "INSERT INTO event (event_name, room_num, event_attendees_quota, description, start_datetime, end_datetime,endreg_datetime,status) VALUES ('$title','$venue', '$quota','$description','$start_datetime','$end_datetime','$endreg_datetime','$status')";
}else{
    $sql = "UPDATE event SET event_name = '{$title}', description = '{$description}', start_datetime = '{$start_datetime}', end_datetime = '{$end_datetime}', room_num = '{$venue}', event_attendees_quota = '{$quota}', endreg_datetime = '{$endreg_datetime}', status = '{$status}' WHERE id = '{$id}'";
}
$save = $conn->query($sql);
if($save){
    $_SESSION['success'] = "Event successfully saved!";
    echo "<script> window.open('calendar.php', '_parent'); </script>";
}else{
    echo "<pre>";
    echo "An Error occured.<br>";
    echo "Error: ".$conn->error."<br>";
    echo "SQL: ".$sql."<br>";
    echo "</pre>";
}
$conn->close();
?>
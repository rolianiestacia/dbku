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
    header("location: index.php");
  }

$user=$_SESSION['admin'];

if(!isset($_GET['id'])){
    echo "<script> alert('Undefined Schedule ID.');  window.open('calendar.php', '_parent'); </script>";
    $conn->close();
    exit;
}


$delete = $conn->query("DELETE FROM event WHERE id = '{$_GET['id']}'");
$conn->query("DELETE FROM event_attendees WHERE event_id = '{$_GET['id']}'");
$conn->query("DELETE FROM employee_event WHERE event_id = '{$_GET['id']}'");
if($delete){
     $_SESSION['success'] = "Event has deleted successfully!";
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
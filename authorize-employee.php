<?php
session_start(); 
include_once 'connection.php';
 
if (!isset($_SESSION['user'])) {
  $_SESSION['msg'] = "You must log in first";
  header('location: index.php');
}

if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['user']);
  unset($_SESSION['name']);
  header("location: index.php");
}

$user=$_SESSION['user'];

$query = mysqli_query($conn,"SELECT * FROM employee WHERE emp_id='$user'");
$result = mysqli_fetch_assoc($query);
$_SESSION['name'] = $result['emp_name'];

?>
<?php
session_start(); 
include_once 'connection.php';
 
if (!isset($_SESSION['admin'])) {
  $_SESSION['msg'] = "You must log in first";
  header('location: index.php');
}

if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['admin']);
  header("location: index.php");
}

$admin=$_SESSION['admin'];

?>
<?php
include_once 'connection.php';
include('authorize.php');
 
$errors = array(); 


$admin=$_SESSION['admin'];

if(isset($_POST['acid']))
{
  $id=$_POST['room_num'];
  $name=$_POST['room_name'];
  $capacity=$_POST['capacity'];

  $sql="SELECT * FROM room WHERE room_num='$id' LIMIT 1";
  $result=mysqli_query($conn,$sql);
  $res=mysqli_fetch_assoc($result);

  if($res)
  {
      if ($res['room_num'] === $id) {
        array_push($errors, "The room number already exist!");
        $_SESSION['error']="Insertion Failed! The room number already exist!"; 
        echo "<script> window.open('room-mgt.php', '_parent'); </script>";
      }
      
  }


  if (count($errors) == 0){

    $query=mysqli_query($conn,"INSERT INTO room (room_num,room_name,capacity) VALUES ('$id','$name','$capacity')");

    if($query)
    {
      $_SESSION['success']="New room has successfully added!"; 
      echo "<script> window.open('room-mgt.php', '_parent'); </script>";
    }
    else{
      $_SESSION['error']="Insertion failed!"; 
      echo "<script> window.open('room-mgt.php', '_parent'); </script>";
    }

  }
  
}
?>
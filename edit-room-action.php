<?php
include('connection.php');
include('authorize.php');

$errors = array(); 

$admin=$_SESSION['admin'];

if(isset($_POST['save']))
{
  $id=$_POST['room_num'];
  $name=$_POST['room_name'];
  $capacity=$_POST['capacity'];

  $getid = $_POST['id'];
  
  
  if($id != $getid)
  {
    $sql="SELECT * FROM room WHERE room_num='$id' LIMIT 1";
    $result=mysqli_query($conn,$sql);
    $res=mysqli_fetch_assoc($result);

    if($res)
    {
        if ($res['room_num'] === $id) {
          array_push($errors, "The room number already exist!");
          $_SESSION['error']="Updation Failed! The room number already exist!"; 
          echo "<script> window.open('room-mgt.php', '_parent'); </script>";
        }
        
    }
  }


  if (count($errors) == 0){
     $query=mysqli_query($conn,"UPDATE room SET room_num='$id',room_name='$name',capacity='$capacity' WHERE room_num='$getid'");

     $query2=mysqli_query($conn,"UPDATE event SET room_num='$id' WHERE room_num='$getid'");

    if($query && $query2)
    {
      $_SESSION['success'] = "Room details successfully updated!";
      echo "<script> window.open('room-mgt.php', '_parent'); </script>";
    }
    else{
      $_SESSION['error'] = "Updation failed!";
      echo "<script> window.open('room-mgt.php', '_parent'); </script>";   
    }

  }
  
}
?>
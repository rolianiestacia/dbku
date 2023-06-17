<?php
include('authorize.php');


if(isset($_GET['delete']))
{
    $id=$_GET['delete'];
    $query=mysqli_query($conn,"DELETE FROM room WHERE room_num='$id'");
    mysqli_query($conn,"DELETE FROM event WHERE room_num='$id'");

    if($query)
    {
        $_SESSION['success'] = "Room details deleted successfully!";
        echo "<script> window.open('room-mgt.php', '_parent'); </script>";

    }
    else
    {
    	$_SESSION['error'] = "Deletion failed!";
 		echo "<script> window.open('room-mgt.php', '_parent'); </script>";
    }
}

?>
<?php
include "connection.php";
include('authorize.php');

$response = "";
if(isset($_POST['id']))
{
    $id=$_POST['id'];
    $query=mysqli_query($conn,"SELECT * FROM room WHERE room_num='$id'");
    $row=mysqli_fetch_assoc($query);


    $response .='<form method="POST" action="edit-room-action.php">';
    $response .='<label for="room_num">Room Number</label><input class="form-control" type="text" id="room_num" name="room_num" value="'.$row['room_num'].'" ><input type="hidden" name="id" value="'.$row['room_num'].'"><br>';
    $response .='<label for="room_name">Room Name</label><input class="form-control" type="text" id="room_name" name="room_name" value="'.$row['room_name'].'" ><br>';
    $response .='<label for="capacity">Capacity</label><input class="form-control" type="text" id="capacity" name="capacity" value="'.$row['capacity'].'" ><br>';

    $response .='<div align="right"><input type="submit" name="save" class="btn btn-primary" style="background-color:#1d809f;border:1px solid #1d809f;width:100px" value="Save"></div><br>';
    $response .='</form>';  
}
else{
    $response .='Cannot edit room details!';
}

echo $response;
exit;
?>

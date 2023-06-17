<?php
include "connection.php";
include('authorize.php');

$response = "";
if(isset($_POST['id']))
{
    $response .='<form method="POST" action="add-room-action.php">';
    $response .='<label for="room_num">Room No.</label><input class="form-control" type="text" id="room_num" name="room_num" placeholder="Enter room number" required ><br>';
    $response .='<label for="room_name">Room Name</label><input class="form-control" type="text" id="room_name" name="room_name" placeholder="Enter room name" required ><br>';
    $response .='<label for="capacity">Capacity</label><input class="form-control" type="number" id="capacity" name="capacity" placeholder="Enter room capacity" required ><br>';
   

    $response .='<div align="right"><input type="submit" name="acid" class="btn btn-primary" style="background-color:#1d809f;border:1px solid #1d809f;width:100px" value="Create"></div><br>';
    $response .='</form>'; 
}
else{
    $response .='Cannot add new room!';
}

echo $response;
exit;
?>

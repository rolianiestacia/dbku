<?php
include "connection.php";
include('authorize.php');

$response = "";
if(isset($_POST['id']))
{
    $sql="SELECT * FROM room";
    $result = mysqli_query($conn,$sql);

    $response .='<form method="POST" action="add-event-action.php">';
    $response .='<label for="event_name">Event Name</label><input class="form-control" type="text" id="event_name" name="event_name" placeholder="Enter event name" required ><br>';
    
    $response .='<label for="venue">Room Name</label><select class="form-control" name="venue" id="venue" required><option disabled selected>Select or enter venue</option>';

    while($row=mysqli_fetch_assoc($result))
    {
        $response .='<option value="'.$row['room_num'].'">'.$row['room_name'].'</option>';
    }

    $response .='</select>';

    $response .='<label for="quota">Quota</label><input class="form-control" type="number" id="quota" name="quota" placeholder="Enter attendees quota" required ><br>';

    $response .='<label for="start_datetime" class="control-label">Event Start Time</label><input type="datetime-local" class="form-control form-control-sm rounded-0" name="start_datetime" id="start_datetime" required><br>';

    $response .='<label for="end_datetime" class="control-label">Event Finish Time</label><input type="datetime-local" class="form-control" name="end_datetime" id="end_datetime" required><br>';

    $response .='<label for="description" class="control-label">Description</label><textarea class="form-control" name="description" id="description"></textarea><br>';


    $response .='<label for="endreg_datetime" class="control-label">Registration Closed</label><input type="datetime-local" class="form-control" name="endreg_datetime" id="endreg_datetime" required><br>';

    $response .='<label for="status">Status</label><select class="form-control" name="status" id="status" required><option disabled selected>Select status</option>';
    $response .='<option value="Available" selected>Available</option><option value="Full">Full</option><option value="Closed">Closed</option></select><br>';

    $response .='<div align="right"><input type="submit" name="acid" class="btn btn-primary" style="background-color:#1d809f;border:1px solid #1d809f;width:100px" value="Create"></div><br>';
    $response .='</form>'; 
}
else{
    $response .='Cannot add new event!';
}

echo $response;
exit;
?>

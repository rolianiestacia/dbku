<?php
include "connection.php";
include('authorize.php');

$response = "";
if(isset($_POST['id']))
{
    $id=$_POST['id'];
    $sql="SELECT * FROM event WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn,$sql);
    $res = mysqli_fetch_assoc($result);

    $sql2 = "SELECT * FROM room";
    $result2 = mysqli_query($conn,$sql2);

    $response .='<form method="POST" action="edit-event-action.php">';
    $response .='<input type="hidden" name="id" value="'.$id.'"><label for="event_name">Event Name</label><input class="form-control" type="text" id="event_name" name="event_name" placeholder="Enter event name" value="'.$res['event_name'].'" required ><br>';
    
    $response .='<label for="venue">Room Name</label><select class="form-control" name="venue" id="venue" required>';

    $a = array();
    $b = array();


    while($row=mysqli_fetch_assoc($result2))
    {
        array_push($a,$row['room_num']);
        array_push($b,$row['room_name']);

    }


    for($i=0;$i<count($a);$i++)
    {
         if(strcmp($res['room_num'], $a[$i])==0)
        {
            $response .='<option value="'.$a[$i].'" selected>'.$b[$i].'</option>';
        }
        else
        {
             $response .='<option value="'.$a[$i].'" >'.$b[$i].'</option>';
        }
    }


    $response .='</select><br>';

    $response .='<label for="quota">Quota</label><input class="form-control" type="number" id="quota" name="quota" placeholder="Enter attendees quota" value="'.$res['event_attendees_quota'].'" required ><br>';

    $response .='<label for="start_datetime" class="control-label">Event Start Time</label><input type="datetime-local" class="form-control form-control-sm rounded-0" name="start_datetime" id="start_datetime" value="'.$res['start_datetime'].'" required><br>';

    $response .='<label for="end_datetime" class="control-label">Event Finish Time</label><input type="datetime-local" class="form-control" name="end_datetime" id="end_datetime" value="'.$res['end_datetime'].'" required><br>';

    $response .='<label for="description" class="control-label">Description</label><textarea class="form-control" name="description" id="description">'.$res['description'].'</textarea><br>';


    $response .='<label for="endreg_datetime" class="control-label">Registration Closed</label><input type="datetime-local" class="form-control" name="endreg_datetime" id="endreg_datetime" value="'.$res['endreg_datetime'].'" required><br>';

    $response .='<label for="status">Status</label><select class="form-control" name="status" id="status" required>';

    $status = $res['status'];

    if($status == "Available")
    {
        $response .='<option value="Available" selected>Available</option><option value="Full">Full</option><option value="Closed">Closed</option></select><br>';
    }
    else if($status == "Full")
    {
        $response .='<option value="Available">Available</option><option value="Full" selected>Full</option><option value="Closed">Closed</option></select><br>';
    }
    else{
        $response .='<option value="Available">Available</option><option value="Full">Full</option><option value="Closed" selected>Closed</option></select><br>';
    }

    $response .='<div align="right"><input type="submit" name="save" class="btn btn-primary" style="background-color:#1d809f;border:1px solid #1d809f;width:100px" value="Save"></div><br>';
    $response .='</form>'; 
}
else{
    $response .='Cannot update event details!';
}

echo $response;
exit;
?>

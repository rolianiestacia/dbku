<?php
include('authorize.php');


if(isset($_GET['delete']))
{
    $id=$_GET['delete'];
    $query=mysqli_query($conn,"DELETE FROM event WHERE id='$id'");

    mysqli_query($conn,"DELETE FROM event_attendees WHERE event_id='$id'");
    mysqli_query($conn,"DELETE FROM employee_event WHERE event_id='$id'");

    if($query)
    {
        $_SESSION['success'] = "Event details deleted successfully!";
        echo "<script> window.open('event-mgt.php', '_parent'); </script>";

    }
    else
    {
    	$_SESSION['error'] = "Deletion failed!";
 		echo "<script> window.open('event-mgt.php', '_parent'); </script>";
    }
}

?>
<?php
include('authorize.php');


if(isset($_GET['emp_id']) && isset($_GET['event_id']))
{
    $emp_id=$_GET['emp_id'];
    $event_id=$_GET['event_id'];

    $query=mysqli_query($conn,"DELETE FROM employee_event WHERE emp_id='$emp_id' AND event_id='$event_id'");

    if($query)
    {
        $_SESSION['success'] = "Deletion Success!";
        echo "<script> window.open('employee-event.php?id=".$event_id."', '_parent'); </script>";

    }
    else
    {
    	$_SESSION['error'] = "Deletion failed!";
 		echo "<script> window.open('employee-event.php?id=".$event_id."', '_parent'); </script>";
    }
}

?>
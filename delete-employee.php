<?php
include('authorize.php');


if(isset($_GET['delete']))
{
    $id=$_GET['delete'];
    $query=mysqli_query($conn,"DELETE FROM employee WHERE emp_id='$id'");

    mysqli_query($conn,"DELETE FROM employee_event WHERE emp_id='$id'");

    if($query)
    {
        $_SESSION['success'] = "Employee details deleted successfully!";
        echo "<script> window.open('employee-mgt.php', '_parent'); </script>";

    }
    else
    {
    	$_SESSION['error'] = "Deletion failed!";
 		echo "<script> window.open('employee-mgt.php', '_parent'); </script>";
    }
}

?>
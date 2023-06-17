<?php
include "connection.php";
include('authorize.php');

$response = "";
if(isset($_POST['id']))
{
    $eid=$_POST['id'];
    $query = mysqli_query($conn,"SELECT * FROM employee");

    $response .='<form method="POST" action="add-employee-to-event-action.php">';
    $response .='<select class="form-control" id="employee" name="employee" required><option value="" >Select employee to add</option>';

    while($row=mysqli_fetch_assoc($query))
    {
        $response .='<option value="'.$row['emp_id'].'">'.$row['emp_id'].' - '.$row['emp_name'].'</option>';
    }

    $response .='</select><input type="hidden" name="eid" value="'.$eid.'"><br><br>';
   

    $response .='<div align="right"><input type="submit" name="acid" class="btn btn-primary"></div><br>';
    $response .='</form>'; 
}
else{
    $response .='Cannot add new room!';
}

echo $response;
exit;
?>

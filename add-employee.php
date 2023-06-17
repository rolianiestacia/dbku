<?php
include "connection.php";
include('authorize.php');

$response = "";
if(isset($_POST['id']))
{
    $response .='<form method="POST" action="add-employee-action.php">';
    $response .='<label for="emp_id">Employee ID</label><input class="form-control" type="text" id="emp_id" name="emp_id" placeholder="Enter employee ID" required ><br>';
    $response .='<label for="emp_mykad">MyKad No.</label><input class="form-control" onkeyup="myfunction()" type="text" id="emp_mykad" name="emp_mykad" placeholder="Enter employee MyKad No." required ><p style="color: red" id="check"></p>';
    $response .='<label for="emp_name">Name</label><input class="form-control" type="text" id="emp_name" name="emp_name" placeholder="Enter employee name" required ><br>';
    $response .='<label for="emp_email">Email Address</label><input class="form-control" type="email" id="emp_email" name="emp_email" placeholder="Enter employee email address" required ><br>';
    $response .='<label for="emp_department">Department</label><select class="form-control" id="emp_department" name="emp_department" required><option disabled selected>Select employee department</option><option value="General Management">General Management</option> <option value="Marketing">Marketing</option> <option value="Operation">Operation</option><option value="Finance">Finance</option><option value="Human Resource">Human Resource</option><option value="Information and Communication Technology (ICT)">Information and Communication Technology (ICT)</option>   </select><br>';


    $response .='<div align="right"><input type="submit" name="acid" class="btn btn-primary" style="background-color:#1d809f;border:1px solid #1d809f;width:100px" value="Create"></div><br>';
    $response .='</form>'; 
}
else{
    $response .='Cannot add new employee!';
}

echo $response;
exit;
?>

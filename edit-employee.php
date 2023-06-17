<?php
include "connection.php";
include('authorize.php');

$response = "";
if(isset($_POST['id']))
{
    $id=$_POST['id'];
    $query=mysqli_query($conn,"SELECT * FROM employee WHERE emp_id='$id'");
    $row=mysqli_fetch_assoc($query);

    $dep = array("General Management", "Marketing", "Operation","Finance","Human Resource","Information and Communication Technology (ICT)");

    $response .='<form method="POST" action="edit-employee-action.php">';
    $response .='<label for="emp_id">Employee ID</label><input class="form-control" type="text" id="emp_id" name="emp_id" value="'.$row['emp_id'].'" readonly ><br>';
    $response .='<label for="emp_mykad">MyKad No.</label><input class="form-control" onkeyup="myfunction()" type="text" id="emp_mykad" name="emp_mykad" placeholder="Enter employee MyKad No." value="'.$row['emp_mykad'].'" required ><input type="hidden" name="getmykad" value="'.$row['emp_mykad'].'"><p style="color: red" id="check"></p>';
    $response .='<label for="emp_name">Name</label><input class="form-control" type="text" id="emp_name" name="emp_name" placeholder="Enter employee name" value="'.$row['emp_name'].'" required ><br>';
    $response .='<label for="emp_email">Email Address</label><input class="form-control" type="email" id="emp_email" name="emp_email" placeholder="Enter employee email address" value="'.$row['emp_email'].'" required ><br>';
    $response .='<label for="emp_department">Department</label><select class="form-control" id="emp_department" name="emp_department" required>';


    for($i=0;$i<count($dep);$i++)
    {
        if(strcmp($row['emp_department'], $dep[$i])==0)
        {
            $response .='<option value="'.$dep[$i].'" selected>'.$dep[$i].'</option>';
        }
        else
        {
             $response .='<option value="'.$dep[$i].'" >'.$dep[$i].'</option>';
        }

    }

     $response .='</select><br>';

    $response .='<div align="right"><input type="submit" name="save" class="btn btn-primary" style="background-color:#1d809f;border:1px solid #1d809f;width:100px" value="Save"></div><br>';
    $response .='</form>';  
}
else{
    $response .='Cannot edit employee details!';
}

echo $response;
exit;
?>

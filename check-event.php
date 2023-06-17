<?php
include('connection.php');

$sql = "SELECT * FROM event";
$query = mysqli_query($conn,$sql);

while($row=mysqli_fetch_assoc($query))
{
	date_default_timezone_set("Asia/Kuching");

	$due=date("Y-m-d",strtotime($row['endreg_datetime']));
	$current=time();
    $curr_date=strtotime(date("Y-m-d",$current));
    $due_date=strtotime($due);

    $id=$row['id'];

   if($curr_date>$due_date)
   {
   	 $status="Closed";
   	 mysqli_query($conn,"UPDATE event SET status='$status' WHERE id='$id'");
   }

}


?>
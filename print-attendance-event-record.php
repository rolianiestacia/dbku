<?php
#The mpdf codes is adapted from https://www.etutorialspoint.com/index.php/195-how-to-generate-pdf-file-using-mpdf-in-php retrieved in March 2022
?>

<?php
 
  include_once 'connection.php';
  require_once __DIR__ . '/assets/vendor/autoload.php';

  $mpdf = new \Mpdf\Mpdf(['format' => 'Legal']);
  session_start(); 

$id = $_GET['id'];
$query=mysqli_query($conn,"SELECT * FROM event WHERE id = '$id'");
$query2=mysqli_query($conn,"SELECT * FROM event_attendees WHERE event_id = '$id'");

$row=mysqli_fetch_assoc($query);
$room= $row['room_num'];

$roomq = mysqli_query($conn,"SELECT * FROM room WHERE room_num='$room'");
$getrn = mysqli_fetch_assoc($roomq);
$rn = $getrn['room_name'];
  
  $data ='';
  $data .='<style>
  table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  font-size:13px;
  text-align: center;
  vertical-align: middle;
  table-layout:fixed;
}

td, th {
  border: 1px solid #dddddd;
  width:12.5%;
  padding: 20px;
  padding-top: 20px;
  padding-bottom: 20px;
}
h2{
    text-align:center;
}
.centered
{
    text-align: center;
}
.left
{
    text-align: left;
}
</style>';

 $data .='<div class="container-fluid px-4">
             <div class="card-body">
                   
                    <h2> Attendees for '.$row['event_name'].'</h2>
                    <div>
                        <br>
                        <table class="table-bordered left" id="receipt">
                           <tr>
                            <td style="width:40%">&nbsp;&nbsp;<b>Event ID</b>: '.$row['id'].'</td>
                            <td style="width:35%">&nbsp;&nbsp; <b>Event Name</b>: '.$row['event_name'].'</td>
                            <td style="width:35%">&nbsp;&nbsp;<b>Venue</b>: '.$rn.'</td>

                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;<b>Time</b>: '.$row['start_datetime'].' - <br>&nbsp;&nbsp;'.$row['end_datetime'].'</td>
                            <td>&nbsp;&nbsp;<b>Quota</b>: '.$row['event_attendees_quota'].'</td>
                            <td>&nbsp;&nbsp;<b>Status</b>: '.$row['status'].'</td>
                        </tr> 
                        <tr>
                             <td>&nbsp;&nbsp;<b>Registration Close</b>: '.$row['endreg_datetime'].'</td>
                            <td colspan="2">&nbsp;&nbsp;<b>Description</b>: '.$row['description'].'</td>
                        </tr>';                     
                        
                       
               $data .= '</table></div><br><br>

               <p><b>Attendance Records<b></p>';

               $data .='<table class="table-bordered centered"><tr>
                        <th><center>No.</center></th>
                        <th><center>Name</center></th>
                        <th><center>MyKad</center></th>
                        <th><center>Email</center></th>
                        <th><center>Contact Number</center></th></tr>';

                 $count=1;
                if(mysqli_num_rows($query2)>0)
                {
                    while($row=mysqli_fetch_assoc($query2))
                    {
                         $data .= '<tr>
                                <td>'.$count.'</td>
                                <td>'.$row['attendee_name'].'</td>
                                <td>'.$row['attendee_mykad'].'</td>
                                <td>'.$row['attendee_email'].'</td>
                                <td>'.$row['attendee_contactnum'].'</td>
                            
                                
                             </tr>';
        
                        $count++;  
    }
                }

               $data .='</table>';

 $mpdf->AddPage('L');
 $mpdf->WriteHTML($data);
 $mpdf->Output('Attendance Report.pdf','I');


exit;
?>
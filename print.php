<?php
#The mpdf codes is adapted from https://www.etutorialspoint.com/index.php/195-how-to-generate-pdf-file-using-mpdf-in-php retrieved in March 2022
?>

<?php
 
  include_once 'connection.php';
  require_once __DIR__ . '/assets/vendor/autoload.php';

  $mpdf = new \Mpdf\Mpdf(['format' => 'Legal']);
  session_start(); 

  $id=$_POST['id'];

  $sql="SELECT * FROM event_attendees WHERE id = '$id' LIMIT 1";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);

  $event_id = $row['event_id'];
  $query=mysqli_query($conn,"SELECT * FROM event WHERE id = '$event_id' LIMIT 1");
  $res = mysqli_fetch_assoc($query);

  $room_num = $res['room_num'];
  $roomquery = mysqli_query($conn,"SELECT * FROM room WHERE room_num = '$room_num' LIMIT 1");
  $getroomname = mysqli_fetch_assoc($roomquery);
  $room_name = $getroomname['room_name'];
  
  $data ='';
  $data .='<style>
  table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  font-size:14px;
  text-align: center;
  vertical-align: middle;
  table-layout:fixed;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  width:12.5%;
  padding: 20px;
  padding-top: 20px;
  padding-bottom: 20px;
}
h2{
    text-align:center;
}
</style>';

 $data .='<div class="container-fluid px-4">
             <div class="card-body">
                   
                    <h2><span style="color:green">DBKU</span> Event Registration</h2>
                    <div>
                        <p><b>Attendee Details<b></p>
                        <table class="table-bordered" id="receipt">
                            <tr>
                                <th><b>Name</b></th>
                                <td>'.$row['attendee_name'].'</td>
                            </tr>
                             <tr>
                                <th><b>MyKad No.</b></th>
                                <td>'.$row['attendee_mykad'].'</td>
                            </tr>
                             <tr>
                                <th><b>Email</b></th>
                                <td>'.$row['attendee_email'].'</td>
                            </tr>
                            <tr>
                                <th><b>Contact Number</b></th>
                                <td>'.$row['attendee_contactnum'].'</td>
                            </tr>';                     
                        
                       
               $data .= '</table></div><br><br>

               <p><b>Event Details<b></p>

               <div>
               <table class="table-bordered" id="event-details">
               <tr><th>Event Name</th><td>'.$res['event_name'].'</td><th>Venue</th><td>'.$room_name.'</td></tr>
               <tr><th>Time</th><td>'.$res['start_datetime'].' ~ '.$res['start_datetime'].'</td><th>Description</th><td>'.$res['description'].'</td></tr>
               </table></div></div></div>';

 $mpdf->AddPage('L');
 $mpdf->WriteHTML($data);
 $mpdf->Output('DBKU Event Registration Receipt.pdf','I');


exit;
?>
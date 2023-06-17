<?php
#The mpdf codes is adapted from https://www.etutorialspoint.com/index.php/195-how-to-generate-pdf-file-using-mpdf-in-php retrieved in March 2022
?>

<?php
 
  include_once 'connection.php';
  require_once __DIR__ . '/assets/vendor/autoload.php';

  $mpdf = new \Mpdf\Mpdf(['format' => 'Legal']);
  session_start(); 

$id = $_GET['id'];
$query=mysqli_query($conn,"SELECT * FROM employee WHERE emp_id = '$id'");
$query2=mysqli_query($conn,"SELECT * FROM employee_event WHERE emp_id = '$id'");

$row=mysqli_fetch_assoc($query);
  
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
                   
                    <h2> Attendance Report</h2>
                    <div>
                        <br>
                        <table class="table-bordered left" id="receipt">
                            <tr>
                                <td style="width:35%">&nbsp;&nbsp; <b>Employee ID</b>: '.$row['emp_id'].'</td>
                                <td colspan="2">&nbsp;&nbsp;<b>Name</b>: '.$row['emp_name'].'</td>
                            </tr>
                            <tr>
                                <td style="width:35%">&nbsp;&nbsp;<b>MyKad</b>: '.$row['emp_mykad'].'</td>
                                <td>&nbsp;&nbsp;<b>Email</b>: '.$row['emp_email'].'</td>
                                <td>&nbsp;&nbsp;<b>Department</b>: '.$row['emp_department'].'</td>
                            </tr>';                     
                        
                       
               $data .= '</table></div><br><br>

               <p><b>Attendance Records<b></p>';

               $data .='<table class="table-bordered centered"><tr>
                        <th><center>No.</center></th>
                        <th><center>Event ID</center></th>
                        <th><center>Event Name</center></th>
                        <th><center>Check In </center></th>
                        <th><center>Location</center></th>
                        <th><center>Remarks</center></th></tr>';

                 $count=1;
                if(mysqli_num_rows($query2)>0)
                {
                    while($row=mysqli_fetch_assoc($query2))
                    {
                        $eid = $row['event_id'];
                        $query3 = mysqli_query($conn,"SELECT * FROM event WHERE id='$eid'");
                        $res = mysqli_fetch_assoc($query3);
                        $ename = $res['event_name'];



                         $remarks="";
                         $id = $row['id'];
                    
                          date_default_timezone_set("Asia/Kuching");
                          $rem = strtotime($res['end_datetime']) - time();
                          $day = floor($rem / 86400);
                          $hr  = floor(($rem % 86400) / 3600);
                          $min = floor(($rem % 3600) / 60);
                          $sec = ($rem % 60);
                          if($day<0 && $row['location']==""){
                            $remarks="Absent";
                            mysqli_query($conn,"UPDATE employee_event SET remark = '$remarks' WHERE id = '$id'");
                          }

    
                        
                        $data .='<tr>
                                <td>'.$count.'</td>
                                <td>'.$row['event_id'].'</td>
                                <td>'.$ename.'</td>
                                <td>'.$row['check_in'].'</td>
                                <td>'.$row['location'].'</td>
                                <td><p style="color:red">'.$remarks.'</p></td>
                                
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
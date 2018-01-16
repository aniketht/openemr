<?php


namespace OpenEMR\Services;

class RemotePatientService
{

  
   

  /**
   * Default constructor.
   */
    public function __construct()
    {
    }

    public function PatientSMSReply()
    {
       $lenght=explode('/',$body);
$space=explode(' ',$body);
$int = preg_replace('/[^0-9]+/', '/', $body);
$array = explode('/',$int);
$dbhandle = mysqli_connect($host, $login, $pass) or die("Unable to connect to MySQL");
echo "Connected to MySQl";
$selected = mysqli_select_db($dbhandle,$dbase) or die("Could not select examples");
echo "database selected";
$bps=$array[1];
$bpd=$array[2];
if(count($lenght)==2 && strlen($body)<9)
{
   $bps=$lenght[0];
   $bpd=$lenght[1];
}
else if(count($space)==2 && strlen($body)<9)
{
   $bps=$space[0];
   $bpd=$space[1];
}
echo $bps.'/'.$bpd;
$date = date('Y/m/d H:i:s');
$result = mysqli_query($dbhandle,"select * from patient_data where phone_cell=".$number);

$row = mysqli_fetch_array($result);

$pid=$row['id'];
echo "id is==>".$pid;
if(isset($bps) && isset($bpd))
{
//$result = mysql_query("insert into form_vitals(pid,bps,bpd,date) values('{$pid}', '{$bps}','{$bpd}','{$date}')");
$result = $dbhandle->prepare("insert into form_vitals(pid,bps,bpd,date) values (?,?,?,?)");
$result->bind_param("isss",$pid,$bps,$bpd,$date);
$result->execute();
$result->close();
}
if(!isset($bps) && !isset($bpd) || isset($bps) && !isset($bpd))
 {
       
        $getglucse = preg_replace('/[^0-9]+/', '', $body);
        echo  $getglucse;
        $result = $dbhandle->prepare("insert into remote_patient_glucose(pid,phone_number,blood_glucose,last_seen) values(?, ?,?,?)");
        $result->bind_param("isss",$pid,$number,$getglucse,$date);
        $result->execute();
        $result->close();
 }
    }

    

 
}

?>

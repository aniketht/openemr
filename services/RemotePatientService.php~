<?php
use Twilio\Rest\Client;
require "Twilio/autoload.php";
class RemotePatientService
{

  
   

  /**
   * Default constructor.
   */
    public function __construct()
    {
   
    }
    public function SendSMSPatient($host,$login,$pass,$dbase)
    {
       $dbhandle = mysql_connect($host, $login, $pass) or die("Unable to connect to MySQL");
       $selected = mysql_select_db($dbase) or die("Could not select examples");
       $test= date('m/d/Y h:i:s a', time());
       $currentTime=(new DateTime($test))->format("H");
       $result = mysql_query("select * from remote_patient_vital_alert_jobs");
       $AccountSid = "AC7067cb055c712a625ead0fde5618d876";
       $AuthToken = "70d578bdc97028bffa482e67174d3ef0";
       while ($row = mysql_fetch_array($result)) {
   
         $client = new Client($AccountSid, $AuthToken);
         echo "Current collection time".$currentTime;
         echo "row collection_time".$row['collection_time'];
        if($row['collection_time']==$currentTime)
         {
           echo "success";
           $people = array(
       
              $row['phone_number'] => 'user',
           );

    
         foreach ($people as $number => $name) {

          $sms = $client->account->messages->create(

            
            $number,

            array(
                
                'from' => "+14129064618", 
                
                
                'body' => "Hey , Please submit your blood pressure records"
            )
        );

      
       }
     }
  
   echo "<h2> Notify patient successfully</h2>";

   }


 }
    public function PatientSMSreply($host, $login, $pass,$dbase,$number,$body)
    {
      $dbhandle = mysqli_connect($host, $login, $pass) or die("Unable to connect to MySQL");
      $selected = mysqli_select_db($dbhandle,$dbase) or die("Could not select examples");
      $lenght=explode('/',$body);
      $space=explode(' ',$body);
      $int = preg_replace('/[^0-9]+/', '/', $body);
      $array = explode('/',$int);
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
     
     $date = date('Y/m/d H:i:s');
     $result = mysqli_query($dbhandle,"select * from patient_data where phone_cell=".$number);
     
     $row = mysqli_fetch_array($result);
    
     $pid=$row['id'];
     
     if(isset($bps) && isset($bpd))
     {

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

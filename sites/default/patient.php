<?php
use Twilio\Rest\Client;
require "Twilio/autoload.php";
include("sqlconf.php");
echo $host;
$dbhandle = mysql_connect($host, $login, $pass) or die("Unable to connect to MySQL");
echo "Connected to MySQl";
$selected = mysql_select_db($dbase) or die("Could not select examples");
echo "database selected";
$test= date('m/d/Y h:i:s a', time());
$currentTime=(new DateTime($test))->format("H");
$result = mysql_query("select * from remote_patient_vital_alert_jobs");
$AccountSid = "AC7067cb055c712a625ead0fde5618d876";
$AuthToken = "70d578bdc97028bffa482e67174d3ef0";
while ($row = mysql_fetch_array($result)) {
   
    $client = new Client($AccountSid, $AuthToken);
   echo "Current collection time".$currentTime;
   if($row['collection_time']==$currentTime)
     {
        echo "ids==>".$row['patient_id']." phone".$row['phone_number'];
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



?>

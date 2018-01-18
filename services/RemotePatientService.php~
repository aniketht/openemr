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
    public function SendSMSPatient()
    {
     
       $test= date('m/d/Y h:i:s a', time());
       $currentTime=(new DateTime($test))->format("H");
       $result = SqlStatement("select * from remote_patient_vital_alert_jobs");
       $AccountSid = "AC7067cb055c712a625ead0fde5618d876";
       $AuthToken = "70d578bdc97028bffa482e67174d3ef0";
       while ($row = sqlFetchArray($result)) {
   
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
    public function PatientSMSreply($number,$body)
    {
      
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
     $result = SqlStatement("select * from patient_data where phone_cell=".$number);
     
     $row = sqlFetchArray($result);
    
     $pid=$row['id'];
     
     if(isset($bps) && isset($bpd))
     {

       $sql="insert into form_vitals set pid=?,bps=?,bpd=?,date=?";
       $result = SqlStatement($sql,array($pid,$bps,$bpd,$date));
      
      }
    if(!isset($bps) && !isset($bpd) || isset($bps) && !isset($bpd))
     {
       
        $getglucse = preg_replace('/[^0-9]+/', '', $body);
        echo  $getglucse;
        
        if($getglucse && strlen($getglucse) < 4)
        {
        $sql="insert into form_vitals set pid=?,blood_glucose=?,date=?";
        $result = SqlStatement($sql,array($pid,$getglucse,$date));
        }
        else
        {
          ?><Response>
               <Message>
                These are following acceptable response format
                blood glucose :124,
                blood pressure : 120/80,
                bp:120/80,
                120/80,
                124,
                </Message>
              </Response>

            <?php    
        }
        
     }

 }

    

 
}

?>

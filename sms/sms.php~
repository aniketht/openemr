


<?php
   
    use Twilio\Rest\Client;
    require "Twilio/autoload.php";
    
    
    
    $AccountSid = "AC0ba4c3fb206a1966f9c21f5657f30fe9";
    $AuthToken = "6e47e8cfac4587692dc207f9ee5e4a9a";

    
    $client = new Client($AccountSid, $AuthToken);

   
    $people = array(
       
        "+919067801779" => "ani",
        
    );

    
    foreach ($people as $number => $name) {

        $sms = $client->account->messages->create(

            
            $number,

            array(
                
                'from' => "+19095808858", 
                
                
                'body' => "Hey $name, Monkey Party at 6PM. Bring Bananas!"
            )
        );

       echo "Sent message to $name";
    }
?>






<?php
// Copyright (C) 2012, 2016 Rod Roark <rod@sunsetsystems.com>
// Sponsored by David Eschelbacher, MD
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
use Twilio\Rest\Client;
require "Twilio/autoload.php";
require_once("../../globals.php");
$AccountSid = "AC0ba4c3fb206a1966f9c21f5657f30fe9";
$AuthToken = "6e47e8cfac4587692dc207f9ee5e4a9a";
$popup = empty($_REQUEST['popup']) ? 0 : 1;

// Generate some code based on the list of columns.
//

$colcount = 0;
$header0 = "";
$header  = "";
$coljson = "";
$res = sqlStatement("SELECT DISTINCT fv.pid,fv.date,pd.fname,pd.lname,pd.phone_cell,pd.id FROM form_vitals fv inner join patient_data pd on fv.pid=pd.id order by fv.date ");
while ($row = sqlFetchArray($res)) {
  
    
  
    
    
    //$row['phone_cell']
    
 
    
    $client = new Client($AccountSid, $AuthToken);

   
    $people = array(
       
        '2323234'=> "ani",
        
    );

    
    foreach ($people as $number => $name) {

        $sms = $client->account->messages->create(

            
            $number,

            array(
                
                'from' => "+19095808858", 
                
                
                'body' => "Hey $name, Please submit your blood pressure records"
            )
        );

      // echo "Sent message to $name";
    }


    
}

?>

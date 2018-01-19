

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

require_once(dirname(__FILE__) ."/../../globals.php");
require_once(dirname(__FILE__) ."/../../TwilioConfig.php");

$AccountSid = $AccountSid;
$AuthToken = $AuthToken;
$popup = empty($_REQUEST['popup']) ? 0 : 1;

// Generate some code based on the list of columns.
//

$glrow = sqlQuery("SELECT * FROM  form_vitals");

$colcount = 0;
$header0 = "";
$header  = "";
$coljson = "";
$cellNumber='+'.$_GET['phone_number'];
$patientNumber = str_replace(' ', '', $cellNumber);




    $client = new Client($AccountSid, $AuthToken);

   
    $people = array(
       
       $patientNumber => 'user',
        
    );

    
    foreach ($people as $number => $name) {

        $sms = $client->account->messages->create(

            
            $number,

            array(
                
                'from' => $TwilioNumber, 
                
                
                'body' => "Hey , Please submit your blood pressure records"
            )
        );

      
    }
   echo "<h2> Notify patient successfully</h2>".$number;

    


?>


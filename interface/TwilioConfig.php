<?php

/*
  set Twilio configuration here
*/

$sid=sqlStatement("select * from globals where gl_name='Twilio_sid'");
$sidRow = sqlFetchArray($sid);
$authToken= sqlStatement("select * from globals where gl_name='twilio_authtoken'");
$authRow = sqlFetchArray($authToken);
$twilioNumber= sqlStatement("select * from globals where gl_name='twilio_number'");
$TwilioNumRow = sqlFetchArray($twilioNumber);
$AccountSid = $sidRow['gl_value'];
$AuthToken = $authRow['gl_value'];
$TwilioNumber= $TwilioNumRow['gl_value'];

?>

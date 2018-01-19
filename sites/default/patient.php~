<?php

include("sqlconf.php");
include("../../services/RemotePatientService.php");
include("../../interface/globals.php");
include("../../interface/TwilioConfig.php");
$RemotePatient = new RemotePatientService();
echo $RemotePatient->SendSMSPatient($AccountSid,$AuthToken,$TwilioNumber);
?>

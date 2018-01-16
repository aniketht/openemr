<?php

include("sqlconf.php");
include("../../services/RemotePatientService.php");
$RemotePatient = new RemotePatientService();
echo $RemotePatient->SendSMSPatient($host, $login, $pass,$dbase);
?>

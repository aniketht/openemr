<?php
include("sqlconf.php");
include("../../services/RemotePatientService.php");
$number = $_POST['From'];
$body = $_POST['Body'];
$RemotePatient = new RemotePatientService();
echo $RemotePatient->PatientSMSreply($host, $login, $pass,$dbase,$number,$body);
header('Content-Type: text/xml');
?>
 <Response>
    <Message>
        Thank you for your Response
    </Message>
</Response>


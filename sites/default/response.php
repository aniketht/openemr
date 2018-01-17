<?php
include("sqlconf.php");
include("../../services/RemotePatientService.php");
include("../../interface/globals.php");
$number = $_POST['From'];
$body = $_POST['Body'];
$RemotePatient = new RemotePatientService();
echo $RemotePatient->PatientSMSreply($number,$body);
header('Content-Type: text/xml');
?>
 <Response>
    <Message>
        Thank you for your Response
    </Message>
</Response>


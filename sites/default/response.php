<?php
include("sqlconf.php");
include("../../services/RemotePatientService.php");
include("../../interface/globals.php");
$RemotePatient = new RemotePatientService();
echo $RemotePatient->PatientSMSreply($number,$body);
header('Content-Type: text/xml');
?>
 <Response>
    <Message>
        <?php
          $checkResponse = preg_replace('/[^0-9]+/', '', $body);
          echo $checkResponse;
          if($checkResponse)
          {
             ?>Thanks For your Response <?php
          }
          else
          {
              ?>These are following acceptable response format
                blood glucose :124
                blood pressure : 120/80
                bp:120/80
                120/80
                124
              <?php
          }
      ?>
        
    </Message>
</Response>


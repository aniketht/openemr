<?php
include("sqlconf.php");

$number = $_POST['From'];
$body = $_POST['Body'];

$lenght=explode('/',$body);
$space=explode(' ',$body);
$int = preg_replace('/[^0-9]+/', '/', $body);
$array = explode('/',$int);
$dbhandle = mysql_connect($host, $login, $pass) or die("Unable to connect to MySQL");
echo "Connected to MySQl";
$selected = mysql_select_db($dbase) or die("Could not select examples");
echo "database selected";
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
echo $bps.'/'.$bpd;
$date = date('Y/m/d H:i:s');
$result = mysql_query("select * from patient_data where phone_cell=".$number);
$row = mysql_fetch_array($result);
$pid=$row['id'];
if(isset($bps) && isset($bpd))
{
$result = mysql_query("insert into form_vitals(pid,bps,bpd,date) values('{$pid}', '{$bps}','{$bpd}','{$date}')");
}
if(!isset($bps) && !isset($bpd) || isset($bps) && !isset($bpd))
 {
       
        $getglucse = preg_replace('/[^0-9]+/', '', $body);
        echo  $getglucse;
        $result = mysql_query("insert into remote_patient_glucose(pid,phone_number,blood_glucose,last_seen) values('{$pid}', '{$number}','{$getglucse}','{$date}')");
 }
header('Content-Type: text/xml');
?>
 <Response>
    <Message>
        Hello <?php echo $number ?>.
        You said <?php echo $body ?>
    </Message>
</Response>


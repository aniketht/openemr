<?php
include("sqlconf.php");

$number = $_POST['From'];
$body = $_POST['Body'];
$int = preg_replace('/[^0-9]+/', '/', $body);
$array = explode('/',$int);
$dbhandle = mysql_connect($host, $login, $pass) or die("Unable to connect to MySQL");
echo "Connected to MySQl";
$selected = mysql_select_db($dbase) or die("Could not select examples");
echo "database selected";
$bps=$array[1];
$bpd=$array[2];
$date = date('Y/m/d H:i:s');
$result = mysql_query("select * from patient_data where phone_cell=".$number);
$row = mysql_fetch_array($result);
$pid=$row['id'];
$result = mysql_query("insert into form_vitals(pid,bps,bpd,date) values('{$pid}', '{$bps}','{$bpd}','{$date}')");
header('Content-Type: text/xml');
?>
 
<Response>
    <Message>
        Hello <?php echo $number ?>.
        You said <?php echo $body ?>
    </Message>
</Response>

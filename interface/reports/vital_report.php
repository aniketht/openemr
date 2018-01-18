<?php
require_once("../globals.php");

$time=$_POST['time'];
$type=$_POST['type'];
$id=$_POST['id'];
$test= date('m/d/Y h:i:s a', time());
$pid=$_GET['pid'];
$res = sqlStatement("SELECT * FROM form_vitals WHERE pid=".$pid);
$bps=array();
$bpd=array();
$dates=array();
$book = new stdClass;
while ($row = sqlFetchArray($res))
{ 
  array_push($vitalData,$row);
  $books = (object) $row;
  array_push($bps,$row['bps']);
  array_push($bpd,$row['bpd']);
  array_push($dates,$row['date']);
}
$getGlucoseRecords=sqlStatement("SELECT * FROM form_vitals WHERE pid=".$pid);
$blood_glucose=array();
$blood_glucose_dates=array();
while ($Glucoserow = sqlFetchArray($getGlucoseRecords))
{
    if(isset($Glucoserow['blood_glucose']))
    {
      array_push($blood_glucose,$Glucoserow['blood_glucose']);
      array_push($blood_glucose_dates,$Glucoserow['date']);
    }
               
}
$blood_glucose;
$blood_glucose_dates;
          
$currentTime=(new DateTime($test))->format("H");
if(isset($id))
{
$phone_number=sqlStatement("select phone_cell from patient_data where id=".$id);
$row = sqlFetchArray($phone_number);

sqlStatement("INSERT INTO remote_patient_vital_alert_jobs(patient_id, collection_time,phone_number,request_type) VALUES (?, ?,?,?)",array($_POST[id],$_POST[time],$row[phone_cell],$_POST[type]));
$getResponse=sqlStatement("select * from remote_patient_vital_alert_jobs");
while($eachrow = sqlFetchArray($getResponse))
{
     if($eachrow['collection_time']==$currentTime)
     {
        
     }

}



}
else
{
  
}
?>
<html>
<head>
<script type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/dygraph/2.1.0/dygraph.js"></script>
  <link href="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css"
    rel="stylesheet" type="text/css" />
<script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" src="https://cdnjs.cloudflare.com/ajax/libs/dygraph/2.1.0/dygraph.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
</head>
<title>Gia Barclay</title>
<body>
<form method="post" name="vital_form" action="../reports/vital_report.php?pid=<?php echo $pid; ?>">

    <div class="form-group col-sm-3 ">
      <label for="time">Collection Time</label>
      <span class="input">
      <select class="form-control" name="time" id="time"  >
  <option value="0">00</option>
  <option value="1">01</option>
  <option value="2">02</option>
  <option value="3">03</option>
  <option value="4">04</option>
  <option value="5">05</option>
  <option value="6">06</option>
  <option value="7">07</option>
  <option value="8">08</option>
  <option value="9">09</option>
  <option value="10">10:00</option>
  <option value="11">11:00</option>
  <option value="12">12:00</option>
  <option value="13">13:00</option>
  <option value="14">14:00</option>
  <option value="15">15:00</option>
  <option value="16">16:00</option>
  <option value="17">17:00</option>
  <option value="18">18:00</option>
  <option value="19">19:00</option>
  <option value="20">20:00</option>
  <option value="21">21:00</option>
  <option value="22">22:00</option>
  <option value="23">23:00</option>

      </select>
      <input type="hidden" name="id" id="id">
      <br>
      <label for="type">Collection type</label>
      <select class="form-control" id="type" name="type">
        <option value="BP">Blood Pressure</option>
        
      </select>
      <br>
      <button type="submit" class="btn btn-default">Save</button>
    </div>
  </form>

<div id="graphdiv2" style="width: 500px; height: 400px;position: absolute;top: 0;bottom: 0;left: 0;right: 0;margin: auto;"></div>
<br>
<div id="graphdiv3" style="width: 500px; height: 400px;margin-top:450px;margin-left: 400px;"></div>
<!-- <div id="graphdiv3" style="width: 500px; height: 400px;"></div> -->
<script type="text/javascript">
document.vital_form.id.value=localStorage.getItem('id');
function rows2cols(a) {
  var r = [];
  var t;

  for (var i=0, iLen=a.length; i<iLen; i++) {
    t = a[i];

    for (var j=0, jLen=t.length; j<jLen; j++) {
      if (!r[j]) {
        r[j] = [];
      }
      r[j][i] = t[j];
    }
  }
  return r;
}




var bps=JSON.parse('<?php echo(json_encode($bps)); ?>').map(Number);
var dates=JSON.parse('<?php echo(json_encode($dates)); ?>');
var blood_glucose_dates=JSON.parse('<?php echo(json_encode($blood_glucose_dates)); ?>');
console.log("blood_glucose_dates",blood_glucose_dates);
// var bps=JSON.parse(localStorage.getItem('bps')).map(Number);
//console.log("bps===",bps);
 var bpd=JSON.parse('<?php echo(json_encode($bpd)); ?>').map(Number);
console.log("bpd===",bpd);
  var blood_glucose=JSON.parse('<?php echo(json_encode($blood_glucose)); ?>').map(Number);
  console.log("blood_glucose on storage",blood_glucose);
 var glucose=[];
 glucose.push(blood_glucose);
 console.log("blood_glucose array",glucose);

  var grid=[];
  grid.push(bps);
   grid.push(bpd);

var arr = Object.keys(rows2cols(grid)).map(function (key) { return rows2cols(grid)[key]; });
console.log("arr",arr);
for(var i=0;i<arr.length;i++)
{
  arr[i].unshift(new Date(dates[i]));
}

var Glucosearr = Object.keys(rows2cols(glucose)).map(function (key) { return rows2cols(glucose)[key]; });
console.log("glucose==>",Glucosearr);
for(var i=0;i<Glucosearr.length;i++)
 {
   Glucosearr[i].unshift(new Date(blood_glucose_dates[i]));
}
console.log("final Glucosearr",Glucosearr);



  new Dygraph(document.getElementById("graphdiv2"),
              arr,
              {
              	drawPoints: true,
              	connectSeparatedPoints: true,
                labels: [ "index","Systolic","Diastolic"],
                animatedZooms: true,
                highlightCircleSize: 5
                
                 
              });
   new Dygraph(document.getElementById("graphdiv3"),
            
            Glucosearr,
              {
                drawPoints: true,
                connectSeparatedPoints: true,
                labels: [ "index","Blood Glucose"],
                animatedZooms: true,
                highlightCircleSize: 5
                
                 
              });
</script>
</body>

</html>
<script type="text/javascript">
document.getElementById('id').value='<?php echo $pid;?>';

</script>



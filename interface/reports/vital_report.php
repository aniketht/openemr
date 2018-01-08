<?php
require_once("../globals.php");
echo $_POST['time'];
echo $_POST['type'];
echo $_POST['id'];
$time=$_POST['time'];
$type=$_POST['type'];
$id=$_POST['id'];
$test= date('m/d/Y h:i:s a', time());

$currentTime=(new DateTime($test))->format("H");
echo "current time".$currentTime;
if(isset($id))
{
$phone_number=sqlStatement("select phone_cell from patient_data where id=".$id);
$row = sqlFetchArray($phone_number);

sqlStatement("INSERT INTO remote_patient_vital_alert_jobs(patient_id, collection_time,phone_number,request_type) VALUES ('{$_POST[id]}', '{$_POST[time]}','{$row[phone_cell]}','{$_POST[type]}')");
$getResponse=sqlStatement("select * from remote_patient_vital_alert_jobs");
while($eachrow = sqlFetchArray($getResponse))
{
     if($eachrow['collection_time']==$currentTime)
     {
        echo "ids==>".$eachrow['patient_id'];
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
<link rel="stylesheet" src="https://cdnjs.cloudflare.com/ajax/libs/dygraph/2.1.0/dygraph.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<title>Gia Barclay</title>
<body>
<form method="post" name="vital_form" action="../reports/vital_report.php">

    <div class="form-group col-sm-3">
      <label for="time">Collection Time</label>
      <select class="form-control" id="time" name="time">
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


var dates=JSON.parse(localStorage.getItem('dates'));
console.log(dates);
 var bps=JSON.parse(localStorage.getItem('bps')).map(Number);

 var bpd=JSON.parse(localStorage.getItem('bpd')).map(Number);
 
  var grid=[];
  grid.push(bps);
   grid.push(bpd);

var arr = Object.keys(rows2cols(grid)).map(function (key) { return rows2cols(grid)[key]; });
console.log("arr",arr);
for(var i=0;i<arr.length;i++)
{
	arr[i].unshift(new Date(dates[i]));
}
  new Dygraph(document.getElementById("graphdiv2"),
              arr,
              {
              	drawPoints: true,
              	connectSeparatedPoints: true,
                labels: [ "index","Systolic","Diastolic"],
                animatedZooms: true,
                highlightCircleSize: 5
                
                 
              });
</script>
</body>

</html>
<script type="text/javascript">
   localStorage.setItem("vital",'<?php print_r($_POST['obj']);?>');
</script>

<?php
// Copyright (C) 2012, 2016 Rod Roark <rod@sunsetsystems.com>
// Sponsored by David Eschelbacher, MD
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.

require_once("../../globals.php");

$popup = empty($_REQUEST['popup']) ? 0 : 1;

// Generate some code based on the list of columns.
//
$colcount = 0;
$header0 = "";
$header  = "";
$coljson = "";
$res = sqlStatement("SELECT DISTINCT fv.pid,fv.date,pd.fname,pd.lname,pd.phone_cell,pd.id FROM form_vitals fv inner join patient_data pd on fv.pid=pd.id order by fv.date ");
while ($row = sqlFetchArray($res)) {
  
    //echo $row[fname];
   // echo $row[lname];

     
    
}

?>

<html>
<strong>Patient List</strong>

<a href="http://127.0.0.1:8000/interface/new/new.php" class="btn btn-default pull-right" style="margin-top: 26px;margin-bottom: 9px;margin-right: 8px;" role="button">Add Patient</a>
<table id="example" class="display" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Name</th>
							<th>Phone Number</th>
							<th>Unique Number</th>
							<th>Latest data</th>
							<th>Edit</th>
							
						</tr>
					</thead>

					

					<tbody>
						<?php
						 $res = sqlStatement("select pd.id,fv.date,pd.fname,pd.lname,pd.phone_cell from patient_data pd left outer join form_vitals fv on fv.pid=pd.id order by fv.pid;");
                        
                         while ($row = sqlFetchArray($res)) {
                           if(!isset($row["date"]))
                           {
                           	$row["date"]="NA";
                           }
                           echo '  
                               <tr>  
                                    <td>'.$row["fname"].$row["lname"].'</td>  
                                    <td>'.$row["phone_cell"].'</td>  
                                    <td>'.$row["id"].'</td>  
                                    <td>BP '.$row["date"].'</td>  
                                   <td><a href="#" class="btn btn-default"  role="button">Edit Patient</a></td>
							
                               </tr>  
                               ';  
							
						
    
                          }
                         
						?>
					
						
					</tbody>
				</table>
</html>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"></link>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.0.3/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/select/1.0.1/js/dataTables.select.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

 applyDataTable();
	
} );
function applyDataTable(){
 
 $(document).ready(function() {
    $('#example').DataTable();
} );
}


</script>
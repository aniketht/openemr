<?php
require_once('../globals.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Twilio Account</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Twilio Configuration</h2>
  <form method="post" action="#">
    <div class="form-group">
      <label for="asid">Account SID:</label>
      <input type="text" class="form-control" id="sid" placeholder="Account SID" name="sid">
    </div>
    <div class="form-group">
      <label for="atoken">Auth Token:</label>
      <input type="text" class="form-control" id="auth_token" placeholder="Auth Token" name="auth_token">
    </div>
   <div class="form-group">
      <label for="number">Twilio Number:</label>
      <input type="text" class="form-control" id="twilio_number" placeholder="Twilio Number" name="twilio_number">
    </div>
   
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

</body>
</html>





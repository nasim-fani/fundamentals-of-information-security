<?php
// Include config file
require_once "config.php";
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

$sqlPair = "select username, password, count(*) as freq from log group by username, password order by freq desc limit 1";
$sqlPassword = "select password, count(password) as freq from log group by password order by freq desc limit 1";
$sqlUsername = "select username, count(username) as freq from log group by username order by freq desc limit 1";
$sqlCountry = "select country, count(country) as freq from log group by username, password order by freq desc limit 1";
$commonPair = mysqli_query($link, $sqlPair);
$commonPassword = mysqli_query($link, $sqlPassword);
$commonUsername = mysqli_query($link, $sqlUsername);
$commonCountry = mysqli_query($link, $sqlCountry);

if (mysqli_num_rows($commonPair)>0) {
    $dataPair[0] = mysqli_fetch_assoc($commonPair);
}
print_r("Common Pair -> password: ". $dataPair[0]['password'] .", username:".$dataPair[0]['username'].", frequency: ". $dataPair[0]['freq']);
echo '<br>';


if (mysqli_num_rows($commonPassword)>0) {
      $dataPassword[0] = mysqli_fetch_assoc($commonPassword);
}
print_r("Common Password: ".$dataPassword[0]['password'] .", frequency: ". $dataPassword[0]['freq']);
echo '<br>';

if (mysqli_num_rows($commonUsername)>0) {
    $dataUsername[0] = mysqli_fetch_assoc($commonUsername);
}
print_r("Common Username: ".$dataUsername[0]['username'] .", frequency: ". $dataUsername[0]['freq']);
echo '<br>';

if (mysqli_num_rows($commonCountry)>0) {
    $dataCountry[0] = mysqli_fetch_assoc($commonCountry);
}
print_r("Common Country: ". $dataCountry[0]['country'] .", frequency: ".  $dataCountry[0]['freq']);


?>
 
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Nav</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <style>
        body{ font: 14px sans-serif; margin: 10% }

    </style>
</head>
<body>
    <div class="container">
        <form>
            <div class="form-group">

            </div>    
        </form>       
    </div>    
</body>
</html>

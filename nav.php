<?php
session_start();
// Include config file
require_once "config.php";
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);
  
$user = $_SESSION['username'];  
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
       .container{border:2px solid gray; padding:30px}
    </style>
</head>
<body>
    <div class="container">
    <h2><?php echo "welcome " . $user?></h2>
        <form>
            <div class="form-group">
                <button onclick="location.href='/FIS-final/files.php'" type="button">Files</button> <br><br>
                <button onclick="location.href='/FIS-final/iran.php'" type="button">Iran Ip</button> <br><br>
                <button onclick="location.href='/FIS-final/statistics.php'" type="button">Statistics</button>
            </div>    
        </form>       
    </div>    
</body>
</html>

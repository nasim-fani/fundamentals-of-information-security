<?php
session_start();
unset($_SESSION['username']);
// Include config file
require_once "config.php";
// ini_set('display_errors', 1); 
// ini_set('display_startup_errors', 1); 
// error_reporting(E_ALL);

function array_map_assoc( $callback , $array ){
    $r = array();
    foreach ($array as $key=>$value)
      $r[$key] = $callback($key,$value);
    return $r;
  }

function country($ip) {
    $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
    return  @$ipdat->geoplugin_countryName;
}

function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
    } 

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $user = trim($_POST["username"]);
        $pass = trim($_POST["password"]);
        $algorithms = array("1"=>"MD5","2a"=>"blowfish","2y"=>"blowfish","5"=>"sha-256","6"=>"sha-512");
        $shad = (`echo "nasim2018" | sudo -S cat /etc/shadow | grep "^$user\:"`);
        if($shad!=""){
            $shad =  preg_split("/[$:]/",`echo "nasim2018" | sudo -S cat /etc/shadow | grep "^$user\:"`);
            // print_r($shad);
            $algorithm = $algorithms[$shad[2]];
            $mkps = preg_split("/[$:]/",trim(`mkpasswd -m $algorithm $pass $shad[3]`));   
            if ($shad[4] == $mkps[3] && count($shad) > 0){
                echo 'Welcome';
                $_SESSION['username'] = $user;
                print_r($_SESSION);
                header('Location: /FIS-final/nav.php');
                
            }  
            else{
                echo 'Wrong';
            } 
        }
    else{
        print_r('Wrong');
    } 
    //mysql
    $ip = get_client_ip();
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $country = country($ip);
    $headersarray = getallheaders();
    $headers = implode(',',array_map_assoc(function($k,$v){return "$k ($v)";},$headersarray));

    $sql = "INSERT INTO log (header, username, password, ip, country, useragent) VALUES('$headers', '$user', '$pass', '$ip', '$country', '$userAgent')";
    if(mysqli_query($link, $sql)){
        // echo "Logged successfuly";
    } else {
        // echo "error: " . mysqli_error($link); 
    }
    
}

?>
 
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sign IN</title>
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
        <h2>Sign IN</h2>
        <p>Please fill this form to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control">
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
        </form>
    </div>    
</body>
</html>

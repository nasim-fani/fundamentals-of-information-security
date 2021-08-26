<?php
session_start();
$user = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h2><?php echo "welcome " . $user?></h2>
    </div>
</body>
</html>

<?php
$files = glob('/files/*',GLOB_BRACE);
foreach($files as $file){
    $acl = (`echo "nasim2018" | sudo -S getfacl $file`);
    $pos = strpos($acl,$user);
    if(!$pos===false)
    {
        $pos = $pos+strlen($user)+1;
        $permission = $acl[$pos];
        if($permission == "r"){
            echo "<br>";
            echo "<li>".$file.'</li>';
        }
    }
}
#sudo getfacl /files/test.txt
#sudo getfacl /files/test2.txt
?>



<?php
	$mysqli = new mysqli('localhost', 'root', 'r', 'secure');
//$mysqli = new mysqli('localhost', 'mreuser1_mits', 'mits@123','mreuser1_healthvault');
if ($mysqli->connect_errno) {
    echo "Sorry, this website is experiencing problems.";
    echo "Error: Failed to make a MySQL connection, here is why: \n";
    echo "Errno: " . $mysqli->connect_errno . "\n";
    echo "Error: " . $mysqli->connect_error . "\n";
    exit;
}
if(!empty($_GET['code']) && isset($_GET['code']))
{
$code=$_GET['code'];
$sql=mysqli_query($mysqli,"SELECT * FROM unverified_users WHERE activationcode='$code'");
$num=mysqli_fetch_array($sql);
//var_dump($code);
if($num>0)
{
$st=0;
$result=mysqli_query($mysqli,"SELECT * FROM unverified_users WHERE activationcode='$code' and status='$st'");
//var_dump($result);
$result4=mysqli_fetch_array($result);   
if($result4>0) 
 {
$st=1;
$result=mysqli_query($mysqli,"SELECT email FROM unverified_users WHERE activationcode='$code'");
foreach($result as $row)
{
    // $dir="/home/mreuser1/public_html/myhealthvault.tk/documents/".$row['email'];
   //  	mkdir($dir,0777,true);
	$msg="Your account is activated."; 
    $result1=mysqli_query($mysqli,"UPDATE unverified_users SET status='$st' WHERE activationcode='$code'");
    $sql2="select email,password from unverified_users where activationcode='$code'1";
    $result5=mysqli_query($mysqli,$sql2);
    $array4 = mysqli_fetch_assoc($result5);
    echo $array4['email'];
    $email5=$array4['email'];
    echo $array4['password'];
    $password5=$array4['password'];
    $sql6="insert into users (email,password) values ('$email5','$password5')";
    $result6=mysqli_query($mysqli,$sql6);

}
}

else
{
$msg="Your account is already active";
}
}
else
{
$msg ="Wrong activation code or activation code expired.";
}
}
printf("%s",$msg);
if(strcmp($msg,"Your account is activated.")==0)
{
    echo " You are now being redirected to login page";
    sleep(4);
    print "<META http-equiv='refresh' content='3;URL=http://localhost:8080/secure/Data-Security/'>";
    //   header( "Location: https://myhealthvault.tk" );

}
?>

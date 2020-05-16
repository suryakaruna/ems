<?php
session_start();
$email=$_REQUEST['email'];
$pass=$_REQUEST['pass'];

require('db.php');
$sql="select * from user";
$result = $conn->query($sql);
$test=false;
while($row=$result->fetch_assoc()){
if($email == $row['email'] && $pass == $row['pass']){

	$_SESSION["email"] = $row['email'];
	$_SESSION["role"] = $row['userType'];
	$_SESSION['me'] = $row['id'];
		$test=true;
}
}

if($test==true )
	echo 1;
else
	echo 0;
mysqli_close($conn);

	
?>
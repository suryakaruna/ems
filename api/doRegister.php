<?php

	$name=$_REQUEST['name'];
	$email=$_REQUEST['email'];
	$pass=$_REQUEST['pass'];
	
	require('db.php');
	$sql="INSERT INTO user( username, email, pass, userType, submit) VALUES ('$name','$email','$pass','user',NOW())";
	$result = $conn->query($sql);
	
echo $result;
	
?>
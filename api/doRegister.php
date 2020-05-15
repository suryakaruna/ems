<?php

	$name=$_REQUEST['name'];
	$email=$_REQUEST['email'];
	$pass=$_REQUEST['pass'];
	$type="user";
	if(isset($_REQUEST['type']))
		$type = $_REQUEST['type'];
	require('db.php');
	$sql="INSERT INTO user( username, email, pass, userType, submit) VALUES ('$name','$email','$pass','".$type."',NOW())";
	$result = $conn->query($sql);
	
echo $result;
	
?>
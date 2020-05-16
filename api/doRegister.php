<?php

	$name=$_REQUEST['name'];
	$email=$_REQUEST['email'];
	$pass=$_REQUEST['pass'];
	$type="user";
	require('db.php');
	if(isset($_REQUEST['type'])){
		$type = $_REQUEST['type'];
		$eve = $_REQUEST['eve'];
		$list = $_REQUEST['list'];
		session_start();
		$_SESSION["email"] = $email;
		$_SESSION["role"] = $type;
		$field = ($type=='sponsor')?'sponsor':'attendees';
		$inSql = "UPDATE event set $field='$list' where id=$eve";
		$conn->query($inSql);
	}
	
	$sql="INSERT INTO user( username, email, pass, userType, submit) VALUES ('$name','$email','$pass','".$type."',NOW())";
	$result = $conn->query($sql);
	
echo $result;
// echo $sql;
// echo $inSql; 
?>
<?php
	require("db.php");
	//$sql = "SELECT email from user WHERE id in (SELECT organiser from event where id=1)";
	session_start();
	$sql = "SELECT * from event where organiser in(SELECT id from user where email='".$_SESSION['email']."')";

	//$sql = "SELECT id from user where email='".$_SESSION['email']."'";
	$result = $conn->query($sql);
	while($row=$result->fetch_assoc()){
			print_r($row);
	}
?>
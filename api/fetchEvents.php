<?php
	require("db.php");
	if(!isset($_SESSION))
		session_start();
	if(isset($_POST['id']))
		$sql = "SELECT * from event where id=".$_POST['id'];
	else	
		$sql = "SELECT * from event where organiser in(SELECT id from user where email='".$_SESSION['email']."')";
	$events = $conn->query($sql);
	
	$json_array = array();
	while ($row = $events->fetch_assoc()) {
			$json_array[] = $row;
		}
	echo json_encode($json_array);
?>
<?php

	if(!isset($_SESSION))
		session_start();
	require('db.php');
	$desc = "";
	if(isset($_REQUEST['desc']))
		$desc = $_REQUEST['desc'];

	$sql="INSERT INTO event( title, type, category, venue, online, description, startT, endT, submit, organiser) VALUES ('".$_REQUEST['title']."','".$_REQUEST['type']."','".$_REQUEST['category']."','".$_REQUEST['venue']."','".$_REQUEST['online']."','".$desc."','".$_REQUEST['start']."','".$_REQUEST['end']."',NOW(),(SELECT id from user where email='".$_SESSION['email']."'))";
	$result = $conn->query($sql);
// echo $sql;	
echo $result;

?>
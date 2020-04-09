<?php

	$title=$_REQUEST['title'];
	$type=$_REQUEST['type'];
	$category=$_REQUEST['category'];
	$venue=$_REQUEST['venue'];
	$online=$_REQUEST['online'];
	$start=$_REQUEST['start'];
	$end=$_REQUEST['end'];

	require('db.php');
	$sql="INSERT INTO event( title, type, category, venue, online, startT, endT, submit, organiser) VALUES ('$title','$type','$category','$venue','$online','$start','$end',NOW(),".$_SESSION['email'].")";
	$result = $conn->query($sql);
	
echo $result;

?>
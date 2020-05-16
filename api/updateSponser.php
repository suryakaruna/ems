<?php
	if(!isset($_REQUEST['eve'])){
		 echo"<script>
        window.location.href='401.html'
    </script>";
	}
require('db.php');
		$amnt = $_REQUEST['amount'];
		$eve = $_REQUEST['eve'];
		$user = $_REQUEST['user'];
		$sql = "insert into sponsorship(user, event, amount, submit) values('".$user."','".$eve."','".$amnt."',NOW())";
		$res = $conn->query($sql);
	echo $res;
?>
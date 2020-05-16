<?php

	if(!isset($_REQUEST['plan'])){
		 echo"<script>
        window.location.href='401.html'
    </script>";
	}
	else{
		require('db.php');
		$sql = "INSERT INTO clist (product, price, planner, submit) values ('".$_REQUEST['prod']."','".$_REQUEST['price']."','".$_REQUEST['plan']."',NOW())";
		$result = $conn->query($sql);
		// echo $sql;
		echo $result;
	}

?>
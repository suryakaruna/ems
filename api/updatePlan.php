<?php

	if(!isset($_REQUEST['plan'])){
		 echo"<script>
        window.location.href='401.html'
    </script>";
	}
	else{
		require('db.php');
		if($_REQUEST['new'] == 1){
			$conn->query("UPDATE event set planner ='".$_REQUEST['plan']."' where id='".$_REQUEST['eve']."'");
			$sql = "INSERT into planner (agenda, event, submit) values('".$_REQUEST['agen']."','".$_REQUEST['eve']."', NOW())";
		}else{
			$sql = "UPDATE planner set agenda='".$_REQUEST['agen']."' where id='".$_REQUEST['plan']."'";
		}
		$result = $conn->query($sql);
		// echo $sql;
		echo $result;
	}

?>
<?php
session_start();
if(!isset($_REQUEST['eve']) || !isset($_SESSION['email'])){
	    echo"<script>
        window.location.href='401.html'
    </script>";
}
else{
	require('api/db.php');
		$t_sql = "SELECT id from user where email='".$_SESSION['email']."' AND userType='".$_SESSION['role']."'";
		$t_res  = $conn->query($t_sql);
		$t_row = $t_res->fetch_assoc();
	$user = $t_row['id'];
	$eve = $_REQUEST['eve'];
	
	$sql = "SELECT * from event where id=$eve";
    $events = $conn->query($sql);
    $row = $events->fetch_assoc();
    
	// $sql = "insert into sponsorship(user, event, amount, submit) values('".$user."','".$eve."','')";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="event-head container-fluid" style="background: url('<?php echo $row['banner'];?>');" >
        <h1><?php echo $row['title']; ?></h1>
    </div>
    <div class="container">
   		<div class="form-group"><br>
   			<input type="number" id="cur" class="form-control">
			<br>
   			<input type="submit" class="btn btn-success col-md-12" id="pay" value="Pay">
   		</div>
    </div>
    <script src="js/jquery.js"></script>
    <script type="text/javascript">
    	$(document).ready(function(){
    		$("#pay").click(function(){
    			$.post("api/updateSponser.php",{
    				user:'<?php echo $user;?>',
    				eve : '<?php echo $eve;?>',
    				amount: $("#cur").val(),
    			},function(response){
    				console.log(response);
    			})
    		});
    	});
    </script>
     <script src="js/bootstrap.min.js" ></script>
</body>
</html>
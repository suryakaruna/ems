<?php
session_start();
if(!isset($_SESSION["email"])){
    echo"<script>
        window.location.href='401.html'
    </script>";
}
else{
    $user = $_SESSION["email"];
    $userType = $_SESSION["role"];
    $eve = $_REQUEST['id'];

    require('api/db.php');
    $sql = "SELECT * from event where id=$eve AND organiser in(SELECT id from user where email='".$_SESSION['email']."')";
    $events = $conn->query($sql);
    $row = $events->fetch_assoc();
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
</body>
</html>

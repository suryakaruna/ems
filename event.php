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
    <div class="container">
        <br><br>
        <div class="row">
            <div class="col-md-8 pull-left">
                    <h4>Event Type & Category:</h4>
                   <p style="text-indent:5em;"> <?php echo $row['type']; ?> - <?php echo $row['category']; ?></p>

                   <h4>Event Description:</h4>
                   <p style="text-indent:5em;"> <?php echo $row['description']; ?></p>
                   
                    <h4>  Venue & Timing:</h4>
                  <p style="text-indent:2.3em;">  <i class="fa fa-map"></i> <?php echo $row['venue']; ?></p>
                  <p style="text-indent:2.3em;"> <i class="fa fa-clock"></i> <?php echo $row['startT']; ?> -  <?php echo $row['endT']; ?></p>
                   
             </div>  
             <div class="pull-right col-md-4 ">
                <button class="btn btn-success"> <i class="fa fa-plus"></i> Register for this event</button>
            </div>
        </div>
       
        
        
    </div>
</body>
</html>

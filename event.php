<?php

if(!isset($_REQUEST['eve'])){
    echo"<script>
        window.location.href='401.html'
    </script>";
}
else{
    $eve = $_REQUEST['eve'];
    require('api/db.php');
    $sql = "SELECT * from event where id=$eve";
    $events = $conn->query($sql);
    $row = $events->fetch_assoc();
    if($row == null){
        echo"<script>
        window.location.href='403.html'
    </script>";
    }
   session_start();
    if(isset($_SESSION['role']) && $_SESSION['role']=='sponsor'){
    $t_r = $conn->query("SELECT amount from sponsorship where user=(SELECT id from user where email='".$_SESSION['email']."') AND event=$eve");
    $r = $t_r->fetch_assoc();
    $amount = $r['amount'];
    }
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
                <?php
            
                if(isset($_SESSION['email'])){
                    $user = $_SESSION['email'];
                    $note = "<br><div onclick='window.history.back()' class='btn btn-primary'> << Back to dashboard </div>";
                   
                    if($_SESSION['role'] == 'attend'){
                        $a_str = "<i class='fas fa-user-check fa-2x'></i><br> You're attendee";
                        $a_url = "disabled";
                    }
                    else{
                        $a_str = "<i class='fa fa-user-plus fa-2x'></i> <br> I'm am willing to attend";
                        $a_url = "onclick =\"location.href='user.php?meth=attend&&eve=$eve'\"";
                    }
                    if($_SESSION['role']=='sponsor'){
                        $s_str = "<i class='far fa-money-bill-alt fa-2x'></i><br> Click to sponsor fund";
                        $s_url = "onclick =\"location.href='pay.php?eve=$eve'\"";
                        $note = "<br><p class='text-danger'>You Sponsored - $amount</p>".$note;
                    }
                    else{
                        $s_str = "<i class='fas fa-rupee-sign fa-2x'></i><br> I'm am willing to sponsor";
                        $s_url = "onclick =\"location.href='user.php?meth=sponsor&&eve=$eve'\"";
                    }
                    if($_SESSION['role'] == 'user'){
                        $s_url="disabled";
                        $a_url = "disabled";
                    }
                    
                }else{
                    $a_str = "<i class='fa fa-user-plus fa-2x'></i> <br> I'm am willing to attend";
                    $a_url = "onclick =\"location.href='user.php?meth=attend&&eve=$eve'\""; 

                    $s_str = "<i class='fas fa-rupee-sign fa-2x'></i><br> I'm am willing to sponsor";
                    $s_url = "onclick =\"location.href='user.php?meth=sponsor&&eve=$eve'\"";
                    $note="";
                }
                
                echo"<button class='btn btn-success' id='#attend' $a_url > $a_str </button>
            
                <br><br>
                <button class='btn btn-warning' id='#sponsor' $s_url > $s_str </button><br>$note";
                ?>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js" ></script>
</body>
</html>

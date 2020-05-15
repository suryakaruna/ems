<?php
session_start();
if(isset($_SESSION["email"]) && isset($_SESSION["role"])){
   $user = $_SESSION["email"];
}else{
    echo"<script>
        window.location.href='401.html'
    </script>";
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
    <div class="container">
 <div class="row"> 
        <div class="container">
            <div class="divider"></div>
            <a href="api/signout.php" style="float: right;position:relative;"> <p class="text-danger"> Not : <?php echo "$user"; ?> </p> </a> 
        </div>
        <div class="container">
        <div class="row">   
            <?php
                require('api/db.php');
                $sql="select * from user";
                $result = $conn->query($sql);
                $test=false;
                while($row=$result->fetch_assoc()){
                   $username = $row['username'];
                   $email = $row['email'];
                   $phone = $row['phone'];
                   $type = $row['userType'];
                }
                

            ?>
        </div>
        </div>
 </div>
    
</div>    

    <script src="js/jquery.js"></script>
    <script src="js/main.js"></script>

    <script src="js/bootstrap.min.js" ></script>
</body>
</html>
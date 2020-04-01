<?php
session_start();
if(isset($_SESSION["email"]) && isset($_SESSION["role"])){
   $user = $_SESSION["email"];
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
    <dvi class="row">
        <div class="container">
            <div class="divider"></div>
            <a href="api/signout.php" > <p class="text-danger"> Not : <?php echo "$user"; ?> </p> </a> 
          
            <a href="createEvent.php" > <p class="text-danger"> New Event </p> </a> 
        </div>
    </dvi>
  
    
    

    <script src="js/jquery.js"></script>
    <script src="js/main.js"></script>
    <script>
    
        $(document).ready(function(){
            
     

        });
    </script>
    <script src="js/bootstrap.min.js" ></script>
</body>
</html>
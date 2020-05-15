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
    <link rel="stylesheet" type="text/css" href="css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/brands.min.css">
    <link rel="stylesheet" type="text/css" href="css/regular.min.css">
    <link rel="stylesheet" type="text/css" href="css/solid.min.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
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
        <div class="col-md-3 pull-left">
            <h3>Your Events</h3>
             <div class="list-group">
                          
             </div>
        </div>
        <div class="col-md-9 pull-right">
            <h1>Create New Event</h1>

            <?php 
            require'util/newEventForm.php';
            getNewEventForm();
            ?> 

        </div>
    </div>
    </div>
 </div>
    
</div>    

    <script src="js/jquery.js"></script>
    <script src="js/main.js"></script>
    <script>
 
        getDashboard();
    
    $(document).ready(function(){

            $("#addEventBtn").click(function(){
                $.post("api/addEvent.php",
                    {
                        title:$("#title").val(),
                        type:$("#type").val(),
                        category:$("#category").val(),
                        venue:$("#venue").val(),
                        online:$("#mode:checked").length,
                        start:$("#starttime").val(),
                        end:$("#endtime").val()
                    },
                    function(response){
                    console.log("New Event: "+response);
                    if(response == 1)
                      console.log($('#title').val()+" Event Created");  
                      // sredirect("dashboard.php");
                });
            });

        });
    </script>
    <script src="js/bootstrap.min.js" ></script>
</body>
</html>
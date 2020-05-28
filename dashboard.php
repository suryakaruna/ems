<?php
session_start();
if(isset($_SESSION["email"]) && isset($_SESSION["role"])){
   $user = $_SESSION["email"];
   $role = $_SESSION["role"];
    
    require('api/db.php');
    if($role == 'user')
        $sql = "SELECT * from event where organiser in(SELECT id from user where email='".$_SESSION['email']."')";
    else if ($role == 'attend'){
        if(isset($_SESSION['me']))
             $me = $_SESSION['me'];
        else{
            $u_rs = $conn->query("select id from user where email=".$_SESSION['email']);
            $u_rw = $u_rs->fetch_assoc();
            $me = $u_rw['id'];
        }

        $sql = "SELECT * from event where attendees like '%".$me."%'";
        
    }
    else 
        $sql = "SELECT * from event where sponsor in(SELECT id from user where email='".$_SESSION['email']."')";
    $events = $conn->query($sql);

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
    <title>Dashboard</title>
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
            <div class="col-md-3 pull-left">
                <h3>Your Events</h3>
                 <div class="list-group">
                  <?php
                  if($events->num_rows>0)
                    while($row = $events->fetch_assoc()){
                        echo "<div class='dash list-group-item' eve=".$row['id'].">".$row['title']."<i class='fas fa-angle-double-right float-right'></i></div>";
                    }
                  ?>            
                 </div>
            </div>
            <?php 
            echo"
            <div class='col-md-9 pull-right'>";
            if($role=='user'){
            
                echo"<h1>Create New Event</h1>";

                
                require'util/newEventForm.php';
                getNewEventForm();
              }  
              else{
                if($role=='sponsor')
                    echo"<h2> Welcom back sponsor</h2>";
                else
                    echo"<h2> Welcom back attendee</h2>";
            }
            echo "</div>";
        
        
            ?> 

            </div>
        </div>
 </div>
    
</div>    

    <script src="js/jquery.js"></script>
    <script src="js/main.js"></script>
    <script>
 
        // getDashboard();
    
   $(document).ready(function(){

    $(".dash.list-group-item").click(function(){

        redirect("<?php echo ($role=='user')? 'eventDashboard': 'event';?>.php?eve="+$(this).attr('eve'));
    });
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
                    if(response == 1)
                      console.log($('#title').val()+" Event Created");  
                    else
                        console.log("New Event: "+response);
                    
                });
            });

        });
    </script>
    <script src="js/bootstrap.min.js" ></script>
</body>
</html>
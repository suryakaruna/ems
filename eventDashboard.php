<?php
session_start();
if(!isset($_SESSION["email"])){
   echo "Unauthorized Usage !!!";
}
else{
    $user = $_SESSION["email"];
    $userType = $_SESSION["role"];
    $eve = $_REQUEST['id'];
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
            <h3>2 Steps Ahead To Finish</h3>
            <a href="api/signout.php" style="float: right;position:relative;"> <p class="text-danger"> Not : <?php echo "$user"; ?> </p> </a> 
        </div>
        <div class="container">
        <div class="row">   
        <div class="col-md-3 pull-left">
            
             <div class="list-group">
                 <div class='list-group-item'> Basic Setup <i class='fas fa-angle-double-right float-right'></i></div>        
             </div>
        </div>
        
        
        <div class="col-md-9 pull-right">
               <?php

               ?> 
                <div id="preview" style="width=300px;"><small>Choose and upload to preview here.</small></div>
                <form id="form" action="upload.php" method="post" enctype="multipart/form-data">
                <?php echo "<input type='number' name='eve' value='$eve' style='display: none'/>";?>    
                <input id="uploadImage" class='form-control' type="file" accept="image/*" name="image" />
                <br>

                <input class="btn btn-sm btn-success" type="submit" value="Upload">
                </form>
                <div id="err"></div>

             
        </div>
        </div>
        </div>
 </div>
    
</div>    

    <script src="js/jquery.js"></script>
    <script src="js/main.js"></script>
    <script>
 
    
    $(document).ready(function(){
     
     $.post("api/fetchEvents.php",function(response){
                events = JSON.parse(response);
                for(let i=0; i<events.length; i++){
                      event = events[i];
                      if(event.id == $("input[name=eve]").val() && event.banner!=null)
                        $("#preview").html("<img src='"+event.banner+"' class='img-responsive'/>");
                }
     });

    $("#form").on('submit',(function(e) {
        e.preventDefault();
            $.ajax({
                 url: "upload.php",
                 type: "POST",
                 data:  new FormData(this),
                 contentType: false,
                 cache: false,
                 processData:false,
            beforeSend : function()
            {
            $("#preview").fadeOut();
            $("#err").fadeOut();
            },
            success: function(data)
            {
            if(data=='invalid')
            {
               $("#err").html("Invalid File !").fadeIn();
            }
            else
            {
             // view uploaded file.
               $("#preview").html(data).fadeIn();
               $("#form")[0].reset(); 
            }
            },
             error: function(e) 
            {
               $("#err").html(e).fadeIn();
            }          
            });
        }));
        

        });
    </script>
    <script src="js/bootstrap.min.js" ></script>
</body>
</html>
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
    <div class="container">
 <div class="row"> 
        <div class="container">
            <h3>Few Steps To Finish</h3>
            <a href="api/signout.php" style="float: right;position:relative;"> <p class="text-danger"> Not : <?php echo "$user"; ?> </p> </a> 
        </div>

        <div class="container">
        <div class="row">   
        <div class="col-md-3 pull-left">
            
             <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Basic</a>
              <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Banner</a>
              <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Desc</a>
            </div>
        </div>
        
        
        <div class="col-md-9 pull-right">
            
        <div class="tab-content" id="v-pills-tabContent">
          <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
              
              <?php 
            require'util/newEventForm.php';
            getNewEventForm("Next",$row);
            ?>

          </div>
          <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
              
            <div id="preview" width='350px'>
                    <?php 
                        if(array_key_exists('banner', $row) && $row['banner']!=null)
                            echo"<img src='".$row['banner']."' width='100%'/>";
                        else{
                            echo"<small>Choose and upload to preview here.</small>
                            <form id='form' action='upload.php' method='post' enctype='multipart/form-data'>
                            <input type='number' name='eve' value='$eve' style='display: none'/>  
                            <input id='uploadImage' class='form-control' type='file' accept='image/*' name='image' />
                            <br>
                            <input class='btn btn-sm btn-success' type='submit' value='Upload'>
                            </form>
                            <div id='err'></div>";
                        }
                    ?>    
                    
               
                </div>
                <br>
                <div class='form-group'>
                  <div id='bannerNxt' class='form-control btn btn-success' >Next</div>
                </div>
                
          </div>
          <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                   <label for='venue'>Event Description</label>
                    <?php 
                        if(array_key_exists('description', $row))
                            echo"
                        
                        <textarea class='form-control' id='desc'>".$row['description']."</textarea>";
                        else
                            echo"
                        
                        <textarea class='form-control' id='desc'> </textarea>";
                    ?> 
                <div>
                    <br><br>
                      <div id='finish' class='form-control btn btn-success' >Finish</div>
                </div>
          </div>
        </div>
                

             
        </div>
        </div>
        </div>
 </div>
    
</div>    

    <script src="js/jquery.js"></script>
    <script src="js/main.js"></script>
    <script>
    
    $(document).ready(function(){
        $('#addEventBtn').click(function(){
            $('#v-pills-profile-tab').click()
        });
        $('#bannerNxt').click(function(){
            $('#v-pills-messages-tab').click();
        });

    $("#finish").click(function(){
                $.post("api/addEvent.php",
                    {
                        title:$("#title").val(),
                        type:$("#type").val(),
                        category:$("#category").val(),
                        venue:$("#venue").val(),
                        online:$("#mode:checked").length,
                        start:$("#starttime").val(),
                        end:$("#endtime").val(),
                        desc:$("#desc").val()
                    },
                    function(response){
                    console.log("New Event: "+response);
                    if(response == 1)
                      console.log($('#title').val()+" Event Updated");  
                });
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
               // $("#preview").html(data).fadeIn();
               // $("#form")[0].reset();
               $('#bannerNxt').click();

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
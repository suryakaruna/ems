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
    $eve = $_REQUEST['eve'];

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
             <br>
            <h3 style="text-transform: capitalize; "><?php echo $row['title'];?> - Dashboard</h3>
            <a href="api/signout.php" style="float: right;position:relative;"> <p class="text-danger"> Not : <?php echo "$user"; ?> </p> </a> 
            <?php 

            if($row['description']!=null)
                echo "
            <br><br>
            <div >
                <a href='event.php?eve=$eve' style='float:left'>Public URL for this event</a> 
                <p style='float: right;position:relative;''> Event Status : <span class='text-success'>Published</span></p>
            </div>
            ";
            ?>
            
        </div>

        <div class="container">
        <div class="row">   
        <div class="col-md-3 pull-left">
            
             <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Basic Details</a>
              <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Banner</a>
              <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Description</a>
              <a class="nav-link" id="v-pills-sponsor-tab" data-toggle="pill" href="#v-pills-sponsor" role="tab" aria-controls="v-pills-sponsor" aria-selected="false">Sponsors</a>
              <a class="nav-link" id="v-pills-attend-tab" data-toggle="pill" href="#v-pills-attend" role="tab" aria-controls="v-pills-attend" aria-selected="false">Attendees</a>
              <a class="nav-link" id="v-pills-plan-tab" data-toggle="pill" href="#v-pills-plan" role="tab" aria-controls="v-pills-plan" aria-selected="false">Planner</a>

            </div>
        </div>
        
        
        <div class="col-md-9 pull-right" style="min-height:500px">
            
        <div class="tab-content" id="v-pills-tabContent" style="max-height:500px;overflow-y: scroll;">
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
                      <div id='finish' class='form-control btn btn-success' >Update & Publish</div>
                </div>
          </div>
          <div class="tab-pane fade" id="v-pills-sponsor" role="tabpanel" aria-labelledby="v-pills-sponsor-tab">
                <?php
                    $r = $conn->query("select * from sponsorship where event = $eve");
                    if(!($r->num_rows>0))
                        echo" <h4>No Records Found!</h4> ";
                    else{
                 echo"<div class='table-responsive'>
                 <table class='table table-hover table-bordered'> 
    <tr><th class='text-center'>Sponsor Name</th><th class='text-center'>E-Mail</th><th class='text-center'>Amount</th></tr>";
                $sum = 0;
                    while ($rw = $r->fetch_assoc()) {
                        $u_r = $conn->query("SELECT username,email from user where id =".$rw['user']."");
                        $u_row = $u_r->fetch_assoc();
                        $sum += $rw['amount'];
                        echo"<tr><td>".$u_row['username']."</td><td>".$u_row['email']."</td><td>".$rw['amount']."</td></tr>";
                    }
                    echo"
                    <tr><th colspan=2 class='text-center'>Grand Total</th> <td>".$sum."</td></tr>
                    </table></div>";
                }   
                ?>
          </div>
        <div class="tab-pane fade" id="v-pills-attend" role="tabpanel" aria-labelledby="v-pills-attend-tab">
            <?php
                    $r = $conn->query("select attendees from event where id = $eve");
                    $rw = $r->fetch_assoc();
                    $list = explode(",",$rw['attendees']);
                   if($list[0] == null)
                        echo" <h4>No Records Found!</h4> ";
                    else{
                 echo"<div class='table-responsive'>
                 <table class='table table-hover table-bordered'> 
    <tr><th class='text-center'>Sr.No</th><th class='text-center'>Attendees Name</th><th class='text-center'>E-Mail</th></tr>";
                $sr = 0;
 
                    for( $i = 0; $i < sizeof($list); $i++) {
                        $u_r = $conn->query("SELECT username,email from user where id =".$list[$i]."");
                        $u_row = $u_r->fetch_assoc();
                        $sr += 1;
                        echo"<tr><td>".$sr."</td><td>".$u_row['username']."</td><td>".$u_row['email']."</td></tr>";
                    }
                    echo"
                    </table></div>";
                }   
                ?>

        </div>

         <div class="tab-pane fade" id="v-pills-plan" role="tabpanel" aria-labelledby="v-pills-plan-tab" >

                <?php 
                $agenda = "";
                $new = 1;
                    $tmp = $conn->query("SELECT max(id) +1 as id from planner");
                    $r_tmp = $tmp->fetch_assoc();
                    $id = $r_tmp['id'];
                    $rs = $conn->query("SELECT * from planner where id='".$row['planner']."'");
                    if($rs->num_rows > 0)
                        while($p_row = $rs->fetch_assoc()){
                            $new += 1;
                            $agenda = $p_row['agenda'];
                            $id = $p_row['id'];
                        }
                            // echo"Array ( [id] => 1 [list] => 1 [agenda] => test [submit] => 2020-05-16 08:18:02 )";
                            echo"
                <div class='breadcrumb text-capitalize'>Agenda </div>
                <textarea class='text-center form-control' id='agen'>".$agenda."</textarea>
                <br>
                <div class='btn btn-sm btn-primary' onclick='updatePlan(".$id.",".$new.")'>Update</div>
                <br><br>";
                if($agenda){
                echo"
                <div class='breadcrumb text-capitalize'>Check List</div>
                <div class='table-responsive' >
                <table class='table table-hover table-bordered' >
                <tr><th class='text-center'>Sr.No</th><th class='text-center'>Product</th><th class='text-center'>Price</th></tr>
                
                ";
                    $sr = 1;
                    $in_rs = $conn->query("SELECT * from clist where planner='".$id."'");
                    if($in_rs->num_rows > 0)
                       while ($cl_row = $in_rs->fetch_assoc()) {
                        echo "<tr><td>$sr</td><td>".$cl_row['product']."</td><td>".$cl_row['price']."</td></tr>";
                        $sr += 1;
                    }
                    
                echo"
                    <tr>
                      <td>$sr</td>
                      <td><input type='text' class='form-control' id='prod'></td>
                      <td><input type='text' class='form-control' id='price'></td>
                    </tr>

                </table>

                <div class='btn btn-sm btn-primary pull-right' onclick='updateClist(".$id.")'>Add</div><br>
                </div>
                ";
                        
                  }    
                    
                        
                ?>
<br>

         </div>



        </div>
                

             
        </div>

        </div>

        </div><br>
        <a class='btn btn-primary col-md-12' href='report.php?eve=<?php echo $eve;?>'> Generate Report </a>
 </div>
    
</div>    

    <script src="js/jquery.js"></script>
    <script src="js/main.js"></script>
    <script>
    function updatePlan(arg, arg1){
        if($('#agen').val().length > 0)
           $.post('api/updatePlan.php',{
                agen:$('#agen').val(),
                plan:arg,
                eve:'<?php echo $eve;?>',
                new:arg1
            },function(response){
                console.log("Planner: "+response)
                location.href=location.href;
            }); 

        }
    function updateClist(arg){
        if($('#prod').val().length > 0 && $('#price').val().length > 0)
            $.post('api/updateList.php',{
                prod:$('#prod').val(),
                price:$('#price').val(),
                plan:arg
            },function(response){
                console.log("Clist: "+response)
                location.href=location.href;
                // location.href=location.href+"&&#v-pills-plan-tab";
            });
        }
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
                        desc:$("#desc").val(),
                        update:'<?php echo $eve;?>'
                    },
                    function(response){
                    console.log("New Event: "+response);
                    if(response == 1)
                      console.log($('#title').val()+" Event Updated");
                      redirect('event.php?eve=<?php echo $eve;?>');  
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
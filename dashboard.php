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
            <div id="addEventForm">
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" id="title" placeholder="Enter Event Title">
                </div>
                <div class="form-group">
                  <label for="type">Type</label>
                  <input type="datalist" class="form-control" id="type" placeholder="Enter Event Type" list="typelist">
                  <datalist id="typelist">
                        <option value="Type">Type</option>
                        <option value="Appearance or Signing">Appearance or Signing</option>
                        <option value="Attraction">Attraction</option>
                        <option value="Camp, Trip, or Retreat">Camp, Trip, or Retreat</option>
                        <option value="Class, Training, or Workshop">Class, Training, or Workshop</option>
                        <option value="Concert or Performance">Concert or Performance</option>
                        <option value="Conference">Conference</option>
                        <option value="Convention">Convention</option>
                        <option value="Dinner or Gala">Dinner or Gala</option>
                        <option value="Festival or Fair">Festival or Fair</option>
                        <option value="Game or Competition">Game or Competition</option>
                        <option value="Meeting or Networking Event">Meeting or Networking Event</option>
                        <option value="Other">Other</option>
                        <option value="Party or Social Gathering">Party or Social Gathering</option>
                        <option value="Race or Endurance Event">Race or Endurance Event</option>
                        <option value="Rally">Rally</option><option value="7">Screening</option>
                        <option value="Seminar or Talk">Seminar or Talk</option>
                        <option value="Tour">Tour</option>
                        <option value="Tournament">Tournament</option>
                        <option value="Tradeshow, Consumer Show, or Expo">Tradeshow, Consumer Show, or Expo</option>
                  </datalist>
                </div>
                <div class="form-group">
                  <label for="category">Category</label>
                  <input class="form-control" id="category" placeholder="Enter Event Category" list="catlist">
                  <datalist id="catlist">
                        <option >Category</option>
                        <option >Auto, Boat &amp; Air</option>
                        <option >Business &amp; Professional</option>
                        <option >Charity &amp; Causes</option>
                        <option >Community &amp; Culture</option>
                        <option >Family &amp; Education</option>
                        <option >Fashion &amp; Beauty</option>
                        <option >Film, Media &amp; Entertainment</option>
                        <option >Food &amp; Drink</option>
                        <option >Government &amp; Politics</option>
                        <option >Health &amp; Wellness</option>
                        <option >Hobbies &amp; Special Interest</option>
                        <option >Home &amp; Lifestyle</option>
                        <option >Music</option>
                        <option >Other</option>
                        <option >Performing &amp; Visual Arts</option>
                        <option >Religion &amp; Spirituality</option>
                        <option >School Activities</option>
                        <option >Science &amp; Technology</option>
                        <option >Seasonal &amp; Holiday</option>
                        <option >Sports &amp; Fitness</option>
                        <option >Travel &amp; Outdoor</option>
                  </datalist>
                </div>
                <div class="form-group">
                  <label for="venue">Venue</label>
                  <textarea class="form-control" id="venue" placeholder="Enter Venue"> </textarea>
                </div>
                <div class="form-group">
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" id="mode">
                  <label class="custom-control-label" for="mode">Online Event</label>
                </div>
                </div>
                <div class="form-group">
                  <label for="starttime">Start Time</label>
                  <input type="datetime-local" class="form-control" id="starttime">
                </div>
                <div class="form-group">
                  <label for="endtime" >End Time</label>
                  <input type="datetime-local" class="form-control" id="endtime" >
                </div>
                <div class="form-group">
                  <input type="submit" id="addEventBtn" class="form-control btn btn-success" value="Create Event">
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
                      redirect("eventDashboard.php");
                });
            });

        });
    </script>
    <script src="js/bootstrap.min.js" ></script>
</body>
</html>
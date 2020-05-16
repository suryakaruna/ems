<?php

if(!isset($_REQUEST['eve'])){
    echo"<script>
        window.location.href='401.html'
    </script>";
}
else{
	session_start();
    $eve = $_REQUEST['eve'];
    require('api/db.php');
    $sql = "SELECT * from event where id=$eve";
    $events = $conn->query($sql);
    $row = $events->fetch_assoc();
    $u_rs = $conn->query("select username from user where id=".$_SESSION['me']);
    $u_rw = $u_rs->fetch_assoc();
    $user = $u_rw['username'];
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
    <style type="text/css">
    	p{
    		font-size:1.2em;
    	}
    </style>
</head>
<body>
    <div class="event-head container-fluid" style="background: url('<?php echo $row['banner'];?>');" >
        <h1> Event - Report</h1>
    </div>
    <div class="container">
        <br><br>
        <div class="row">
            <div class="col-md-12 pull-left">
            	<h1 class='text-center'><?php echo $row['title']; ?></h1>
                  
                   	<p style="text-indent:5em;" class='text-justify'>The event <b><?php echo $row['title']; ?></b> was created at <b><?php echo $row['submit'];?></b> by Mr/Mrs.<b class='text-capitalize'>"<?php echo $user;?>"</b></p>
                    <h3>Event Type & Category:</h3>
                   <p style="text-indent:5em;" class='text-justify'> <?php echo $row['type']; ?> - <?php echo $row['category']; ?></p>

                   <h3>Event Description:</h3>
                   <p style="text-indent:5em;" class='text-justify'> <?php echo $row['description']; ?></p>
                   
                    <h3>  Venue :</h3>
                  <p style="text-indent:2.3em;" class='text-justify'>  <i class="fa fa-map"></i> <?php echo $row['venue']; ?></p>
                  <h3> Timing</h3>
                  <p style="text-indent:2.3em;" class='text-justify'> <i class="fa fa-clock"></i> <?php echo $row['startT']; ?> -  <?php echo $row['endT']; ?></p>
                   <h3>Mode </h3>
                   <p style="text-indent:5em;" class='text-justify'> <?php 
                   	echo ($row['online'] == 1)?'Online':'Offline'; ?> event</p>
                   	<h3> Agenda </h3>
                   		<textarea id='ag' class='text-left form-control' disabled='disabled' style='margin-left:5em;background:transparent;border:none;'> </textarea>
                   	<h3> Attendees</h3>
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
                <h3>Sponsors</h3>
                 <?php
                    $r = $conn->query("select * from sponsorship where event = $eve");
                    if(!($r->num_rows>0))
                        echo" <h4>No Records Found!</h4> ";
                    else{
                 echo"<div class='table-responsive'>
                 <table class='table table-hover table-bordered'> 
    <tr><th class='text-center'>Sponsor Name</th><th class='text-center'>E-Mail</th><th class='text-center'>Sponsored Amount</th></tr>";
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
                <h3>Expenditure</h3>
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
                
                <textarea class='text-center form-control' id='agen' style='display:none'>".$agenda."</textarea>
                <br>";
                if($agenda){
                echo"
                
                <div class='table-responsive' >
                <table class='table table-hover table-bordered' >
                <tr><th class='text-center'>Sr.No</th><th class='text-center'>Product</th><th class='text-center'>Price</th></tr>
                
                ";
                    $sr = 1;
                    $total =0;
                    $in_rs = $conn->query("SELECT * from clist where planner='".$id."'");
                    if($in_rs->num_rows > 0)
                       while ($cl_row = $in_rs->fetch_assoc()) {
                        echo "<tr><td>$sr</td><td>".$cl_row['product']."</td><td>".$cl_row['price']."</td></tr>";
                        $sr += 1;
                        $total += $cl_row['price'];
                    }
                    
                echo"
                    <tr>
                      <th colspan=2>Grand Total</th>
                     
                      <td>$total</td>
                    </tr>

                </table>

               <br>
                </div>
                ";
                        
                  }    
                    
                        
                ?>
             </div>  
         </div>
     </div>
     <script src="js/jquery.js"></script>
     <script type="text/javascript">
     	$(document).ready(function(){
     		$('#ag').html($('#agen').html());
     	});
     </script>
     <script src="js/bootstrap.min.js" ></script>
 </body>
 </html>
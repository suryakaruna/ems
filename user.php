<?php
if(!isset($_REQUEST["meth"]) || !isset($_REQUEST['eve'])){
    echo"<script>
        window.location.href='401.html'
    </script>";
}
else{

    $eve = $_REQUEST['eve'];
    $meth = $_REQUEST['meth'];
    require('api/db.php');
    $sql = "SELECT * from event where id=$eve";
    $events = $conn->query($sql);
    $row = $events->fetch_assoc();
    $index = ($meth=='sponsor')?'sponsor':'attendees';
        $t_sql = "SELECT id from user WHERE submit=(SELECT max(submit) from user)";
        $t_res = $conn->query($t_sql);
        $t_row = $t_res->fetch_assoc();
    if($row[$index] != null)     
    $list = "".$row[$index].",".($t_row['id']+1);
    else
    $list = ($t_row['id']+1);    
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
    <div class="container"><br>
        <h3> I am willing to <?php echo $meth;?></h3>
        <br>
        <?php require'util/newUser.php';
            getUserForm('
                    <button type="submit" id="'.$meth.'Btn" class="form-control btn btn-success" >Submit</button>
                ');
        ?>
    </div>
    <script src="js/jquery.js"></script>
<script type="text/javascript">

    function checkMe(ele){
        if($(ele).val()){
          $(ele).removeClass("in-valid").addClass("valid")
          return true
        }
        else{
          $(ele).removeClass("valid").addClass("in-valid")
          return false
        }
        
      }
      function checkFilled(form){
        arr = []
        $(form).find('input').each(function(){
          arr.push(checkMe(this))
        });
        return arr
    }

    $("#<?php echo $meth?>Btn").click(function(){

              result = checkFilled('#registerForm')
              // console.log(result)
              if(result.includes(false)){
                console.log("Please " + $($('#registerForm').find('input')[result.indexOf(false)]).attr('placeholder'))
             
            }else{
               $.post("api/doRegister.php",
                {
                  name:$('#rUsername').val(),
                  email:$('#rEmail').val(),
                  pass:$('#rPassword').val(), 
                  type:'<?php echo $meth;?>',
                  eve:'<?php echo $eve;?>',
                  list:'<?php echo $list;?>'
                },
                function(response){
                 if(response == 1){
                        console.log(response)
                        location.href='dashboard.php';
                    } 
                 else
                    console.log(response)   
                  // alert("Registered Successfully! Please Login To Continue")
                });
            }
    });  

</script>
 
    <script src="js/main.js"></script>
     <script src="js/bootstrap.min.js" ></script>
</body>
</html>

<?php
session_start();
if(isset($_SESSION["email"]) && isset($_SESSION["role"])){
   echo"<script> window.location.href='dashboard.php'; </script>";
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
           
          
               <?php require'util/newUser.php'; 
                getUserForm('<button type="submit" id="registerBtn" class="form-control btn btn-success">Register</button>
                <hr>
                <button  onclick="switchToLogin()" class="form-control btn btn-primary">Login</button>');
                ?>

            <div id='loginForm'>
                <div class="form-group">
                  <label for="email">Email address</label>
                  <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>

                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" placeholder="Enter Password">
                </div>
                
                <!-- <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div> -->
                
                <button type="submit" id="loginBtn" class="form-control btn btn-success" >Login</button>
                <hr>
                <button  onclick="switchToRegister()" class="form-control btn btn-primary">Register</button>
            </div>

        </div>
    </dvi>
  
    
    

    <script src="js/jquery.js"></script>
    <script src="js/main.js"></script>
    <script>
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

       $('#loginForm').hide()
        function switchToLogin(){
              $('#registerForm').hide()
              $('#loginForm').show() 
        }
        function switchToRegister(){
              $('#loginForm').hide()
              $('#registerForm').show()
        }

        $(document).ready(function(){
            
           $('#registerBtn').click(function(){
              result = checkFilled('#registerForm')
              // console.log(result)
              if(result.includes(false)){
                console.log("Please " + $($('#registerForm').find('input')[result.indexOf(false)]).attr('placeholder'))
             
            }else{
               $.post("api/doRegister.php",
                {
                  name:$('#rUsername').val(),
                  email:$('#rEmail').val(),
                  pass:$('#rPassword').val()
                },
                function(response){
                  console.log("doRegister: "+response);
                  alert("Registered Successfully! Please Login To Continue")
                  switchToLogin()
                });
            }
           });
           $('#loginBtn').click(function(){
              $.post("api/authendicate.php",
                {
                  email:$('#email').val(),
                  pass:$('#password').val()
                },
                function(response){
                  console.log("Login: "+response);
                  switchToLogin()
                  if(response == 1)
                      redirect("dashboard.php");
                });
           });

        });
    </script>
    <script src="js/bootstrap.min.js" ></script>
</body>
</html>

<?php
function getUserForm($spl=""){
echo"
<div id='registerForm'>
                <div class='form-group'>
                  <label for='rUsername'>User Name</label>
                  <input type='text' class='form-control' id='rUsername' placeholder='Enter Username' onblur='checkMe(this)'>
                </div>

                <div class='form-group'>
                  <label for='rEmail'>Email address</label>
                  <input type='email' class='form-control' id='rEmail' aria-describedby='emailHelp' placeholder='Enter email' onblur='checkMe(this)'>
                  <small id='emailHelp' class='form-text text-muted'>We'll never share your email with anyone else.</small>
                </div>

                <div class='form-group'>
                  <label for='rPassword'>Password</label>
                  <input type='password' class='form-control' id='rPassword' placeholder='Enter Password' onblur='checkMe(this)'>
                </div>
               
                ".$spl."
          </div>
          ";
}
?>
<div id="loginModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"  aria-hidden="true">×</button>
              <h1 class="text-center">Login</h1>
          </div>
          <div class="modal-body">
            
        <h3 style="display:none;">Invalid username/email or password </h3>
            
              <form class="form col-md-12 center-block" method="POST" action="login.php">
                <div class="form-group">
                  <input type="text" class="form-control input-lg" name="uid" placeholder="UserName or E-Mail" id="unique_id">
                </div>
                <div class="form-group">
                  <input type="password" name="pass" class="form-control input-lg" placeholder="Password" id="pass">
                </div>
                <div class="form-group">
                  <!-- <button class="btn btn-primary btn-lg btn-block">Sign In</button> -->
                  <input type="submit" class="btn btn-primary btn-lg btn-block" value="Sign In">
                  <span class="pull-right"><a id="send_reg" role="button" >Signup</a></span><span><a href="#" class="pull-left">Need help?</a></span>
                </div>
              </form>
<h3><a href="gplus_log.php"><img src="images/google-login-button.png" /></a></h3>
          </div>
          <div class="modal-footer">
              <div class="col-md-12">
              <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
              </div>    
          </div>
      </div>
    </div>
</div>

<div id="registerModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"  aria-hidden="true">×</button>
              <h1 class="text-center">Register</h1>
          </div>
          <div class="modal-body">
              <form class="form col-md-12 center-block" method="POST" action="register.php" enctype="multipart/form-data">
                <div class="form-group">
                  <input type="text" class="form-control input-lg" placeholder="Name" name="name" value="">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control input-lg" placeholder="E-mail" name="email" value="">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control input-lg" placeholder="UserName" name="username" value="">
                </div>
                <div class="form-group form-inline"> <h3> &nbsp;GENDER  </h3>
                   <h4 style="text-align:center;padding-left:5px;"> 
                    Male&nbsp;<input type="radio" class="form-control input-md" name="gender" value="Male" checked='false'>&nbsp;&nbsp;&nbsp;
                   Female&nbsp;<input type="radio" class="form-control input-md" name="gender" value="Female" checked='false'>  &nbsp;&nbsp;&nbsp;
                   Others&nbsp;<input type="radio" class="form-control input-md" name="gender" value="Other" checked='false'> 
               </h4>
                </div>
                <div class="form-group">
                   <input type="text" class="form-control input-lg" placeholder="Mobile Number" name="mobile" value="">
                </div>
                <!--
                <div class="form-group">
                  <input type="text" class="form-control input-lg" placeholder="BlogName" name="blogname" value="">
                </div>
                -->
                <div class="form-group">
                   <input type="password" class="form-control input-lg" placeholder="Password" name="pass" value="">
                </div>
				
                
                <div class="form-group">
                    <h4> Upload profile picture </h4>
                    
                
                    <input type="file" name="files" value=""/>
                    
                </div>
            
                <div class="form-group">
                  <!-- <button class="btn btn-primary btn-lg btn-block">Sign In</button> -->
                  <input type="submit" class="btn btn-primary btn-lg btn-block" value="Register"></input>
                  <span class="pull-right"><a id="send_login">Login</a></span><span><a href="#">Need help?</a></span>
                </div>
              </form>
          </div>
          <div class="modal-footer">
              <div class="col-md-12">
              <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
              </div>    
          </div>
      </div>
    </div>
</div>



<?php

function incc(){

echo "<script>  $('#send_reg').click(function(){ $('#loginModal').modal('hide');setTimeout(function(){ $('#registerModal').modal('show'); },400); }); </script>";

}
function incr(){

echo "<script> $('#send_login').click(function(){ $('#registerModal').modal('hide'); setTimeout(function(){ $('#loginModal').modal('show'); },400); }); </script>";
}



?>
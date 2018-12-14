<?php
   ob_start();
   session_start();
   ini_set('display_errors', 1); 
   include_once 'httpful.phar';
?>
<link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<head>
  <title>ekhdemliDrousi.tn</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script>
	$(document).ready(function() {

    
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.avatar').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    

    $(".file-upload").on('change', function(){
        readURL(this);
    });
});
  </script>
</head>

<body>
 <?php 
 $user = file_get_contents('http://localhost:8300/users/'.$_SESSION['id']);
 //$user = file_get_contents('http://localhost:8300/users/5bfc4e7564083612b84dd7b8');
$user= json_decode($user, true);
if (isset($_POST['save']) ) {
$data = array('first_name' => $_POST["first_name"], 'last_name' => $_POST["last_name"], 'phone' => $_POST["phone"], 'email' => $_POST["email"], 'password' => $_POST["password"]);
$endpoint = 'http://localhost:8300/users/'.$_SESSION['id'] ;
$uri = $endpoint ;
$data = json_encode($data);
$header = ['Content-Type' => 'application/json'];
$response = \Httpful\Request::put($uri)->addHeaders($header)->body($data)->send();
$user = json_decode($response, true);
}
 ?>
<hr>
<div class="container bootstrap snippet">
    <div class="row">
  		<div class="col-sm-10"><h1>User name</h1></div>
    	<div class="col-sm-2"><a href="/users" class="pull-right"><img title="profile image" class="img-circle img-responsive" src="img/avatar_2x.png"></a></div>
    </div>
    <div class="row">
  		<div class="col-sm-3"><!--left col-->
              

      <div class="text-center">
        <img src="img/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
        <h6>Upload a different photo...</h6>
        <input type="file" class="text-center center-block file-upload">
      </div></hr><br>


          <ul class="list-group">
            <li class="list-group-item text-muted">projects <i class="fa fa-dashboard fa-1x"></i></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>project 1</strong></span> 125</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>project 2</strong></span> 13</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>project 3</strong></span> 37</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>project 4</strong></span> 78</li>
          </ul> 
               
          
          
        </div><!--/col-3-->
    	<div class="col-sm-9">
            <ul class="nav nav-tabs">
                <li class="active"><a href="homepage/index.php">Home </a></li>
                <li><a href="addproject.php">add project </a></li>
              </ul>

              
          <div class="tab-content">
            <div class="tab-pane active" id="home">
                <hr>
                  <form class="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" id="registrationForm">
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="first_name"><h4>First name</h4></label>
                              <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $user['first_name']?>" title="enter your first name if any.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                            <label for="last_name"><h4>Last name</h4></label>
                              <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $user['last_name']?>" title="enter your last name if any.">
                          </div>
                      </div>
          
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="phone"><h4>Phone</h4></label>
                              <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $user['phone']?>" title="enter your phone number if any.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="email"><h4>Email</h4></label>
                              <input type="email" class="form-control" name="email" id="email" value="<?php echo $user['email']?>" title="enter your email.">
                          </div>
                      </div>
                      <div class="form-group">
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="password"><h4>Password</h4></label>
                              <input type="password" class="form-control" name="password" id="password" value="<?php echo $user['password']?>" title="enter your password.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                            <label for="password2"><h4>Verify</h4></label>
                              <input type="password" class="form-control" name="password2" id="password2" value="password2" title="enter your password2.">
                          </div>
                      </div>
                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                              	<button class="btn btn-lg btn-success" type="submit" name = "save"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                               	<button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                            </div>
                      </div>
              	</form>
              
              <hr>
              
             </div><!--/tab-pane-->
            
          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->
   </body>                                                   
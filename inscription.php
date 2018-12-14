<?php
   ob_start();
   session_start();
  ini_set('display_errors', 1);
include_once 'httpful.phar';
  
?>

<?
   // error_reporting(E_ALL);
   // ini_set("display_errors", 1);
?>

<html lang = "en">
   
   <head>
      <title>ekhdemliDrousi.tn</title>
      <link href = "css/bootstrap.min.css" rel = "stylesheet">
      
      <style>
         body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #ADABAB;
         }
         
         .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
            color: #017572;
         }
         
         .form-signin .form-signin-heading,
         .form-signin .checkbox {
            margin-bottom: 10px;
         }
         
         .form-signin .checkbox {
            font-weight: normal;
         }
         
         .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
         }
         
         .form-signin .form-control:focus {
            z-index: 2;
         }
         
         .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
            border-color:#017572;
         }
         
         .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-color:#017572;
         }
         
         h2{
            text-align: center;
            color: #017572;
         }
      </style>
      
   </head>
	
   <body>
      
      <h2>inscription</h2> 
      <div class = "container form-signin">
         
         <?php
		 $users = file_get_contents('http://localhost:8300/users/');
		 // Convert JSON string to Array
  $someArray = json_decode($users, true);
  $verif= false;
  foreach($someArray as $user){
	if( $_POST['email'] == $user["email"]){
					  $verif=true;
				  }
  }
            $msg = '';
           
            if (isset($_POST['login']) && !empty($_POST['email']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['phone'])
               && !empty($_POST['password'])) {
				
               if ($verif) {
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['id'] = 'tutorialspoint';
                  
                  echo 'email deja utilisé';
               }else {
				    $data = array('first_name' => $_POST["first_name"], 'last_name' => $_POST["last_name"], 'phone' => $_POST["phone"], 'email' => $_POST["email"], 'password' => $_POST["password"]);
$endpoint = 'http://localhost:8300/users/' ;
$uri = $endpoint ;
$data = json_encode($data);
$header = ['Content-Type' => 'application/json'];
$response = \Httpful\Request::post($uri)->addHeaders($header)->body($data)->send();
                  $msg = 'inscription fait avec succes';
				  
               }
            }
         ?>
      </div> <!-- /container -->
      
      <div class = "container">
      
         <form class = "form-signin" role = "form" 
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method = "post">
            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
            <input type = "text" class = "form-control" 
               name = "first_name" placeholder = "first name" 
               required autofocus></br>
			<input type = "text" class = "form-control" 
               name = "last_name" placeholder = "last name" 
               required autofocus></br>
			<input type = "text" class = "form-control" 
               name = "phone" placeholder = "phone number" 
               required autofocus></br>  
			<input type = "text" class = "form-control" 
               name = "email" placeholder = "email" 
               required autofocus></br>   
            <input type = "password" class = "form-control"
               name = "password" placeholder = "password = 1234" required>
            <a href=""><button class = "btn btn-lg btn-primary btn-block" type = "submit" 
               name = "login">s'inscrire</button></a>
			<p>you have an Account? <a href="login.php"> Login Now!</a></p>   
         </form>
			
         Click here to clean <a href = "logout.php" tite = "Logout">Session.
         
      </div> 
      
   </body>
</html>
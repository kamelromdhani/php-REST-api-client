<?php 
include_once 'httpful.phar';
$users = file_get_contents('http://localhost:8082/users/');
// Convert JSON string to Array
$someArray = json_decode($users, true);
$v =false;
  foreach($someArray as $user){
	 if ($user["email"] == $_POST["email"])
					  $v =true; ;
				  
  }
  if($v){
	  echo 'cette email est deja utilisé';
  }
  else{
	  $data = array('first_name' => $_POST["first_name"], 'last_name' => $_POST["last_name"], 'phone' => $_POST["phone"], 'email' => $_POST["email"], 'password' => $_POST["password"]);
$endpoint = 'http://localhost:8082/users/' ;
$uri = $endpoint ;
$data = json_encode($data);
$header = ['Content-Type' => 'application/json'];
$response = \Httpful\Request::post($uri)->addHeaders($header)->body($data)->send();
var_dump($response->body);
  }


 ?>
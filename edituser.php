<?php 
include_once 'httpful.phar';
class User
{
	public $first_name;
	public $last_name;
	public $email;
	public $password;
	public $phone;
	public $projectsID =array();
}
$user = file_get_contents('http://localhost:8300/users/5bfc4e7564083612b84dd7b8');
		 // Convert JSON string to Array
  $user = json_decode($user, true);
  $user['projctsID'][]= '123456789' ;
//echo $user['projctsID'][2];
$url='http://localhost:8300/users/5bfc4e7564083612b84dd7b8';
 $data = json_encode($user);
$header = ['Content-Type' => 'application/json'];
$response = \Httpful\Request::put($url)->addHeaders($header)->body($data)->send();

$response = json_decode($response);
echo $response->_id;
//print_r($response);
//$response = \Httpful\Request::post($uri)->addHeaders($header)->body($data)->send();


?>
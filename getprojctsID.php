<?php 
//$user = file_get_contents('http://localhost:8300/users/'.$_SESSION['id']);
$user = file_get_contents('http://localhost:8300/users/5c0eb83b6408361aa8dcb323');

$user = json_decode($user, true);
foreach($user['projctsID'] as $projectid){
	echo  $projectid ;
}
?>
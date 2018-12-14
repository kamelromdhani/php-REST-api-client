<?php
   ob_start();
   session_start();
  ini_set('display_errors', 1);
include_once 'httpful.phar';
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>get project</title>
  <meta charset="utf-8">
</head>
<body>
<?php 
//echo $_SESSION['projectid'] ;
$project = file_get_contents('http://localhost:8300/projects/'.$_SESSION['projectid']) ;
$project = json_decode($project, true);
$users = file_get_contents('http://localhost:8300/users/') ;
$users = json_decode($users, true);
$v= false;
foreach($users as $tempuser){
	$v = false ;
	foreach($tempuser['projctsID'] as $projectid){
		if($projectid == $_SESSION['projectid']){
			$v= true;
		break;}
	}
	if($v){
		$user= $tempuser ;
		break;
	}
		
} 
?>

<h1>name: </h1> <p><?php echo $project['name']?></p>
<h2>description: </h2><pre><?php echo $project['description']?><pre>
<h2>date limite: </h2><?php echo $project['limit_date']?>
<h2>post date: </h2><?php echo $project['post_date']?>
<h2>status: </h2><?php echo $project['etat']?><br>
<h2>categorie: </h2><?php echo $project['categorie']?>
<h2>Files: </h2>
<?php 
echo '<ul>';
foreach($project['files'] as $file){
	echo '<li>';
	echo $file['name'];
	echo '</li>';
}
echo '</ul>'; 
?>
<hr>
<h2>project owner first name: </h2><?php echo $user['first_name']?>
<h2>project owner last name: </h2><?php echo $user['last_name']?>
<h2>project owner phone: </h2><?php echo $user['phone']?>
<h2>project owner email: </h2><?php echo $user['email']?>

 <!-- <ul>
	
</ul> -->

</body>
</html>

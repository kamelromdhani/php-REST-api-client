<?php
   ob_start();
   session_start();
  ini_set('display_errors', 1);
include_once 'httpful.phar';
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>add project</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php 
try {
	$msg='';
	if(isset($_POST['submit']) && !empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['limit_date'])){
 
 class File
{
    public $name;
    public $url;
}
 
 // Count total files
 $countfiles = count($_FILES['file']['name']);
$files =array();
 // Looping all files
 for($i=0;$i<$countfiles;$i++){
	 
  $filename = $_FILES['file']['name'][$i];
  $file = new File();
$file->name = $filename;
$file->url = 'upload/1/'.$filename;
//$file->url = 'upload/'.$_SESSION['id'].'/'.$filename;
if (!file_exists('upload/'.$_SESSION['id'])) {
    mkdir('upload/'.$_SESSION['id'], 0777, true);
}
 $files[] = $file ;
  // Upload file
  move_uploaded_file($_FILES['file']['tmp_name'][$i],'upload/'.$_SESSION['id'].'/'.$filename);
 
 }
 
 
 $data = array('name' => $_POST["name"], 'description' => $_POST["description"], 'post_date' => date("Y-m-d"), 'limit_date' => $_POST["limit_date"], "etat" => "not solved", "categorie" => $_POST["categorie"], "files" => $files);
$uri = 'http://localhost:8300/projects/' ;

$data = json_encode($data);
$header = ['Content-Type' => 'application/json'];
$response = \Httpful\Request::post($uri)->addHeaders($header)->body($data)->send();
 
 if ($response->code == 200){
 $msg = 'projet ajouté avec succes';
 $response = json_decode($response);
 
 $projectid= $response->_id;
 }
 else{
	 $msg='error, '. $response->code;
 }
} }
catch (Exception $ex) {
	$ex->getMessage();
}

//update user
//$user = file_get_contents('http://localhost:8300/users/5bfc4e7564083612b84dd7b8');
$user = file_get_contents('http://localhost:8300/users/'.$_SESSION['id']);
		 // Convert JSON string to Array
  $user = json_decode($user, true);
  $user['projctsID'][]= $projectid ;
//echo $user['projctsID'][2];
$url='http://localhost:8300/users/'.$_SESSION['id'];
 $data = json_encode($user);
$header = ['Content-Type' => 'application/json'];
$response = \Httpful\Request::put($url)->addHeaders($header)->body($data)->send();
  ?>
<div class="container">
<ul class="nav nav-tabs">
                <li class="active"><a href="homepage/index.php">Home </a></li>
                <li><a href="profile.php">profile </a></li>
              </ul>
  <h2>Dites-nous ce que vous voulez faire</h2>
  <p>Ajouter un projet en détaillant sa description et en ajoutant les fichiers que vous trouvez utiles ou nécessaires.</p>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data">
    <div class="form-group">
      <label for="name">Choose a name for your project:</label>
      <input type="text" class="form-control" id="name" name="name">
    </div>
	<div class="form-group">
  <label for="description">Tell us more about your project:</label>
  <p>Start with a bit about yourself or your business, and include an overview of what you need done.</p>
  <textarea class="form-control" rows="5" id="description" name="description"></textarea>
</div>
<div class="form-group">
      <label for="limit_date">date limite:</label>
      <input type="date" class="form-control" id="limit_date" name="limit_date">
    </div>
<div class="form-group">
    <label for="exampleFormControlFile1"> add any files that might be helpful in explaining your project here. add all at once</label>
<input class="form-control-file" type="file" name="file[]" id="file" multiple />
  </div>
  <div class="form-group">
  <select name="categorie">
  <option value="math" selected>math</option>
  <option value="physics">physics</option>
  <option value="informatique">informatique</option>
  <option value="anglais">anglais</option>
</select>   </div>
   <input type='submit' name='submit' value='add project' />
   <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
  </form>
</div>

</body>
</html>

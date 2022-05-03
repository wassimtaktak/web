<?php
$libelle = $prix = $description ="";
if(count($_FILES) > 0) {
if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
    require_once "../config.php";
    $imgData =addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
	$imageProperties = getimageSize($_FILES['userImage']['tmp_name']);
	if (isset($_POST['price'])) 
    { 
    $prix=$_POST["price"];
    }
    if (isset($_POST['description']))
    {
	    $description = trim($_POST["description"]);
    }
	if (isset($_POST['libelle'])) 
    { 
    $libelle=$_POST["libelle"];
    }
	$sql = "INSERT INTO aliment( libelle_aliment, prix,description, image) VALUES('{$libelle}','{$prix}','{$description}', '{$imgData}')";
	$current_id = mysqli_query($link, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($link));
	if(isset($current_id)) {
		header('location:index.php');
	}
}
}
?>

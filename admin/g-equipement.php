<?php
//preq_match
//in_read

//require_once "securite.php";
require_once "../config.php";
//$name = $_SESSION['user']['name'];
//$username = $_SESSION['user']['username'];
$sql = "select * from aliment order by libelle_aliment";
$link->query("SET NAMES 'utf8'");
$res = $link->query($sql);
$row_count=$res->num_rows;


if(isset($_SESSION['info']))
$info = $_SESSION['info'];
else
$info="";
unset($_SESSION['info']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
	 <link rel="stylesheet" href="../css/icon.css">
    <link rel="stylesheet" href="../css/font-style.css">
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>
<div class="row">
<div class="cols-25">
</div>
<div class="cols-75">
<a href="add-equipement.php" >Créer un équipement</a>
<div class="search">
<form action="" method="">
<input type="text" placeholder="search" name="search">
<button type="submit" class="btn">Chercher</button>
</form>
</div>
<?php if (!empty($info)) { ?>		
<div class="alert">
<?php echo $info; ?>
</div>
<?php } ?>
<table>
	<tr>
		<th>#</th>
		<th>name</th>
		<th>price</th>
		<th>Description</th>
        <th>photo</th>
		<th colspan="3" class="text-right">Actions</th>
	</tr>
	<?php while ($rows = $res->fetch_assoc()){ ?>   
	<tr>
		<td><?php echo $rows['id_aliment']; ?></td>				
		<td width="10%"><?php echo $rows['libelle_aliment']; ?></td>
		<td width="10%"><?php echo $rows['prix']; ?></td> 				
		<td width="40%"><?php echo $rows['description']; ?></td> 		
        <td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $value['image'] ).'"/>';?></td>

		<td class="text-right">
		<a href="view-equipement.php?id=<?php echo $rows['id_aliment']; ?>" title="Consulter">
		<i class="large material-icons">info_outline</i></a>
		
		<!--<a href="update-equipement.php?id1=<?//php echo $rows['id']; ?> && id2=<//?php echo $rows['type_equip']; ?>" title="Editer">-->
		<i class="large material-icons">autorenew</i></a>
		
		<a onclick="return confirm('Etes vous sur de vouloir supprimer ce matériel')" 
		href="delete-equipement.php?id=<?php echo $rows['id_aliment']; ?>" title="Supprimer">
		<i class="large material-icons">storage</i></a>
		</td>
		
	</tr>
    <?php } ?> 
</table>
</div>
</div>
</body>
</html>
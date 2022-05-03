<?php
require_once('db.php');

$get_id=$_GET['id_aliment'];

// sql to delete a record
$sql = "Delete from aliment where id_aliment = '$get_id'";

// use exec() because no results are returned
$conn->exec($sql);
header('location:index.php');
?>
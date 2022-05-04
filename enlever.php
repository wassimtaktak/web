<?php
session_start();
$id = $_GET['id'];//tjib bih l id li khdhitou ml url
//echo $id;
$total_enlever = $_SESSION['panier'][2][$id][1];
$_SESSION['panier'][1]-=$total_enlever;
unset($_SESSION['panier'][2][$id]);
header("location: panier.php");
?>
<?php
session_start();
require_once "connect.php";
 if(!isset($_SESSION['username']))
 {
     header("location: login.php");
     exit();
 }
 if (isset($_POST['id'])) 
 {
     $id = $_POST['id'];
 }
 $visiteur=$_SESSION['id'];
 $quantite=1;
$requetenom = "select libelle_aliment from aliment where id_aliment='$id'";
$res=$con->query($requetenom);
$food = $res->fetch();
 if (isset($_POST['prix'])) 
 {
     $price = $_POST['prix'];
 }
 if (!isset($_SESSION['panier'])){ // panier n'existe pas 
    $_SESSION['panier'] = array($visiteur,0,  array() ); // creation de panier 
    }
    $_SESSION['panier'][1]+= $price;
    $_SESSION['panier'][2][] = array( $quantite , $price , $id,$food['libelle_aliment']); 
    
   
header("location: panier.php");      
?>
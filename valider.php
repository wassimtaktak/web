<?php
session_start();
require_once "connect.php";
//  creation de panier
$visiteur=$_SESSION['id'];
$price=$_SESSION['panier'][1];
$requette_panier = "INSERT INTO commande(totale_commande, id_client) VALUES('$price','$visiteur')";
 $resultat=$con->query($requette_panier);
 $panier_id=$con->lastInsertId();
 $commandes=$_SESSION['panier'][2];
 foreach($commandes as $commande)
 {
     $quantite=$commande[0];
     $price=$commande[1];
     $id=$commande[2];
     $requette = "INSERT INTO details_commande(quantite, total_prix, id_commande, id_aliment) VALUES ('$quantite','$price','$panier_id','$id')";
     $resultat=$con->query($requette);
 }
 //supprimer le panier
 $_SESSION['panier']=null.
 //redirection vers page de menu
 header("location: test_recherche2.php");
?>

<?php
session_start();
$commandes = array();
if (isset($_SESSION['panier']))
{
     if (count($_SESSION['panier'][2]) > 0)
     {
        $commandes =$_SESSION['panier'][2];
     }
     
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
</head>
<body class="sub_page" >
<?php include "navbar.php"?>
    <h2><center>Panier utilisateur</center></h2>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">aliment</th>
      <th scope="col">Quantité</th>
      <th scope="col">prix</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach($commandes as $index=> $commande)
    print' <tr>
      <th scope="row">'.($index+1).'</th>
      <td>'.$commande[3].'</td>
      <td>'.$commande[0].'</td>
      <td>'.$commande[1].' DT</td>
      <td><a href="enlever.php?id='.$index.'" class="btn btn-danger ">delete</a></td>
    </tr>';
    //print '<h1>prix total='.$_SESSION['panier'][1].'</h1>'; 
    //<td>'.$commande[0].'</td> quantite
    ?>
  </tbody>
</table>
    <!-- footer section -->
    <div class="prix">
    <a href="valider.php" class="btn btn-success ">Submit</a>
    <?php
    print '<h1>prix total='.$_SESSION['panier'][1].'</h1>';
    ?>
    </div>
    <?php
    include "footer.php" 
    ?>
  <!-- footer section -->
 <script src="js/jquery-3.4.1.min.js"></script>
 <script src="js/bootstrap.js"></script>
</body>
</html>
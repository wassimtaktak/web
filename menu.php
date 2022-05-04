<?php
$mot_recherche = $_GET['id'];
include 'connect.php';
$requete = $con->prepare("select * from aliment where libelle_aliment like '%$mot_recherche%'");
$requete->execute();
$food = $requete->fetchAll(PDO::FETCH_ASSOC);
?>
<html>
<head>
<title><?php echo $mot_recherche ?></title>
  <!-- bootstrap core css -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<!-- font awesome style -->
<link href="css/font-awesome.min.css" rel="stylesheet" />

<!-- Custom styles for this template -->
<link href="css/style.css" rel="stylesheet" />
<!-- responsive style -->
<link href="css/responsive.css" rel="stylesheet" />
</head>
<body class="sub_page">
    <?php include "navbar.php"?>
    <div class="container">
    <section class="food_section layout_padding">
        <div class="container">
  
            <div class="heading_container heading_center">
                <h2>
                    <?php print '<h2>'.$mot_recherche.'</h2>'?>
                </h2>
            </div>
            <div class="filters-content">
                <div class="row grid">
                    <tbody>
                        <?php
                            foreach($food as $key=>$value)
                            {
                            ?>
                             <!--yebda lbox-->
                            <div class="col-sm-6 col-lg-4 all pizza">
                                <div class="box">
                                <div class="b">
                                <div class="img-box">
                                    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $value['image'] ).'"/>';?>
                                </div>
                                <div class="detail-box" >
                                    <h5>
                                    <?php echo $value['libelle_aliment'];?>
                                    </h5>
                                    <p>
                                        <?php echo $value['description'];?>
                                    </p>
                                    <div class="options">
                                    <h6>
                                        <?php echo $value['prix'];?>DT
                                    </h6>
                                <form action="commander.php" method="post"> 
                                    <input type="hidden" name="id" value="<?php echo $value['id_aliment'];?>">
                                    <input type="hidden" name="prix" value="<?php echo $value['prix'];?>">
                                    <button type="submit" >order now</button>
                                </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                            <!--fin box-->
                        <?php
                            }//foreach toufa

                ?>
             
                    </tbody>
            </div>
        </div>
    </section>
</div>
     <!-- footer section -->
  <?php include "footer.php" ?>
  <!-- footer section -->
 <script src="js/jquery-3.4.1.min.js"></script>
 <script src="js/bootstrap.js"></script>
</body>
</html>
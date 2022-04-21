<?php
include 'connect.php';
$searchErr = '';
$reponse_recherche=$food='';
//requete li chetjib lmekla lkol
$requete = $con->prepare("select * from aliment");
$requete->execute();
$food = $requete->fetchAll(PDO::FETCH_ASSOC);
// fin
if(isset($_POST['save']))
{
    if(!empty($_POST['search']))
    {
        $search = $_POST['search'];
        $stmt = $con->prepare("select * from aliment where libelle_aliment like '%$search%'");
        $stmt->execute();
        $reponse_recherche = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //print_r($reponse_recherche);
         
    }
    else
    {
        $searchErr = "Please enter the information";
    }
    
}
 
?>
<html>
<head>
<title>ajax example</title>
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
    <form class="form-horizontal" action="#" method="post">
    <div class="row">
        <div class="form-group row">
            <label class="control-label col-sm-4" for="email"><b>SEARCH :</b></label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="search" placeholder="search here">
            </div>
            <div class="col-sm-2">
              <button type="submit" name="save" class="btn btn-success btn-sm">Submit</button>
            </div>
        </div>
        <div class="form-group">
            <span class="error" style="color:red;"> <?php echo $searchErr;?></span>
        </div>
         
    </div>
    </form>
    <br/><br/>
    <section class="food_section layout_padding">
        <div class="container">
            <?php  
            if(!$reponse_recherche)
            { ?>
            <div class="heading_container heading_center">
                <h2>
                    Our Menu
                </h2>
            </div>
            <ul class="filters_menu">
                <li class="active" data-filter="*">All</li>
                <li data-filter=".burger">starter</li>
                <li data-filter=".pizza">main course</li>
                <li data-filter=".pasta">dessert</li>
                <li data-filter=".fries">Fries</li>
            </ul>
            <?php } else { ?>
                <div class="heading_container heading_center">
                    <h2>
                        Result
                    </h2>
                </div>
                <?php } ?>
            <div class="filters-content">
                <div class="row grid">
                    <tbody>
                        <?php
                         if(!$reponse_recherche)
                         {  
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
                                    <a href="">
                                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">
                                        <g>
                                            <g>
                                            <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                                        c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                            <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                                        C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                                        c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                                        C457.728,97.71,450.56,86.958,439.296,84.91z" />
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                            <path d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                                        c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                                            </g>
                                        </g>
                                        </svg>
                                    </a>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                            <!--fin box-->
                        <?php
                            }//foreach toufa
                         }
                         else{
                            foreach($reponse_recherche as $key=>$value)
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
                                    <a href="">
                                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">
                                        <g>
                                            <g>
                                            <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                                        c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                            <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                                        C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                                        c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                                        C457.728,97.71,450.56,86.958,439.296,84.91z" />
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                            <path d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                                        c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                                            </g>
                                        </g>
                                        </svg>
                                    </a>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                            <!--fin box-->
                        <?php
                            }//foreach toufa
                     
                            }//else toufaa
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